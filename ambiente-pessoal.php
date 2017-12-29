<section id="pessoal" class="page">
    <div class="ambiente-animado pessoal">
        <div class="carro posicionamento"></div>
        <div class="ambiente posicionamento"></div>
        <div class="cafe posicionamento"></div>
        <div class="cadeira posicionamento">
            <div class="cabeca"></div>
        </div>
    </div>
    <section class="perguntas">
        <?php
        $questions = $database->getQuestions("area1");
        $active = ' ativo';
        foreach($questions as $question) :
            ?>
            <div class="item<?php echo $active; ?>">
                <ul class="listaPerguntas">
                    <li>
                        <p>
                            <span><?php echo $question['category'] ?>:</span>
                            <?php echo $question['text'] ?>
                        </p>
                    </li>
                </ul>
                <?php include 'box-respostas.php'; ?>
            </div>
            <?php
            $active = '';
        endforeach;
        ?>
    </section>
</section>
