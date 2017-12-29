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

    <section class="perguntas">
        <?php
        $questions = $database->getQuestions("area4");
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
