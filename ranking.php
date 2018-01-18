<?php require_once('head.php'); ?>
<body>
<?php require_once('header.php'); ?>
<section class="breadcrub">
    <div class="container">
        <div class="col-md-9 mr-auto ml-auto row text-center pt-2 pb-1">
            <h3><b>Resultado:</b> veja como está o seu termômetro e compartilhe</h3>
        </div>
    </div>
</section>

<section class="content py-5">
    <div class="container">
        <div class="col-md-8 mr-auto ml-auto row">
            <div class="share col-12">
                <?php 
                    $query = "SELECT * FROM results WHERE user_id = '".$_SESSION['id']."'";
                    $exe = mysql_query($query);
                    $linha = mysql_fetch_assoc($exe);
                    $result = $linha['result'];
                    if($result >= '181' ){
                        $img = '/library/images/share/termometro-resultado-quente.png';
                    }

                    if($result >= '0' && $result < '90'){
                        $img = '/library/images/share/termometro-resultado-frio.png';
                    }

                    if($result >= '90' && $result <= '180' ){
                        $img = '/library/images/share/termometro-resultado-morno.png';

                    }
                ?>
                <img src="<?php echo $url;?><?php echo $img;?>" alt="" class="img-thumbnail">
            </div>
            <div class="midias text-center col-12 py-3">
                <h4><b>COMPARTILHE COM SEUS AMIGOS</b></h4>
                <div class="links d-block text-center">
                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $url;?><?php echo $img;?>" class="d-inline-block"><img src="<?php echo $url;?>/library/images/bt-facebook-g.png" alt=""></a>
                    <a href="#" class="d-inline-block"><img src="<?php echo $url;?>/library/images/bt-gplus-g.png" alt=""></a>
                    <a href="http://twitter.com/share?url=<?php echo $url;?><?php echo $img;?>&via=ibc&image-src=<?php echo $url;?><?php echo $img;?>" class="d-inline-block"><img src="<?php echo $url;?>/library/images/bt-twitter-g.png" alt=""></a>
                </div>
            </div>
        </div>
    </div>
</section>

</body>
</html>