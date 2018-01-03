<?php include 'header.php'; ?>
<!-- verifica se fez login -->
<?php if(!@$_SESSION['emailUsu']) {?>
<script>
    alert('Por favor valide seu acesso e tente novamente!');
    window.location.href='<?php echo $url; ?>';
</script>
<?php }?>
<?php include 'topo-termometro.php'; ?>
<?php include 'ambiente-qualidade-cidade.php'; ?>
<section id="qualidade" class="page">
    <div class="ambiente-animado qualidade-vida">
        <div class="nuvens posicionamento"></div>
        <div class="sol posicionamento"></div>
        <div class="roda-gigante posicionamento">
            <div class="esfera">
                <div class="carro-1 carro-item laranja posicionamento"></div>
                <div class="carro-2 carro-item laranja posicionamento"></div>
                <div class="carro-3 carro-item azul posicionamento"></div>
                <div class="carro-4 carro-item laranja posicionamento"></div>
                <div class="carro-5 carro-item laranja posicionamento"></div>
                <div class="carro-6 carro-item laranja posicionamento"></div>
                <div class="carro-7 carro-item azul posicionamento"></div>
                <div class="carro-8 carro-item laranja posicionamento"></div>
            </div>
        </div>
        <div class="ambiente posicionamento"></div>
        <div class="bicicleta posicionamento"></div>
        <div class="pescador posicionamento">
            <div class="braco posicionamento"></div>
        </div>
        <div class="bola posicionamento"></div>
        <div class="perna-1 posicionamento"></div>
        <div class="perna-2 posicionamento"></div>
        <div class="garotos posicionamento"></div>
        <div class="barco posicionamento"></div>
    </div>

    <form action="<?php echo $url;?>/save-quality.php" method="post" >
        <?php
            $questions = mysql_query("SELECT * FROM questions WHERE area = 'area4'");
            $active = ' ativo'; 
            $x = 0;
            while($row = mysql_fetch_assoc($questions)){
                $x++;
        ?>
            <section class="perguntas">
                    <div class="item<?php echo $active; ?>">
                        <ul class="listaPerguntas">
                            <li>
                                <p>
                                    <span><?php echo utf8_encode($row['category']); ?>:</span>
                                    <?php echo utf8_encode($row['text']); ?>
                                </p>
                            </li>
                        </ul>
                        <?php include 'box-respostas.php'; ?>
                    </div>
            </section>
        <?php }?>
        <button id="btnSubmit" class="cancelbtn" type="submit">Enviar</button>
    </form>
</section>
