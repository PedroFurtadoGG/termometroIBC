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
$score = isset($_GET['score']) ? $_GET['score'] : 0 ;
$temp = isset($_GET['temp']) ? $_GET['temp'] : '' ;

class fs {
    public static function saveUser($uid, $name, $email, $birthday, $gender, $location){

        $sql = "INSERT INTO `users` (`uid`, `name`, `email`, `birthday`, `gender`, `location`) VALUES ('$uid', '$name', '$email', '$birthday', '$gender', '$location')";

        $this->_pdo->query($sql);

    }
    public static function userExists($uid){

        $sql = "SELECT * FROM `users` WHERE `uid` = '$uid'";

        $res = $this->_pdo->query($sql);

        $total = $res->rowCount();

        if($total > 0)

            return true;

        else

            return false;

    }



    public static function getUser($uid){

        $sql = "SELECT * FROM `users` WHERE `uid` = '$uid'";

        $res = $this->_pdo->query($sql);

        $row = $res->fetch(PDO::FETCH_ASSOC);



        return $row;

    }



    public static function answered($uid){

        $sql = "SELECT * FROM `users` WHERE `uid` = '$uid' AND result IS NOT NULL";

        $res = $this->_pdo->query($sql);

        $total = $res->rowCount();

        if($total > 0)

            return true;

        else

            return false;

    }



    public static function saveArea($uid, $area, $value) {

        $sql = "UPDATE `users` SET $area = '$value' WHERE uid='$uid';";

        $this->_pdo->query($sql);

    }



    public static function saveResult($uid, $area1, $area2, $area3, $area4, $result) {

        $sql = "UPDATE `users` SET area1 = '$area1', area2 = '$area2', area3 = '$area3', area4 = '$area4', result = '$result' WHERE uid='$uid';";

        $this->_pdo->query($sql);

        $user = $this->getUser($uid);

        $sql = "INSERT INTO `results` (area1, area2, area3, area4, result, user_id, created_at) VALUES ('$area1', '$area2', '$area3', '$area4', '$result', '".$user['id']."', NOW());";

        $this->_pdo->query($sql);

    }



    public static function unanswer($uid){

        $sql = "UPDATE `users` SET area1 = NULL, area2 = NULL, area3 = NULL, area4 = NULL, `result` = NULL WHERE uid='$uid'";

        $this->_pdo->query($sql);

    }



    public static function getFriends($uids)

    {

        $uids = implode("','", $uids);

        $sql = "SELECT * FROM `users` WHERE `uid` IN ('$uids') AND `result` IS NOT NULL ORDER BY `result` DESC LIMIT 20";

        $res = $this->_pdo->query($sql);

        $rows = $res->fetchAll(PDO::FETCH_ASSOC);



        return $rows;

    }



    public static function getUsers($page = 1, $limit = 50, $order = '', $direction = 'asc', $search = ''){

        $params = array();

        $sql = "SELECT r.area1, r.area2, r.area3, r.area4, r.result, r.created_at,

                u.uid, u.name, u.email, u.gender, u.location,

                TIMESTAMPDIFF(YEAR, birthday, CURDATE()) AS age

                FROM `results` r JOIN `users` u ON r.user_id = u.id";

        if($search != '')

        {

            $sql .= " WHERE name LIKE :search";

            $params[':search'] = '%'.$search.'%';

        }



        $res = $this->_pdo->prepare($sql);

        $res->execute($params);

        $total = $res->rowCount();



        if($order != '')

        {

            if($order == 'birthday')

            {

                $direction = $direction == 'asc' ? 'desc' : 'asc';

            }

            $sql .= " ORDER BY u.$order $direction";

        }

        else

        {

            $sql .= " ORDER BY r.user_id, r.created_at";

        }

        if ( $limit != 'all' ) {

            $sql .= " LIMIT " . ( ( $page - 1 ) * $limit ) . ", $limit";

        }



        $res = $this->_pdo->prepare($sql);

        $res->execute($params);

        $rows = $res->fetchAll(PDO::FETCH_ASSOC);



        $result         = new stdClass();

        $result->page   = $page;

        $result->limit  = $limit;

        $result->total  = $total;

        $result->data   = $rows;



        return $result;

    }



