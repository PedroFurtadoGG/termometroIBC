<?php
session_start();
if(isset($_POST['user'])) {
    if($_POST['user'] == 'termometroadmin' and md5($_POST['pass']) == '3e65cf72840727a918d663d70853a3f9')
    {
        $_SESSION['admin'] = true;
    } else {
        $error_message = 'Usuário ou senha incorretos!';
    }
}

if(isset($_SESSION['admin'])) {
    require_once('../functions/Database.class.php');
    require_once('../functions/Paginator.class.php');
    $database = new Database();
    $limit = (isset($_GET['limit'])) ? $_GET['limit'] : 25;
    $page = (isset($_GET['page'])) ? $_GET['page'] : 1;
    $order = (isset($_GET['order'])) ? $_GET['order'] : '';
    $direction = (isset($_GET['direction'])) ? $_GET['direction'] : 'asc';
    $search = (isset($_GET['search'])) ? $_GET['search'] : '';
}
?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>
    <link href="css/style.css" type="text/css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script type="text/javascript" language="JavaScript" src="js/highcharts.js"></script>
    <script type="text/javascript" language="JavaScript" src="js/script.js"></script>
</head>
<body>
<div class="main-content">
    <?php if(isset($_SESSION['admin'])) { ?>
        <header><a href="export.php">Exportar Resultados</a> | <a href="export_leads.php">Exportar Leads</a> | <a href="questions.php">Perguntas</a> | <a href="logout.php">Logout</a> </header>
        <h1>Área Administrativa - Termômetro da Felicidade</h1>

        <div class="tabs">
            <div class="tab active" data-target="users-data">Resultados dos Participantes</div>
            <div class="tab" data-target="graphics">Visão Geral dos Participantes</div>
            <div class="clear"></div>
        </div>
        <div id="users-data">
            <div class="filter-box">
                <div class="search">
                    <form action="index.php" method="get">
                        <input type="hidden" name="order" value="<?php echo $order ?>" />
                        <label for="search">Procurar: </label>
                        <input type="text" name="search" id="search" value="<?php echo $search ?>" />
                        <input type="submit" value="Buscar" />
                    </form>
                </div>
                <div class="order">
                    <form action="index.php" method="get">
                        <input type="hidden" name="search" value="<?php echo $search ?>" />
                        <input type="hidden" name="page" value="<?php echo $page ?>" />
                        <input type="hidden" name="limit" value="<?php echo $limit ?>" />
                        <label for="order">Ordenar Por: </label>
                        <select name="order" id="order">
                            <option value="name"<?php echo $order == 'name' ? ' selected="selected"' : '' ?>>Nome</option>
                            <option value="birthday"<?php echo $order == 'birthday' ? ' selected="selected"' : '' ?>>Idade</option>
                            <option value="gender"<?php echo $order == 'gender' ? ' selected="selected"' : '' ?>>Sexo</option>
                            <option value="location"<?php echo $order == 'location' ? ' selected="selected"' : '' ?>>Localidade</option>
                            <option value="result"<?php echo $order == 'result' ? ' selected="selected"' : '' ?>>Resultado</option>
                        </select>
                        <input type="radio" name="direction" value="asc" id="direction_asc"<?php echo $direction != 'desc' ? ' checked="checked"' : '' ?> />
                        <label for="direction_asc">Ascendente</label>
                        <input type="radio" name="direction" value="desc" id="direction_desc"<?php echo $direction == 'desc' ? ' checked="checked"' : '' ?> />
                        <label for="direction_desc">Descendente</label>
                    </form>
                </div>
                <a href="index.php">RESET</a>
                <div class="clear"></div>
            </div>
            <?php
            $result = $database->getUsers($page, $limit, $order, $direction, $search);
            ?>
            <table cellpadding="3" cellspacing="0" align="center" class="users">
                <thead>
                <tr>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Idade</th>
                    <th>Sexo</th>
                    <th>Local</th>
                    <th>Resultado</th>
                    <th>Amb. 1</th>
                    <th>Amb. 2</th>
                    <th>Amb. 3</th>
                    <th>Amb. 4</th>
                    <th>Data</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($result->data as $user) : ?>
                    <tr>
                        <td><?php echo $user['name']?></td>
                        <td><?php echo $user['email']?></td>
                        <td><?php echo $user['age']?></td>
                        <td><?php echo $user['gender']?></td>
                        <td><?php echo $user['location']?></td>
                        <td><?php echo $user['result']?></td>
                        <td><?php echo $user['area1']?></td>
                        <td><?php echo $user['area2']?></td>
                        <td><?php echo $user['area3']?></td>
                        <td><?php echo $user['area4']?></td>
                        <td><?php echo is_null($user['created_at']) ? '' : date('d/m/Y', strtotime($user['created_at'])); ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            <?php
            $paginator = new Paginator($result->page, $result->limit, $result->total);
            echo $paginator->createLinks(10, 'pagination', array('search' => $search, 'order' => $order, 'direction' => $direction));
            ?>
        </div>
        <div id="graphics" class="hide">
            <div class="stats">
                <?php $stats = $database->getStats(); ?>
                <div>Total de acessos: <?php echo number_format($stats->total, 0, ',', '.') ?></div>
                <div>Total de respostas: <?php echo number_format($stats->answers, 0, ',', '.') ?></div>
                <div>Total de desistentes: <?php echo number_format($stats->incomplete, 0, ',', '.') ?></div>
                <div>Resultados Compartilhados: <?php echo number_format($stats->shares, 0, ',', '.') ?></div>
                <div class="clear"></div>
            </div>
            <div id="nivel-felicidade" class="grafico"></div>
            <div id="gender-graphic" class="grafico"></div>
            <div id="city-graphic" class="grafico"></div>
            <div id="city-less-graphic" class="grafico"></div>
            <div id="age-graphic" class="grafico"></div>
            <div id="agepart-graphic" class="grafico"></div>
            <div id="temp-felicidade" class="grafico"></div>
            <div id="happinessarea-graphic" class="grafico"></div>
            <div id="unhappinessarea-graphic" class="grafico"></div>

            <br style="clear:both" />
            
        </div>
        <div class="clear"></div>
    <?php }else{ ?>
        <div class="login-form">
            <?php if(isset($error_message)) { ?>
            <div class="error-msg"><?php echo $error_message ?></div>
            <?php } ?>
            <form action="" method="post">
                <div class="field">
                    <label for="user">Usuário</label>
                    <input type="text" name="user" id="user" />
                </div>
                <div class="field">
                    <label for="pass">Senha</label>
                    <input type="password" name="pass" id="pass" />
                </div>
                <div class="field">
                    <input type="submit" value="Logar" />
                </div>
            </form>
        </div>
    <?php } ?>
