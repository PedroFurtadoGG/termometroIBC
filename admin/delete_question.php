<?php

session_start();

if(!isset($_SESSION['admin'])) {
    header("Location: index.php");
    exit(0);
}

header('Content-Type: application/javascript');

require_once('../functions/Database.class.php');
$database = new Database();

$id = isset($_GET['id']) ? $_GET['id'] : '';

if($id != '') {
    $database->deleteQuestion($id);

    ?>

    $('#<?php echo $id ?>').remove();

<?php
}
?>