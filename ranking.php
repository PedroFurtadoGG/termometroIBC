<section id="ranking" class="ranking page">
    <section class="topoRanking">
        <div class="resultado">
            <h2 class="titResultado">Seu Resultado</h2>
            <section class="termometroFinal">
                <div class="caSmile">
                    <div class="smileTotal"></div>
                </div>
                <div class="caProgressBar">
                    <span class="progressBar barTotal"></span>
                </div>
            </section>
            <p><span id="perTotal">90</span>°c</p>
            <div class="tagResultado fadeIn"></div>
        </div>
        <div class="compartilheTopo">
            <p>Compartilhe seu resultado</p>
            <ul>
                <li>
                    <a id="faceShare" href="#" class="facebook"></a>
                </li>
                <li>
                    <a href="#" class="twitter"></a>
                </li>
                <li>
                    <a href="#" class="gplus"></a>
                </li>
            </ul>
            <p class="parConvide">Convide seus amigos <br>para fazer o teste !</p>
            <a href="#" class="btnConvideP btn btn-2 btn-2h">Convidar amigos</a>
        </div>
    </section>
    <section class="listaAmbientes">
        <ul>
            <li>
                <h2>Ambiente Pessoal</h2>
                <p><span id="perPessoal">90</span>°c</p>
                <section class="termometroAmbiente">
                    <div class="caSmile">
                        <div class="smilePessoal"></div>
                    </div>
                    <div class="caProgressBar">
                        <span class="progressBar barPessoal"></span>
                    </div>
                </section>
            </li>
            <li>
                <h2>Ambiente Profissional</h2>
                <p><span id="perProfissional">50</span>°c</p>
                <section class="termometroAmbiente">
                    <div class="caSmile">
                        <div class="smileProfissional"></div>
                    </div>
                    <div class="caProgressBar">
                        <span class="progressBar barProfissional"></span>
                    </div>
                </section>
            </li>
            <li>
                <h2>Ambiente dos Relacionamentos</h2>
                <p><span id="perRelacionamento">23</span>°c</p>
                <section class="termometroAmbiente">
                    <div class="caSmile">
                        <div class="smileRelacionamento"></div>
                    </div>
                    <div class="caProgressBar">
                        <span class="progressBar barRelacionamento"></span>
                    </div>
                </section>
            </li>
            <li>
                <h2>Ambiente da Qualidade de Vida</h2>
                <p><span id="perQualidade">95</span>°c</p>
                <section class="termometroAmbiente">
                    <div class="caSmile">
                        <div class="smileQualidade"></div>
                    </div>
                    <div class="caProgressBar">
                        <span class="progressBar barQualidade"></span>
                    </div>
                </section>
            </li>
        </ul>
    </section>

    <h3 class="titDicas">Seu grau de felicidade é  <span class="grausFelicidade"></span>°C<br>Assista ao video abaixo e confira dicas exclusivas!</h3>

    <iframe src="https://www.youtube.com/embed/0VOfmQMuV6A" frameborder="0" allowfullscreen></iframe>

    <h4 class="textoConvide">Convide seus amigos para fazer o teste do Termômetro da Felicidade</h4>

    <a href="#" class="btnConvideM btn btn-2 btn-2h">Convidar amigos</a>

    <?php
    $friend_ids = array();
    if($friends['data'])
    {
        foreach ($friends['data'] as $friend_data) {
            $friend_ids[] = $friend_data['id'];
        }

        $user_friends = $database->getFriends($friend_ids);
        if (count($user_friends) > 0) {
            ?>
            <section class="amigosRanking">
                <ul>
                    <?php
                    foreach ($user_friends as $friend) :
                        $nivel = $friend['result'] > 66 ? 1 : ($friend['result'] > 33 ? 2 : 3);
                        ?>
                        <li>
                            <img src="http://graph.facebook.com/<?php echo $friend['uid']; ?>/picture?type=square" />
                            <div class="nivel<?php echo $nivel;?>">
                                <?php echo $friend['result']?>
                            </div>
                            <p><?php echo $friend['name']; ?></p>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </section>
        <?
        } //fim if user count > 0
    } //fim if friends data
    ?>

    <section class="parabensBox">
        <img src="http://graph.facebook.com/<?php echo $userid; ?>/picture?type=large" alt="Perfil">
        <p>" Por ter dado esse passo no seu autoconhecimento, eu já identifiquei aqui o ambiente que você pode mais se desenvolver para melhorar o seu termômetro da felicidade e por isso vou tomar a liberdade de te enviar emails periódicos com dicas, artigos e vídeos para você se desenvolver mais e mais em busca da felicidade. "</p>
        <p class="assinaturaBox">José Roberto Marques | Presidente IBC </p>
    </section>

    <h4>Ainda não convidou seus amigos para fazer o teste do Termômetro da Felicidade ?</h4>

    <a href="#" class="btnConvide btn btn-2 btn-2h">Clique aqui e convide agora!</a>

    <ul class="compartilheResultado">
        <li>
            <p>Compartilhe seu resultado</p>
        </li>
        <li>
            <a href="#" class="facebook"></a>
        </li>
        <li>
            <a href="#" class="twitter"></a>
        </li>
        <li>
            <a href="#" class="gplus"></a>
        </li>
    </ul>

    <a href="#" class="btnRefazer btn btn-2 btn-2h">Refazer teste</a>
    <p>&nbsp;</p>
    <p style="width:257px;margin-top:0;margin-right:auto;margin-bottom:0;margin-left:auto;"><img src="library/images/logos/logotipo_mestre_ao5.png" alt="Agência Mestre e AO5" style="width:100%;height:auto;"></p>
</section>

