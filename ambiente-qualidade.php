<?php require_once('head.php'); ?>
<body>

<?php require_once('header.php');?>

<section class="breadcrub">
    <div class="container">
        <div class="col-md-9 mr-auto ml-auto row text-center pt-2 pb-1">
            <h3 class="text-center col-12"><b>Questionário:</b> Ambiente da Qualidade</h3>
        </div>
    </div>
</section>

<section class="content py-5">
    <div class="container">
        <div class="col-md-8 mr-auto ml-auto row">
            <div class="ambientes col-12">

                <div class="ambiente-qdv row">
                    <div class="col-sm-5 ml-auto pt-5">
                        <img src="<?php echo $url;?>/library/images/aviao.png" alt="">
                    </div>
                    <div class="col-sm-2">
                        <img src="<?php echo $url;?>/library/images/balao.png" alt="">
                    </div>
                    <div class="col-sm-9 pr-0 pt-4">
                        <img src="<?php echo $url;?>/library/images/ambiente-qualidade-vida.png" alt="">
                    </div>
                    <div class="col-sm-3 pl-0 pt-4">
                        <img src="<?php echo $url;?>/library/images/tag-qualidade.png" alt="">
                    </div>
                </div><!--FECHA QUALIDADE DE VIDA-->


            </div>
            <form action="<?php echo $url;?>/save-quality.php" method="post" >
                <?php
                    $questions = mysql_query("SELECT * FROM questions WHERE area = 'area4' ");
                    $active = ' ativo'; 
                    $x = 0;
                    while($row = mysql_fetch_assoc($questions)){
                      $x++;
                ?>
                    <div class="termometro">
                        <label for="icons-radio" class="d-block py-3">
                             <?php echo utf8_encode($row['category']); ?>:  <?php echo utf8_encode($row['text']); ?>
                        </label>
                        <div class="icons-radio d-block py-4 pl-4">
                            
                            <input type="radio" name="radio<?php echo $x;?>" value="1" required>
                            <input type="radio" name="radio<?php echo $x;?>" value="2">
                            <input type="radio" name="radio<?php echo $x;?>" value="3">
                            <input type="radio" name="radio<?php echo $x;?>" value="4">
                            <input type="radio" name="radio<?php echo $x;?>" value="5">
                            <input type="radio" name="radio<?php echo $x;?>" value="6">
                            <input type="radio" name="radio<?php echo $x;?>" value="7">
                            <input type="radio" name="radio<?php echo $x;?>" value="8">
                            <input type="radio" name="radio<?php echo $x;?>" value="9">
                            <input type="radio" name="radio<?php echo $x;?>" value="10">
                        </div>
                    </div>
            <?php }?>

            <div class="d-block py-4 text-center">
                <button id="btnSubmit" class="btn-next" type="submit">Enviar</button>
            </div>
            
            </form>
        </div>
    </div>
</section>

</body>
</html>