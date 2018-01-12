<?php include 'header.php'; ?>
<!-- verifica se fez login -->
<?php if(!@$_SESSION['emailUsu']) {?>
<script>
    alert('Por favor valide seu acesso e tente novamente!');
    window.location.href='<?php echo $url; ?>';
</script>
<?php }?>
<?php include 'topo-termometro.php'; ?>
<?php include 'ambiente-relacionamento-cidade.php'; ?>
<section id="relacionamento" class="page">
    <div class="ambiente-animado relacionamento">
        <div class="nuvens posicionamento"></div>
        <div class="sol posicionamento"></div>
        <div class="luz poste-2 posicionamento"></div>
        <div class="ambiente posicionamento">
            <i class="icon-group-1 posicionamento"></i>
            <i class="icon-group-3 posicionamento"></i>
            <i class="icon-group-4 posicionamento"></i>
            <i class="icon-group-5 posicionamento"></i>
            <i class="icon-group-6 posicionamento"></i>
        </div>
        <div class="luz poste-1 posicionamento"></div>
        <div class="carro relacionamento posicionamento">
            <i class="icon-group-2 posicionamento"></i>
        </div>
        <div class="antena posicionamento"></div>
    </div>

    <form action="<?php echo $url;?>/save-relationship.php" method="post" >
        <?php
            $questions = mysql_query("SELECT * FROM questions WHERE area = 'area3'");
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
