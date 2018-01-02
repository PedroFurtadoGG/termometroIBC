<?php
//header('Content-type: text/html; charset=UTF-8');
session_name("Login"); // verifica conceito
session_start(); // verifica conceito
$BANCO  = "termometro";
$SERVER = "127.0.0.1";
$USER   = "root";
$SENHA  = "";

$CONNECT_X = mysql_connect($SERVER,$USER,$SENHA);
$CONNECT   = mysql_select_db("$BANCO", $CONNECT_X);
$url = 'http://localhost/termometro';


class Cms {

    public static function slug($titulo){
        $trocarIsso = array(' - ','.', ' ','à','á','â','ã','ä','å','ç','è','é','ê','ë','ì','í','î','ï','ñ','ò','ó','ô','õ','ö','ù','ü','ú','ÿ','À','Á','Â','Ã','Ä','Å','Ç','È','É','Ê','Ë','Ì','Í','Î','Ï','Ñ','Ò','Ó','Ô','Õ','Ö','O','Ù','Ü','Ú','Ÿ',);
        $porIsso = array('-', '','-','a','a','a','a','a','a','c','e','e','e','e','i','i','i','i','n','o','o','o','o','o','u','u','u','y','A','A','A','A','A','A','C','E','E','E','E','I','I','I','I','N','O','O','O','O','O','0','U','U','U','Y',);
        $titletext = str_replace($trocarIsso, $porIsso, $titulo);
        return $titletext;
    }

    public static function dataDia($data){
        $data = explode('-', $data);

        $ano = $data[0];
        $mes = $data[1];
        $dia = $data[2];

        return $dia;
    }

    public static function dataAno($data){
        $data = explode('-', $data);

        $ano = $data[0];
        $mes = $data[1];
        $dia = $data[2];

        return $ano;
    }

    public static function dataBr($data){
        $data = explode('-', $data);

        $ano = $data[0];
        $mes = $data[1];
        $dia = $data[2];

        return $dia.'/'.$mes.'/'.$ano;
    }

    public static function dataMes($data){
        $data = explode('-', $data);

        $ano = (int) $data[0];
        $mes = (int) $data[1];
        $dia = (int) $data[2];

        $meses = array (1 => "JAN", 2 => "FEV", 3 => "MAR", 4 => "ABR", 5 => "MAI", 6 => "JUN", 7 => "JUL", 8 => "AGO", 9 => "SET", 10 => "OUT", 11 => "NOV", 12 => "DEZ");
        $diasdasemana = array (1 => "Segunda-Feira",2 => "Terça-Feira",3 => "Quarta-Feira",4 => "Quinta-Feira",5 => "Sexta-Feira",6 => "Sábado",0 => "Domingo");
        $hoje = getdate();
        $dia = $dia;
        $mes = $mes;
        $nomemes = $meses[$mes];
        $ano = $ano;
        $diadasemana = $hoje["wday"];
        $nomediadasemana = $diasdasemana[$diadasemana];

        return $nomemes;
    }

    public static function dataSem($data){
        $data = explode('-', $data);

        $ano = (int) $data[0];
        $mes = (int) $data[1];
        $dia = (int) $data[2];

        $meses = array (1 => "JAN", 2 => "FEV", 3 => "MAR", 4 => "ABR", 5 => "MAI", 6 => "JUN", 7 => "JUL", 8 => "AGO", 9 => "SET", 10 => "OUT", 11 => "NOV", 12 => "DEZ");
        $diasdasemana = array (1 => "SEG",2 => "TER",3 => "QUA",4 => "QUI",5 => "SEX",6 => "SAB",0 => "DOM");
        $hoje = getdate();
        $dia = $dia;
        $mes = $mes;
        $nomemes = $meses[$mes];
        $ano = $ano;
        $diadasemana = $hoje["wday"];
        $nomediadasemana = $diasdasemana[$diadasemana];

        return $nomediadasemana;
    }

    public static function dataExt($data){

        $data = explode('-', $data);

        $ano = (int) $data[0];
        $mes = (int) $data[1];
        $dia = (int) $data[2];

        $meses = array (1 => "Janneiro", 2 => "Fevereiro", 3 => "Março", 4 => "Abril", 5 => "Maio", 6 => "Junho", 7 => "Julho", 8 => "Agosto", 9 => "Setembro", 10 => "Outubro", 11 => "Novembro", 12 => "Dezembro");
        $diasdasemana = array (1 => "Segunda-Feira",2 => "Terça-Feira",3 => "Quarta-Feira",4 => "Quinta-Feira",5 => "Sexta-Feira",6 => "Sábado",0 => "Domingo");
        $hoje = getdate();
        $dia = $dia;
        $mes = $mes;
        $nomemes = $meses[$mes];
        $ano = $ano;
        $diadasemana = $hoje["wday"];
        $nomediadasemana = $diasdasemana[$diadasemana];

        return $dia.' de '.$nomemes.' de '.$ano;
    }

