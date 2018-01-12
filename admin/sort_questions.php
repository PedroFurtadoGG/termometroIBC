<?php

session_start();

if(!isset($_SESSION['admin'])) {
    header("Location: index.php");
    exit(0);
}

//header('Content-Type: application/javascript');

require_once('../functions/Database.class.php');
$database = new Database();

$area1 = isset($_POST['area1']) ? $_POST['area1'] : array();
$area2 = isset($_POST['area2']) ? $_POST['area2'] : array();
$area3 = isset($_POST['area3']) ? $_POST['area3'] : array();
$area4 = isset($_POST['area4']) ? $_POST['area4'] : array();

$order = 0;
foreach($area1 as $question_id)
{
    $database->updateQuestionOrder($question_id, 'area1', $order);
    $order++;
}

foreach($area2 as $question_id)
{
    $database->updateQuestionOrder($question_id, 'area2', $order);
    $order++;
}

foreach($area3 as $question_id)
{
    $database->updateQuestionOrder($question_id, 'area3', $order);
    $order++;
}

foreach($area4 as $question_id)
{
    $database->updateQuestionOrder($question_id, 'area4', $order);
    $order++;
}