    public static function getUsersExport(){

        $sql = "SELECT u.name, u.email, u.gender, u.location,

                TIMESTAMPDIFF(YEAR, birthday, CURDATE()) AS age,

                r.area1, r.area2, r.area3, r.area4, r.result,  DATE_FORMAT(r.created_at, '%d/%m/%Y %T')

                FROM `results` r JOIN `users` u ON r.user_id = u.id

                ORDER BY r.user_id, r.created_at";

        $result = $this->_pdo->query($sql);



        $rows = array();

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

            $rows[] = $row;

        }



        return $rows;

    }



    public static function getStats() {

        $stats = new stdClass();



        $sql = "SELECT count(*) as total FROM users;";

        $res = $this->_pdo->query($sql);

        $row = $res->fetch(PDO::FETCH_ASSOC);

        $stats->total = $row['total'];



        $sql = "SELECT count(*) as answers FROM users WHERE result IS NOT NULL;";

        $res = $this->_pdo->query($sql);

        $row = $res->fetch(PDO::FETCH_ASSOC);

        $stats->answers = $row['answers'];



        $sql = "SELECT count(*) as incomplete FROM users WHERE result IS NULL;";

        $res = $this->_pdo->query($sql);

        $row = $res->fetch(PDO::FETCH_ASSOC);

        $stats->incomplete = $row['incomplete'];



        $sql = "SELECT count(*) as shares FROM users WHERE shared = 1;";

        $res = $this->_pdo->query($sql);

        $row = $res->fetch(PDO::FETCH_ASSOC);

        $stats->shares = $row['shares'];





        $sql = "SELECT 

                count(*) as total, 

                (SUM(area1)/count(*)) as area1, 

                (SUM(area2)/count(*)) as area2, 

                (SUM(area3)/count(*)) as area3,  

                (SUM(area4)/count(*)) as area4

                FROM users WHERE result IS NOT NULL";

        $res = $this->_pdo->query($sql);

        $rows = $res->fetchAll(PDO::FETCH_ASSOC);

        $stats->level = $rows;



        $sql = "SELECT count(gender) as counter, gender FROM users GROUP BY gender;";

        $res = $this->_pdo->query($sql);

        $rows = $res->fetchAll(PDO::FETCH_ASSOC);

        $stats->gender = $rows;



        //Por Temperatura

        $sql = "SELECT result FROM results;";

        $res = $this->_pdo->query($sql);

        $rows = $res->fetchAll(PDO::FETCH_ASSOC);

        $temp = array('Frio' =>0,'Morno' =>0,'Quente' =>0);

        foreach($rows as $l) {

           if ($l['result']<34 and $l['result']>0) {

                $temp['Frio'] += $l['result'];

            } elseif ($l['result']<67) {

                $temp['Morno'] += $l['result'];

            } elseif ($l['result']<101) {

                $temp['Quente'] += $l['result'];

            }

        }

        $stats->temp = $temp;





        //Top 5 cidade mais felizes

        $sql = "SELECT 

                (SUM(result)/count(*)) as total, location

                FROM users WHERE result IS NOT NULL AND result>50 GROUP BY location ORDER BY SUM(result); LIMIT 0,5";

        $res = $this->_pdo->query($sql);

        $rows = $res->fetchAll(PDO::FETCH_ASSOC);

        $stats->city = $rows;



        //Top 5 cidade menos felizes

        $sql = "SELECT 

                (SUM(result)/count(*)) as total, location

                FROM users WHERE result IS NOT NULL AND result<50 GROUP BY location ORDER BY SUM(result); LIMIT 0,5";

        $res = $this->_pdo->query($sql);

        $rows = $res->fetchAll(PDO::FETCH_ASSOC);

        $stats->cityLess = $rows;



        //Pontuação média por faixa de idade

        $sql = "SELECT 

                (SUM(result)/count(*)) as total, 

                YEAR(CURDATE())-YEAR(birthday) as birthday,

                gender

                FROM users WHERE result IS NOT NULL GROUP BY YEAR(birthday), gender ORDER BY gender, SUM(result);";

        $res = $this->_pdo->query($sql);

        $rows = $res->fetchAll(PDO::FETCH_ASSOC);

        $faixa = array();

        foreach($rows as $age) {

            if ($age['gender'] == '') { continue;  }

            if($age['birthday']<21){ $faixa[0][$age['gender']] = (int) $age['total']; }

            elseif ($age['birthday']<31) { $faixa[1][$age['gender']] = (int) $age['total'];}

            elseif ($age['birthday']<41) { $faixa[2][$age['gender']] = (int) $age['total'];}

            elseif ($age['birthday']<51) { $faixa[3][$age['gender']] = (int) $age['total']; }

            else {  $faixa[4][$age['gender']] = (int) $age['total']; }

        }

        

        $stats->age = $faixa;



        //Participação por faixa de idade

        $sql = "SELECT 

                count(*) as total, 

                YEAR(CURDATE())-YEAR(birthday) as birthday

                FROM users WHERE result IS NOT NULL GROUP BY YEAR(birthday) ORDER BY SUM(result);";

        $res = $this->_pdo->query($sql);

        $rows = $res->fetchAll(PDO::FETCH_ASSOC);

        $faixa = array();

        foreach($rows as $age) {

            if($age['birthday']<21){ $faixa[0][] = (int) $age['total']; }

            elseif ($age['birthday']<31) { $faixa[1][] = (int) $age['total'];}

            elseif ($age['birthday']<41) { $faixa[2][] = (int) $age['total'];}

            elseif ($age['birthday']<51) { $faixa[3][] = (int) $age['total']; }

            else {  $faixa[4][] = (int) $age['total']; }

        }

        foreach ($faixa as $k => $value) {

            if(!is_array($faixa[$k])){

                unset($faixa[$k]);

            } else {

                $total = array_sum($faixa[$k])/count($faixa[$k]);

                unset($faixa[$k]);

                $faixa[$k] = (int) $total ;

            }

        }

        

        $stats->agePar = $faixa;

        // Quantidade de pessoas felizes por área.

        $sql = "SELECT 
        SUM( IF(`area1` > 66, 1, 0) ) as area1_feliz
        , SUM( IF(`area2` > 66, 1, 0) ) as area2_feliz
        , SUM( IF(`area3` > 66, 1, 0) ) as area3_feliz
        , SUM( IF(`area4` > 66, 1, 0) ) as area4_feliz
        FROM results";

        $res = $this->_pdo->query($sql);

        $rows = $res->fetchAll(PDO::FETCH_ASSOC);

        $stats->happinessArea = $rows[0];        

        // Quantidade de pessoas infelizes por área.

        $sql = "SELECT 
        SUM( IF(`area1` < 34, 1, 0) ) as area1_infeliz
        , SUM( IF(`area2` < 34, 1, 0) ) as area2_infeliz
        , SUM( IF(`area3` < 34, 1, 0) ) as area3_infeliz
        , SUM( IF(`area4` < 34, 1, 0) ) as area4_infeliz
        FROM results";

        $res = $this->_pdo->query($sql);

        $rows = $res->fetchAll(PDO::FETCH_ASSOC);

        $stats->unhappinessArea = $rows[0];        

        return $stats;

    }



    public static function export($test, $date)

    {

        switch($test)

        {

            case 'behaviour':

                $query = "SELECT nome AS name, email, inicio AS created_at FROM `ibc_facebook`.`ibc`";

                if($date != '')

                {

                    $query .= " WHERE inicio >= '$date'";

                }

                break;

            case 'personality':

                $query = "SELECT nome AS name, email, dt_criacao AS created_at FROM `ibc_testepersonalidade`.`cadastros`";

                if($date != '')

                {

                    $query .= " WHERE dt_criacao >= '$date'";

                }

                break;

            case 'happiness':

                $query = "SELECT name, email, created_at FROM `ibc_termometrofelicidade`.`users`";

                if($date != '')

                {

                    $query .= " WHERE created_at >= '$date'";

                }

                break;

            default:

                $query = '';

        }



        if($query != '') {

            $result = $this->_pdo->query($query);



            $file = "nome,email,data\n";

            $filename = "$test-".($date == '' ? 'all' : $date).".csv";



            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

                $file .= $row['name'] . ',' . $row['email'] . ',' . $row['created_at'] . "\n";

            }



            file_put_contents($filename, $file);



            return $filename;

        }

    }



    public static function sendUserToRdStation($uid, $tag = 'app-termometro')

    {

        $user = $this->getUser($uid);



        $api_url = "http://www.rdstation.com.br/api/1.2/conversions";



        if($user)

        {

            $data_array = array("token_rdstation" => '0b41d361e237d20513c7ec207b8b5e45', 'identificador' => $tag);

            $data_array['email'] = $user['email'];

            $data_array['nome'] = $user['name'];

            if($tag=='app-termometro-finalizou'){

                if ($user['result']<34 and $user['result']>0) {

                    $data_array['termometro_temperatura'] = 'Frio';               

                } elseif ($user['result']<67) {

                    $data_array['termometro_temperatura'] = 'Morno';

                } elseif ($user['result']<101) {

                    $data_array['termometro_temperatura'] = 'Quente';

                }

                $data_array['termometro_pontuacao'] = $user['result'];

            }

            $data_array['created_at'] = $user['created_at'];



            try {

                $data_query = http_build_query($data_array);

                $ch = curl_init($api_url);

                curl_setopt($ch, CURLOPT_POST, 1);

                curl_setopt($ch, CURLOPT_POSTFIELDS, $data_query);

                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

                curl_exec($ch);

                curl_close($ch);

            } catch(Exception $e){ }

        }

    }



    public static function getQuestions($area = '')

    {

        if($area == '')

        {

            $sql = "SELECT * FROM `questions` ORDER BY `order`";

        }

        else

        {

            $sql = "SELECT * FROM `questions` WHERE `area` = '$area' ORDER BY `order`";

        }



        $res = $this->_pdo->query($sql);

        $rows = $res->fetchAll(PDO::FETCH_ASSOC);



        return $rows;

    }



    public static function insertQuestion($text, $category)

    {

        $sql = "INSERT INTO `questions` (`text`, `category`, `area`, `order`) SELECT :text, :category, IF(MAX(`area`) IS NOT NULL, MAX(`area`), 'area1'), MAX(`order`) + 1 FROM `questions`";

        $res = $this->_pdo->prepare($sql);

        $res->execute(array(':text' => $text, ':category' => $category));



        $id = $this->_pdo->lastInsertId();

        $sql = "SELECT * FROM `questions` WHERE id = $id";

        $res = $this->_pdo->query($sql);

        return $res->fetch(PDO::FETCH_ASSOC);

    }



    public static function deleteQuestion($question_id)

    {

        $sql = "DELETE FROM `questions` WHERE id = $question_id LIMIT 1";

        $this->_pdo->exec($sql);

    }



    public static function updateQuestionOrder($question_id, $area, $order)

    {

        $sql = "UPDATE `questions` SET `area` = '$area', `order` = $order WHERE id = $question_id LIMIT 1";

        $this->_pdo->exec($sql);

    }



}
