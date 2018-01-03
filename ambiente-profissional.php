<?php include 'header.php'; ?>
<!-- verifica se fez login -->
<?php if(!@$_SESSION['emailUsu']) {?>
<script>
    alert('Por favor valide seu acesso e tente novamente!');
    window.location.href='<?php echo $url; ?>';
</script>
<?php }?>
<?php include 'topo-termometro.php'; ?>
<?php include 'ambiente-profissional-cidade.php'; ?>
<section id="profissional" class="page">
    <div class="ambiente-animado profissional">
        <div class="ambiente posicionamento"></div>
        <div class="braco braco-1 posicionamento"></div>
        <div class="cabelo-1 posicionamento"></div>
        <div class="braco braco-2 posicionamento"></div>
        <div class="cabelo-2 posicionamento"></div>
    </div>

     <form action="<?php echo $url;?>/save-professional.php" method="post" >
        <?php
            $questions = mysql_query("SELECT * FROM questions WHERE area = 'area2'");
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
