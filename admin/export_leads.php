<?php
session_start();
set_time_limit(0);

if(!isset($_SESSION['admin'])) {
    header("Location: index.php");
    exit(0);
}

require_once('../functions/Database.class.php');
$database = new Database();
$date = isset($_GET['date']) ? $_GET['date'] : '';
$test = isset($_GET['test']) ? $_GET['test'] : '';

$dates = file_get_contents('.exportdates');
?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>
    <link href="css/style.css" type="text/css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/themes/smoothness/jquery-ui.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/jquery-ui.min.js"></script>
    <script type="text/javascript" language="JavaScript" src="js/script.js"></script>
</head>
<body>
<div class="main-content">
    <header><a href="index.php">Ver Resultados</a> | <a href="export.php">Exportar Resultados</a> | <a href="questions.php">Perguntas</a> | <a href="logout.php">Logout</a> </header>
    <h1>Área Administrativa - Exportar Leads</h1>

    <div id="users-data">
        <div class="filter-box">
            <div class="search">
                <form action="export_leads.php" method="get">
                    <label for="date">Data: </label>
                    <input type="text" name="date" id="date" value="<?php echo $date ?>" />
                    <label for="test">Teste: </label>
                    <select name="test" id="test">
                        <option value="behaviour"<?php echo $test == 'behaviour' ? ' selected="selected"' : '' ?>>Perfil Comportamental</option>
                        <option value="personality"<?php echo $test == 'personality' ? ' selected="selected"' : '' ?>>Teste de Personalidade</option>
                        <option value="happiness"<?php echo $test == 'happiness' ? ' selected="selected"' : '' ?>>Termômetro da Felicidade</option>
                    </select>
                    <input type="submit" value="Exportar" />
                </form>
            </div>
            <div class="clear"></div>
            <div class="last-export-date">Última data de exportação: <span></span></div>
            <div class="note"><strong>Nota:</strong> Deixe a data em branco para exportar todos os leads de um teste. <span></span></div>
        </div>
        <?php
        if($test != ''){
            $date_export = '';
            if($date != '')
            {
                $date_export = date('Y-m-d', strtotime(str_replace('/', '-', $date)));
            }
            $file = $database->export($test, $date_export);
            $dates = json_decode($dates);
            $dates->$test = date('d/m/Y');
            $dates = json_encode($dates);
            file_put_contents('.exportdates', $dates);
            ?>
            <div class="download-link">
                <a href="<?php echo $file?>"><?php echo $file?></a>
            </div>
        <?php } ?>
    </div>
    <div class="clear"></div>
</div>
<script type="text/javascript" language="JavaScript">
    changeExportDate(<?php echo $dates ?>)
</script>
</body>
</html>