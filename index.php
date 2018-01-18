<?php require_once('functions/functions.php'); ?><!DOCTYPE html>
<!--[if lt IE 7]>      
<html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="">
  <![endif]-->
  <!--[if IE 7]>         
  <html class="no-js lt-ie9 lt-ie8" lang="">
    <![endif]-->
    <!--[if IE 8]>         
    <html class="no-js lt-ie9" lang="">
      <![endif]-->
      <!--[if gt IE 8]><!--> 
      <html class="no-js" lang="">
        <!--<![endif]-->
        <head>
          <meta name="viewport" content="width=device-width, initial-scale=1">
          <meta charset="utf-8">
          <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
          <title>IBC - Termômetro da felicidade</title>
          <meta name="title" content="Teste Term&ocirc;metro da Felicidade" />
          <meta name="description" content="Teste Term&ocirc;metro da Felicidade do Instituto Brasileiro de Coaching." />
          <meta name="og:title" content="Meu Term&ocirc;metro da Felicidade do IBC Coaching deu <?php echo $score; ?>°C" />
          <meta name="og:description" content="Faça o teste do IBC e receba dicas exclusivas!" />
          <meta name="og:site_name" content="Teste Term&ocirc;metro da Felicidade" />
          <meta name="og:type" content="website" />
          <link rel="icon" href="<?php echo $url ?>/images/favicon.ico" type="image/x-icon">
          <link rel="shortcut icon" href="<?php echo $url ?>/images/favicon.ico" type="image/x-icon">
          <meta name="viewport" content="width=device-width, initial-scale=1">
          <link href='https://fonts.googleapis.com/css?family=Dosis:200,300,400,500,600,700,800' rel='stylesheet' type='text/css'>
          <link rel="stylesheet" href="<?php echo $url;?>/library/css/main.css">
          <link rel="stylesheet" href="<?php echo $url;?>/library/css/modal.css">
        </head>
        <body>
          <!-- Google Tag Manager -->
          <noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-M3XSLS"
            height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
          <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
            new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            
            '//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
            
            })(window,document,'script','dataLayer','GTM-M3XSLS');
          </script>
          <!-- End Google Tag Manager -->
          <div id="fb-root"></div>
          <section id="wrapper">
          <header>
            <img src="<?php echo $url;?>/library/images/logos/logo-termometro.png" alt="IBC - Termômetro da Felicidade">
          </header>
          <section class="content">
            <p class="boasVindas">
              A busca pela felicidade é contínua, constante e eterna. É ela que nos move e não deixa a vida ficar sem sentido. Você sabe qual o seu grau de felicidade? Conseguimos uma maneira fácil e rápida de medir como está cada área da sua vida. Bastam alguns cliques para responder as perguntas a seguir e verificar o seu grau de felicidade atual. No final do teste, compartilhe seu resultado e convide seus amigos!
            </p>
            <?php include('modal-acesso.php'); ?>
          </section>
<footer>
  <ul class="logos">
    <li>
      <img src="<?php echo $url;?>/library/images/logos/logo-ibc.png" alt="IBC - Instituto Brasileiro de Coaching">
    </li>
    <li>
      <img src="<?php echo $url;?>/library/images/logos/logo-jrm.png" alt="José Roberto Marques">
    </li>
  </ul>
  <p class="copy">
    Teste desenvolvido por José Roberto Marques, Presidente do IBC, englobando conceitos e ferramentas de
    <br>
    Coaching e Psicologia Positiva, Todos os direitos reservados
  </p>
  <p>&nbsp;
  </p>
  <p style="width:257px;margin-top:0;margin-right:auto;margin-bottom:0;margin-left:auto;">
    <img src="<?php echo $url;?>/library/images/logos/logotipo_mestre_ao5.png" alt="Agência Mestre e AO5" style="width:100%;height:auto;">
  </p>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <script src="library/js/main.js"></script>
</footer>
