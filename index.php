<?php include 'header.php'; ?>
<?php if(!$userid) {?>
    <header>
        <img src="library/images/logos/logo-termometro.png" alt="IBC - Termômetro da Felicidade">
    </header>
    <section class="content">
        <p class="boasVindas">
            A busca pela felicidade é contínua, constante e eterna. É ela que nos move e não deixa a vida ficar sem sentido. Você sabe qual o seu grau de felicidade? Conseguimos uma maneira fácil e rápida de medir como está cada área da sua vida. Bastam alguns cliques para responder as perguntas a seguir e verificar o seu grau de felicidade atual. No final do teste, compartilhe seu resultado e convide seus amigos!
        </p>

        <a id="comecar-teste" href="<?php echo $loginUrl; ?>" class="btn btn-2 btn-2h" target="_top">Começar o seu teste</a>

    </section>
<?php } else { ?>
    <section id="paginas">
        <?php include 'topo-termometro.php'; ?>
        <div class="content">
            <?php include 'ambiente-pessoal-cidade.php'; ?>
            <?php include 'ambiente-pessoal.php'; ?>
            <?php include 'parabens-pessoal.php'; ?>

            <?php include 'ambiente-profissional-cidade.php'; ?>
            <?php include 'ambiente-profissional.php'; ?>
            <?php include 'parabens-profissional.php'; ?>

            <?php include 'ambiente-relacionamento-cidade.php'; ?>
            <?php include 'ambiente-relacionamento.php'; ?>
            <?php include 'parabens-relacionamento.php'; ?>

            <?php include 'ambiente-qualidade-cidade.php'; ?>
            <?php include 'ambiente-qualidade.php'; ?>
            <?php include 'parabens-qualidade.php'; ?>

            <?php include 'ranking.php'; ?>
        </div>
    </section>
<?php } ?>
<?php if(!$userid) {?>
<footer>
    <ul class="logos">
        <li>
            <img src="library/images/logos/logo-ibc.png" alt="IBC - Instituto Brasileiro de Coaching">
        </li>
        <li>
            <img src="library/images/logos/logo-jrm.png" alt="José Roberto Marques">
        </li>
    </ul>
    <p class="copy">
        Teste desenvolvido por José Roberto Marques, Presidente do IBC, englobando conceitos e ferramentas de
        <br>
        Coaching e Psicologia Positiva, Todos os direitos reservados
    </p>
    <p>&nbsp;</p>
    <p style="width:257px;margin-top:0;margin-right:auto;margin-bottom:0;margin-left:auto;"><img src="library/images/logos/logotipo_mestre_ao5.png" alt="Agência Mestre e AO5" style="width:100%;height:auto;"></p>
</footer>
<?php } ?>
<?php include 'footer.php';?>
