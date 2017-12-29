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
        $questions = $database->getQuestions("area2");
        foreach($questions as $question) :
            ?>
            <div class="item">
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
        <?php endforeach; ?>
    </section>
</section>
