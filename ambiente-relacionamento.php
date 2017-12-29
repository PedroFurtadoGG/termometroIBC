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

    <section class="perguntas">
        <?php
        $questions = $database->getQuestions("area3");
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
