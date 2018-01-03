<section id="profissional" class="page">
    <div class="ambiente-animado profissional">
        <div class="ambiente posicionamento"></div>
        <div class="braco braco-1 posicionamento"></div>
        <div class="cabelo-1 posicionamento"></div>
        <div class="braco braco-2 posicionamento"></div>
        <div class="cabelo-2 posicionamento"></div>
    </div>

     <section class="perguntas">
        <?php			
			$questions = mysql_query("SELECT * FROM questions WHERE area = 'area2'");
			$active = ' ativo';
			while($row = mysql_fetch_assoc($questions)){
        ?>
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
			<?php } ?>
    </section>
</section>