</div>
<?php
if(isset($_SESSION['admin'])) {
    $level = $stats->level[0];    
    $stats_level .= "[
        {name:'AMBIENTE PESSOAL', data:[".$level['area1']."]},
        {name:'AMBIENTE PROFISSIONAL',  data:[".$level['area2']."]},
        {name:'AMBIENTE DOS RELACIONAMENTOS',  data:[".$level['area3']."]},
        {name:'AMBIENTE DA QUALIDADE DE VIDA',  data:[".$level['area4']."]}
    ]";
    $stats_gender = '[';
    foreach($stats->gender as $gender) {
        switch($gender['gender']) {
            case 'male': $name = 'Homens';  break;
            case 'female': $name = 'Mulheres'; break;
            case '': $name = 'Indefinido'; break;
            default: $name = $gender['name'];
        }
        $stats_gender .= "['". $name ."', $gender[counter]],";
    }
    $stats_gender = rtrim($stats_gender, ',').']';
    $stats_city = '[';
    foreach($stats->city as $city) {
        if($city['location']==''){ $city['location'] = 'Indefinido'; }
        $stats_city .= "{name:'". $city['location'] ."', data:[". $city['total'] ."]},";
    }
    $stats_city = rtrim($stats_city, ',').']';
    $stats_cityLess = '[';
    foreach($stats->cityLess as $cityLess) {
        if($cityLess['location']==''){ $cityLess['location'] = 'Indefinido'; }
        $stats_cityLess .= "{name:'". $cityLess['location'] ."', data:[". $cityLess['total'] ."]},";
    }
    $stats_cityLess = rtrim($stats_cityLess, ',').']';

    //TEMPERATURA
    $stats_temp = '[';
    foreach($stats->temp as $k => $temp) {
        $stats_temp .= "['". $k ."', $temp],";
    }
    $stats_temp = rtrim($stats_temp, ',').']';

    //Pontuação média por faixa de idade
    $stats_age = '[';
    foreach($stats->age as $key => $age) {
        foreach($age as $gender => $valor) {
            $gender = $gender == 'male' ? 'Masculino' : 'Feminino'; 
            switch($key) {
                case 0: $name = 'até 20 anos';  break;
                case 1: $name = 'entre 20 e 30'; break;
                case 2: $name = 'entre 31 e 40'; break;
                case 3: $name = 'entre 41 e 50'; break;
                case 4: $name = 'mais de 50 anos'; break;
            }
            $stats_age .= "{name:'". $gender.' '.$name ."', data:[". $valor ."]},";
        }
    }
    $stats_age = rtrim($stats_age, ',').']';

    //Participação por faixa de idade

    $stats_age_par = '[';
    foreach($stats->agePar as $key => $total) {

        switch($key) {
            case 0: $name = 'Até 20 anos';  break;
            case 1: $name = 'Entre 20 e 30'; break;
            case 2: $name = 'Entre 31 e 40'; break;
            case 3: $name = 'Entre 41 e 50'; break;
            case 4: $name = 'Mais de 50 anos'; break;
        }
        $stats_age_par .= "['". $name ."', ". $total ."],";
    }
    $stats_age_par = rtrim($stats_age_par, ',').']';

    // Quantidade de pessoas felizes por área

    $stats_happiness_area = '[';
    foreach($stats->happinessArea as $key => $total) {

        switch($key) {
            case 'area1_feliz': $name = 'AMBIENTE PESSOAL';  break;
            case 'area2_feliz': $name = 'AMBIENTE PROFISSIONAL';  break;
            case 'area3_feliz': $name = 'AMBIENTE DOS RELACIONAMENTOS';  break;
            case 'area4_feliz': $name = 'AMBIENTE DA QUALIDADE DE VIDA';  break;
        }
        $stats_happiness_area .= "['". $name ."', ". $total ."],";
    }
    $stats_happiness_area = rtrim($stats_happiness_area, ',').']';

    // Quantidade de pessoas infelizes por área

    $stats_unhappiness_area = '[';
    foreach($stats->unhappinessArea as $key => $total) {

        switch($key) {
            case 'area1_infeliz': $name = 'AMBIENTE PESSOAL';  break;
            case 'area2_infeliz': $name = 'AMBIENTE PROFISSIONAL';  break;
            case 'area3_infeliz': $name = 'AMBIENTE DOS RELACIONAMENTOS';  break;
            case 'area4_infeliz': $name = 'AMBIENTE DA QUALIDADE DE VIDA';  break;
        }
        $stats_unhappiness_area .= "['". $name ."', ". $total ."],";
    }
    $stats_unhappiness_area = rtrim($stats_unhappiness_area, ',').']';

    ?>
    <script type="text/javascript" language="JavaScript">
        genderGraphic(<?php echo $stats_gender ?>, 'Divisão por Gênero','#gender-graphic');
        genderGraphicColuna(<?php echo $stats_level ?>, 'Média de Felicidade geral por área','Pts de Felicidade','#nivel-felicidade');
        genderGraphicColuna(<?php echo $stats_city ?>, 'Top 5 cidade mais felizes', 'Cidades', '#city-graphic');
        genderGraphicColuna(<?php echo $stats_cityLess ?>, 'Top 5 cidade menos felizes', 'Cidades', '#city-less-graphic');
        genderGraphicColuna(<?php echo $stats_age ?>, 'Pontuação média por faixa de idade e gênero', 'Faixa por Idade e gênero','#age-graphic');
        genderGraphic(<?php echo $stats_age_par ?>, 'Participação por faixa de idade','#agepart-graphic');
        genderGraphic(<?php echo $stats_temp ?>, 'Resultado por Temperatura','#temp-felicidade');
        genderGraphic(<?php echo $stats_happiness_area ?>, 'Quantidade de pessoas felizes por área','#happinessarea-graphic');
        genderGraphic(<?php echo $stats_unhappiness_area ?>, 'Quantidade de pessoas infelizes por área','#unhappinessarea-graphic');
    </script>
<?php } ?>
</body>
</html>