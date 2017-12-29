<?php
session_start();

if($_SESSION['uid'] != '') {

	$rede = isset($_POST['rede']) ? '-'.$_POST['rede'] : '';

    require 'functions/Database.class.php';

    $database = new Database();
    $database->sendUserToRdStation($_SESSION['uid'],'app-termometro'.$rede);

    
    
    
}
?>