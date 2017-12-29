<?php

session_start();



if($_SESSION['uid'] != '') {

    require 'functions/facebook.php';

    require 'functions/Database.class.php';



    $database = new Database();



    $area1 = isset($_POST['area1']) ? $_POST['area1'] : '';

    $area2 = isset($_POST['area2']) ? $_POST['area2'] : '';

    $area3 = isset($_POST['area3']) ? $_POST['area3'] : '';

    $area4 = isset($_POST['area4']) ? $_POST['area4'] : '';

    $result = isset($_POST['result']) ? $_POST['result'] : '';



    if ($area1 != '' and $area2 != '' and $area3 != '' and $area4 != '' and $result != '') {

        $database->saveResult($_SESSION['uid'], $area1, $area2, $area3, $area4, $result);

        $database->sendUserToRdStation($_SESSION['uid'],'app-termometro-finalizou');


        $appId = '1564646373786380';
        $secret = 'f14c3e9beeb924d23effc2ed836b9135';
        $facebook = new Facebook ( array (

            'appId' => $appId,

            'secret' => $secret,

            'cookie' => TRUE,

            'domain' => $_SERVER ['SERVER_NAME']

        ));

        try {

          $facebook->api ( '/me/feed', 'post', array(

                    'link' =>   'https://apps.facebook.com/ibc-termometro/?score='.$result

          ));

          $database->sendUserToRdStation($_SESSION['uid'],'app-termometro-compartilhou-automatico');

        } catch(FacebookRequestException $ex) {

          // When Facebook returns an error

        } catch(\Exception $ex) {

          // When validation fails or other local issues



        }



    }

}

?>