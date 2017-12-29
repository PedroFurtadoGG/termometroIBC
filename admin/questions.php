<?php
session_start();

if(!isset($_SESSION['admin'])) {
    header("Location: index.php");
    exit(0);
}

require_once('../functions/Database.class.php');
$database = new Database();

$areas = array("Pessoal", "Profissional", "dos Relacionamentos", "da Qualidade de Vida")

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
    <header><a href="index.php">Ver Resultados</a> | <a href="export.php">Exportar Resultados</a> | <a href="export_leads.php">Exportar Leads</a> | <a href="logout.php">Logout</a> </header>
    <h1>Área Administrativa - Perguntas</h1>
    <div class="filter-box">
        <div class="search">
            <form action="add_question.php" method="get" class="remote-form" id="add-question-form">
                <label for="text">Pergunta: </label>
                <textarea name="text" id="text" maxlength="255"></textarea><br />
                <label for="category">Categoria: </label>
                <input type="text" name="category" id="category" maxlength="255">
                <input type="submit" value="Adicionar" />
            </form>
        </div>
        <div class="clear"></div>
    </div>
    <div class="questions-box">
        <?php for($i = 1; $i <= 4; $i++){
            $questions = $database->getQuestions("area$i"); ?>
            <h3>Ambiente <?php echo $areas[$i-1] ?></h3>
            <div id="area<?php echo $i ?>" class="questions">
                <?php foreach($questions as $question) : ?>
                    <div class="question" id="<?php echo $question['id'] ?>"><strong><?php echo $question['category'] ?>:</strong> <?php echo $question['text'] ?> <a href="delete_question.php?id=<?php echo $question['id']?>" class="button red small remote-link">Apagar</a><div class="clear"></div></div>
                <?php endforeach; ?>
            </div>
        <?php } ?>
        <div class="clear"></div>
    </div>
    <div class="clear"></div>
</div>
</body>
</html>