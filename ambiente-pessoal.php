<section id="pessoal" class="page ativo">
    <div class="ambiente-animado pessoal">
        <div class="carro posicionamento"></div>
        <div class="ambiente posicionamento"></div>
        <div class="cafe posicionamento"></div>
        <div class="cadeira posicionamento">
            <div class="cabeca"></div>
        </div>
    </div>
	    <?php
			
			$questions = mysql_query("SELECT * FROM questions WHERE area = 'area1'");
			$active = ' ativo';
			while($row = mysql_fetch_assoc($questions)){
				
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
</section>