    public static function conteudoPrincipal($cod, $slug = NULL, $limit = NULL, $order = NULL, $condicao = NULL){

        $sql = "
            SELECT DISTINCT ctn.codconteudo
            , ctn.codcategoria
            , ctn.codsubcategoria
            , ctn.codpagina
            , ctn.slug
            , ctn.titulo
            , ctn.subtitulo
            , ctn.texto
            , ctn.dtcadastro
            , ctn.title
            , ctn.description
            , (SELECT img.url FROM imagens AS img WHERE img.codconteudo = ctn.codconteudo LIMIT 1) as dir
            , (SELECT img.imagem FROM imagens AS img WHERE img.codconteudo = ctn.codconteudo ORDER BY listorder ASC LIMIT 1) as img
            , (SELECT cat.slug FROM categoria AS cat WHERE cat.codcategoria = ctn.codcategoria LIMIT 1) as slugcat
            , (SELECT cat.categoria FROM categoria AS cat WHERE cat.codcategoria = ctn.codcategoria LIMIT 1) as categoria
            FROM conteudo AS ctn
            WHERE ctn.codpagina = ".$cod."
            ";

        if($slug != NULL) $sql .= " AND ctn.slug = '".$slug."' ";

        if($condicao != NULL) $sql .= " ".$condicao." ";

        if($order != NULL){
            $sql .= " ".$order." ";
        }

        if($limit != NULL) $sql .= "LIMIT ".$limit." ";

        $qry = mysql_query($sql);

        return $qry;

    }

    public static function conteudoPaginacao($cod, $slug = NULL, $limit = NULL, $order = NULL, $condicao = NULL, $offset = NULL){

        $sql = "
            SELECT DISTINCT ctn.codconteudo
            , ctn.codcategoria
            , ctn.codsubcategoria
            , ctn.codpagina
            , ctn.slug
            , ctn.titulo
            , ctn.subtitulo
            , ctn.texto
            , ctn.dtcadastro
            , ctn.title
            , ctn.description
            , (SELECT img.imagem FROM imagens AS img WHERE img.codconteudo = ctn.codconteudo ORDER BY listorder ASC LIMIT 1) as img
            , (SELECT img.url FROM imagens AS img WHERE img.codconteudo = ctn.codconteudo LIMIT 1) as dir
            , (SELECT img.tipo FROM imagens AS img WHERE img.codconteudo = ctn.codconteudo LIMIT 1) as tipo
            FROM conteudo AS ctn
            WHERE ctn.codpagina = ".$cod."
            ";

        if($slug != NULL) $sql .= " AND ctn.slug = '".$slug."' ";

        if($condicao != NULL) $sql.= " ".$condicao." ";

        if($order != NULL){
            $sql .= " ".$order." ";
        }

        if($offset != NULL){
            if($limit == NULL){
                $limit = 0;
            }
            $sql .= "LIMIT ".$limit.",".$offset." ";
        }else{
            if($limit != NULL){
                $sql .= "LIMIT ".$limit." ";
            }
        }

        $qry = mysql_query($sql);

        return $qry;

    }

    public static function conteudoImagem($cod, $slug = NULL, $limit = NULL, $order = NULL, $busca = NULL){

        $sql = "
            SELECT DISTINCT ctn.codconteudo
            , ctn.codcategoria
            , ctn.codsubcategoria
            , ctn.codpagina
            , ctn.slug
            , ctn.titulo
            , ctn.subtitulo
            , ctn.texto
            , ctn.dtcadastro
            , ctn.title
            , ctn.description
            , (SELECT img.imagem FROM imagens AS img WHERE img.codconteudo = ctn.codconteudo ORDER BY listorder ASC LIMIT 1) as img
            , (SELECT img.url FROM imagens AS img WHERE img.codconteudo = ctn.codconteudo LIMIT 1) as dir
            , (SELECT img.tipo FROM imagens AS img WHERE img.codconteudo = ctn.codconteudo LIMIT 1) as tipo
            FROM conteudo AS ctn
            WHERE ctn.codpagina = ".$cod."
            ";

        if($slug != NULL) $sql .= " AND ctn.slug = '".$slug."' ";

        if($busca != NULL) $sql .= " ".$busca." ";

        if($order != NULL){
            $sql .= " ".$order." ";
        }

        if($limit != NULL) $sql .= "LIMIT ".$limit." ";

        $qry = mysql_query($sql);

        return $qry;

    }

    public static function conteudoCategoria($cod, $cat = NULL, $slug = NULL){

        $sql = "
            SELECT DISTINCT ctn.codconteudo
            , ctn.codcategoria
            , ctn.codsubcategoria
            , ctn.codpagina
            , ctn.slug
            , ctn.titulo
            , ctn.subtitulo
            , ctn.texto
            , ctn.dtcadastro
            , ctn.title
            , ctn.description
            , (SELECT img.imagem FROM imagens AS img WHERE img.codconteudo = ctn.codconteudo ORDER BY listorder ASC LIMIT 1) as img
            , (SELECT img.url FROM imagens AS img WHERE img.codconteudo = ctn.codconteudo LIMIT 1) as dir
            , (SELECT img.tipo FROM imagens AS img WHERE img.codconteudo = ctn.codconteudo LIMIT 1) as tipo
            , cat.slug AS slugcat
            , cat.categoria
            , cat.classe
            FROM conteudo AS ctn
            LEFT JOIN categoria AS cat ON cat.codcategoria = ctn.codcategoria
            WHERE ctn.codpagina = ".$cod."
            ";

        if($cat != NULL){
            $sql .= " AND cat.slug = '".$cat."' ";
        }

        if($slug != NULL){
            $sql .= " AND ctn.slug = '".$slug."' ";
        }

        $sql .= " ORDER BY ctn.listorder ASC ";

        $qry = mysql_query($sql);

        return $qry;
    }

