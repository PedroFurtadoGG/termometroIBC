<?php

session_start();





$url = "https://www.ibccoaching.com.br/app-termometro-felicidade/";



$score = isset($_GET['score']) ? $_GET['score'] : 0 ;

$temp = isset($_GET['temp']) ? $_GET['temp'] : '' ;



require 'functions/facebook.php';

require 'functions/Database.class.php';



// cookie e domain foi preciso para postar foto

$appId = '1564646373786380';
$secret = 'f14c3e9beeb924d23effc2ed836b9135';


$facebook = new Facebook ( array (

    'appId' => $appId,

    'secret' => $secret,

    'cookie' => TRUE,

    'domain' => $_SERVER ['SERVER_NAME']

) );



$database = new Database();





//Verificar se é mobile

$urlApp = 'https://apps.facebook.com/ibc-termometro/';


$useragent=$_SERVER['HTTP_USER_AGENT'];

if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|iPad|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))){

    $urlApp = 'https://www.ibccoaching.com.br/app-termometro-felicidade/';    

}



// user_photos foi para postar foto



$params = array (

    'scope' => 'publish_actions, email, user_birthday, user_location, user_photos, user_friends',

    'redirect_uri' => $urlApp.'?score='.$score

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

    $user_home_town = $user ['location'] ['name'];

    $user_birthday = $user ['birthday'];

    if(!$database->userExists($userid)){

        $database->saveUser($userid, $user_name, $user_email, date('Y-m-d', strtotime($user_birthday)), $user_gender, $user_home_town);

        $database->sendUserToRdStation($userid,'app-termometro-iniciou');

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

    <meta name="fb:app_id" content="<?php echo $facebook->getAppId();?>" />

    <meta name="og:url" content="https://apps.facebook.com/1564646373786380/?score=<?php echo $score; ?>" />

    <meta name="og:site_name" content="Teste Term&ocirc;metro da Felicidade" />

    <meta name="og:type" content="website" />

    <link rel="icon" href="<?php echo $url ?>/images/favicon.ico" type="image/x-icon">

    <link rel="shortcut icon" href="<?php echo $url ?>/images/favicon.ico" type="image/x-icon">

    <meta name="viewport" content="width=device-width, initial-scale=1">



    <link href='https://fonts.googleapis.com/css?family=Dosis:200,300,400,500,600,700,800' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="library/css/main.css">

</head>

<body>

<!-- Google Tag Manager -->

<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-M3XSLS"

height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>

<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':

new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],

j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=

'//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);

})(window,document,'script','dataLayer','GTM-M3XSLS');</script>

<!-- End Google Tag Manager -->

    <div id="fb-root"></div>

    <script>(function(d, s, id) {

            var js, fjs = d.getElementsByTagName(s)[0];

            if (d.getElementById(id)) return;

            js = d.createElement(s); js.id = id;

            js.src = "https://connect.facebook.net/pt_BR/all.js#xfbml=1&appId=<?php echo $facebook->getAppId()?>";

            fjs.parentNode.insertBefore(js, fjs);

        }(document, 'script', 'facebook-jssdk'));</script>

    <section id="wrapper">

