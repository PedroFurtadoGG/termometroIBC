<?php

session_start();
$url = "https://www.ibccoaching.com.br/app-termometro-felicidade/";

require 'functions/facebook.php';
require 'functions/Database.class.php';

// cookie e domain foi preciso para postar foto

$facebook = new Facebook ( array (
    'appId' => '1564646373786380',
    'secret' => 'f14c3e9beeb924d23effc2ed836b9135',
    'cookie' => TRUE,
    'domain' => $_SERVER ['SERVER_NAME']
) );

$database = new Database();

// user_photos foi para postar foto

$params = array (
    'scope' => 'email, user_birthday, read_stream, user_photos, user_friends',
    'redirect_uri' => 'https://apps.facebook.com/1564646373786380/'
);

$_SESSION['uid'] = $userid = $facebook->getUser();

if ($userid) {
    try {
        $user = $facebook->api ( '/me' );
        $friends = $facebook->api('/me/friends');
    }
    catch ( FacebookApiException $e ) {
        error_log ( $e );
        $userid = null;
    }

}

// o alguma coisa eh porque se colocar direto no setFileUploadSupport da erro

// fileuploadsupport eh para subir imagens para o album
if ($userid) {
    $url_to_upload = $url;
    $facebook->setFileUploadSupport ( $url_to_upload );
    $user_name = $user ['name'];
    //$user_uname = $user['username'];
    $user_gender = $user ['gender'];
    $user_email = $user ['email'];
    $user_home_town = $user ['hometown'] ['name'];
    $user_birthday = $user ['birthday'];
    if(!$database->userExists($userid)){
        $database->saveUser($userid, $user_name, $user_email, date('Y-m-d', strtotime($user_birthday)), $user_gender, $user_home_town);
        $database->sendUserToRdStation($userid);
    }
    $user = $database->getUser($userid);
} else {
    $loginUrl = $facebook->getLoginUrl ( $params );
}
?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>IBC - Termômetro da felicidade</title>
    <meta name="title" content="Teste Term&ocirc;metro da Felicidade" />
    <meta name="description" content="Teste Term&ocirc;metro da Felicidade do Instituto Brasileiro de Coaching." />
    <?php if($user['result']){ ?>
        <meta property="og:title" content="Meu Term&ocirc;metro da Felicidade do IBC Coaching deu <?php $user['result'] ?>°C" />
    <?php } else { ?>
        <meta property="og:title" content="Term&ocirc;metro da Felicidade do IBC Coaching" />
    <?php } ?>
    <meta property="og:image" content="<?php echo $url ?>/library/images/termometro-da-felicidadde.jpg" />
    <meta property="og:description" content="Quer saber seu grau de felicidade? Faça o teste e receba dicas exclusivas!" />
    <meta property="fb:app_id" content="<?php echo $facebook->getAppId();?>" />
    <meta property="og:url" content="https://apps.facebook.com/1564646373786380/" />
    <meta property="og:site_name" content="Teste Term&ocirc;metro da Felicidade" />
    <meta property="og:type" content="website" />
    <link rel="icon" href="<?php echo $url ?>/images/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="<?php echo $url ?>/images/favicon.ico" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href='https://fonts.googleapis.com/css?family=Dosis:200,300,400,500,600,700,800' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="library/css/main.css">
</head>
<body>
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = "https://connect.facebook.net/pt_BR/all.js#xfbml=1&appId=<?php echo $facebook->getAppId()?>";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>
    <section id="wrapper">
