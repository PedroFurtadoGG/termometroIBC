<?php require_once('functions.php'); ?><!DOCTYPE html>
<?php
$score = isset($_GET['score']) ? $_GET['score'] : 0 ;
$temp = isset($_GET['temp']) ? $_GET['temp'] : '' ;
?>

    <!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->

    <!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
    
    <!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->

    <!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <title>IBC - Termômetro da felicidade</title>

    <meta name="title" content="Teste Term&ocirc;metro da Felicidade" />

    <meta name="description" content="Teste Term&ocirc;metro da Felicidade do Instituto Brasileiro de Coaching." />

    <?php /*if($user['result']){ ?>

        <meta property="og:title" content="Meu Term&ocirc;metro da Felicidade do IBC Coaching deu <?php $user['result'] ?>°C" />

    <?php } else { ?>

        <meta property="og:title" content="Quer saber seu grau de felicidade?" />

    <?php } */?>

<?php

if ($score<34 and $score>0) {

    echo '<meta name="og:image" content="'.$url.'/library/images/share/termometro-resultado-frio.png" />';

} elseif ($score<67) {

    echo '<meta name="og:image" content="'.$url.'/library/images/share/termometro-resultado-morno.png" />';

} elseif ($score<101) {

    echo '<meta name="og:image" content="'.$url.'/library/images/share/termometro-resultado-quente.png" />';

} else{

    echo '<meta name="og:image" content="'.$url.'/library/images/share/termometro-da-felicidadde.jpg" />';

}

?>

    <meta name="og:title" content="Meu Term&ocirc;metro da Felicidade do IBC Coaching deu <?php echo $score; ?>°C" />

    <meta name="og:description" content="Faça o teste do IBC e receba dicas exclusivas!" />

    <meta name="og:site_name" content="Teste Term&ocirc;metro da Felicidade" />

    <meta name="og:type" content="website" />

    <link rel="icon" href="<?php echo $url ?>/library/images/favicon.ico" type="image/x-icon">

    <link rel="shortcut icon" href="<?php echo $url ?>/library/images/favicon.ico" type="image/x-icon">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href='https://fonts.googleapis.com/css?family=Dosis:200,300,400,500,600,700,800' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="<?php echo $url;?>/library/css/modal.css">
    <link rel="stylesheet" href="<?php echo $url ?>/library/css/main.css">

</head>
