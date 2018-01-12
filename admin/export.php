<?php
session_start();
set_time_limit(0);

if(!isset($_SESSION['admin'])) {
    header("Location: index.php");
    exit(0);
}

header('Content-Disposition: attachement;filename="termometro.csv";');

require_once('../functions/Database.class.php');
$database = new Database();

$rows = $database->getUsersExport();

$out = fopen('php://output', 'w');

fputcsv($out, explode(',', "Nome,Email,Sexo,Local,Idade,Ambiente 1,Ambiente 2,Ambiente 3,Ambiente 4,Resultado,Data"));
foreach($rows as $row)
{
    fputcsv($out, $row);
}
fclose($out);

?>