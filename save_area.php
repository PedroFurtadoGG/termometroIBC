<?php
session_start();

if($_SESSION['uid'] != '') {
    require 'functions/Database.class.php';

    $database = new Database();

    $areas = array('area1', 'area2', 'area3', 'area4');

    $area = isset($_POST['area']) ? $_POST['area'] : '';
    $value = isset($_POST['value']) ? $_POST['value'] : '';

    if ($area != '' and in_array($area, $areas) and $value != '') {
        $database->saveArea($_SESSION['uid'], $area, $value);
    }
}
?>