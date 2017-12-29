<?php

session_start();

if(!isset($_SESSION['admin'])) {
    header("Location: index.php");
    exit(0);
}

header('Content-Type: application/javascript');

require_once('../functions/Database.class.php');
$database = new Database();

$text = isset($_POST['text']) ? $_POST['text'] : '';
$category = isset($_POST['category']) ? $_POST['category'] : '';

if($text != '' and $category != '') {
    $question = $database->insertQuestion($text, $category);

    ?>

    $('#<?php echo $question['area'] ?>').append('<div class="question" id="<?php echo $question['id'] ?>"><strong><?php echo $question['category'] ?>:</strong> <?php echo $question['text'] ?> <a href="delete_question.php?id=<?php echo $question['id']?>" class="button red small remote-link">Apagar</a><div class="clear"></div></div>');
    $('#text').val('');
    $('#category').val('');

<?php
}
?>