    public static function campoGenerico($codpagina, $codconteudo, $campo = NULL){
        $sql = "SELECT
                cmg.nome
                , cmp.valor
                FROM campovalor AS cmp
                INNER JOIN campogenerico AS cmg ON cmg.codcampo = cmp.codcampo AND cmg.codpagina = ".$codpagina."
                WHERE cmp.codconteudo = ".$codconteudo;
        if($campo != NULL) $sql .= " AND cmg.campo = '".$campo."' ";

        $qry = mysql_query($sql);
        return $qry;
    }

    public static function imagens($codconteudo, $tipo = NULL){
        $sql = "SELECT img.imagem, img.url, img.diretorio, img.title, CONCAT(img.url, img.imagem) as img
                FROM imagens AS img
                WHERE img.codconteudo = ".$codconteudo;
        if($tipo != NULL) $sql .= " AND img.tipo = '".$tipo."' ";
        $sql .= " ORDER BY img.listorder ASC; ";


        $qry = mysql_query($sql);
        return $qry;
    }

    public static function geraCod($tabela, $campo){

        $sql = mysql_query("SELECT ".$campo." FROM ".$tabela." ORDER BY 1 DESC LIMIT 1");
        $qry = mysql_fetch_array($sql);

        if(count($qry) == 0){
            $codigo = 1;
        }else{
            $rs = (object) $qry;
            $codigo = $rs->$campo + 1;
        }
        return $codigo;
    }

    public static function arquivosSlug($codconteudo = NULL, $codpagina = NULL){

        $sql = "SELECT arq.nome as nomearquivo, CONCAT(arq.url, arq.arquivo) as arquivo, con.slug
                FROM arquivos arq
                INNER JOIN conteudo con ON con.codconteudo = arq.codconteudo
                WHERE con.slug = '{$_SESSION['slugproduto']}' ";

        if($codconteudo != NULL){
            $sql .= " AND arq.codconteudo = {$codconteudo} ";
        }

        if($codpagina != NULL){
            $sql .= " AND arq.codpagina = {$codpagina} ";
        }

        $qry = mysql_query($sql);
        return $qry;
    }
    public static function arquivos($codconteudo = NULL, $codpagina = NULL){

        $sql = "SELECT arq.nome as nomearquivo, CONCAT(arq.url, arq.arquivo) as arquivo, con.slug
                FROM arquivos arq
                INNER JOIN conteudo con ON con.codconteudo = arq.codconteudo";

        if($codconteudo != NULL){
            $sql .= " AND arq.codconteudo = {$codconteudo} ";
        }

        if($codpagina != NULL){
            $sql .= " AND arq.codpagina = {$codpagina} ";
        }

        $qry = mysql_query($sql);
        return $qry;
    }

    public static function categoria($cod, $slug = NULL){

        $sql = "SELECT codcategoria, categoria, listorder, slug, classe FROM categoria WHERE codpagina = ".$cod." ";
        if($slug != NULL){
            $sql .= " AND slug = '".$slug."' ";
        }
        $qry = mysql_query($sql);

        return $qry;

    }

    public static function acesso($codpagina = NULL, $codconteudo = NULL){

        $protocolo    = (strpos(strtolower($_SERVER['SERVER_PROTOCOL']),'https') === false) ? 'http' : 'https';
        $host         = $_SERVER['HTTP_HOST'];
        $script       = $_SERVER['SCRIPT_NAME'];
        $UrlAtual     = $protocolo . '://' . $host . $script;
        $ip          =  $_SERVER['REMOTE_ADDR'];
        $dtacadastro = date('Y-m-d H:i:s');

        $sql = "INSERT INTO relacessos (url, ip, dtacadastro, codpagina, codconteudo) VALUES ('".$UrlAtual."', '".$ip."', '".$dtacadastro."', '".$codpagina."', '".$codconteudo."')";
        $qry = mysql_query($sql);
        return $qry;

    }

    public static function cadEmail($nome, $email){
        $sql = "INSERT INTO listaemail (nome, email, dtacadastro) VALUES ('".$nome."', '".$email."', NOW())";
        $qry = mysql_query($sql);
        return $qry;
    }

    public static function metatags(){
        $sql = "SELECT keywords, description, title, favicon FROM metatags";
        $qry = mysql_query($sql);
        return $qry;
    }

    public static function metatagsPage($slug){
        $sql = "SELECT description, title FROM conteudo WHERE slug = '".$slug."'";
        $qry = mysql_query($sql);
        return $qry;
    }



}

?>
