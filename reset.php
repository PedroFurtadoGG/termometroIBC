<?php
session_start();

if($_SESSION['uid'] != '') {
    require 'functions/Database.class.php';

    $database = new Database();

    $database->unanswer($_SESSION['uid']);
}
?>