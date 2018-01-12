/*global alert: false, console: false, jQuery: false */

'use strict';

var appurl = "http://ibc.com/app-termometro-felicidade/";

(function ($) {



    //appurl = $('a.facebook').attr('data-href');

    $(window).scroll(triggerFunctionScroll);

    $(window).resize(triggerFunctionResize);





    $('.btnRefazer').click(function(e){

        e.preventDefault();

        $.post('reset.php',function () {

            window.top.location = appurl

        });

    });

    $('.btnConvideP, .btnConvideM, .btnConvide').click(function(e){

        e.preventDefault();

        $.post('sendShareRD.php', 'rede=convidou');

        invitePopup();

    });

    $('a.facebook').click(function(e){

        e.preventDefault();

        $.post('sendShareRD.php', 'rede=compartilhou-facebook');

        shareFbPopup();

    });

    $('a.twitter').click(function(e){

        e.preventDefault();

        $.post('sendShareRD.php', 'rede=compartilhou-twitter');

        shareTwitterPopup($("#perTotal").text());

    });

    $('a.gplus').click(function(e){

        e.preventDefault();

        $.post('sendShareRD.php', 'rede=compartilhou-google');

        shareGPlusPopup();

    });

    



}(jQuery));



function triggerFunctionReady(area1, area2, area3, area4, result) {

    perguntasAction();

    if(!area1) {

        pageTriggerInit();

    }



    if(result) {

        var areasValue = [parseInt(area1), parseInt(area2), parseInt(area3), parseInt(area4)];

        var areas = ["Pessoal", "Profissional", "dos Relacionamentos", "da Qualidade de Vida"];

        var min = Math.min.apply(null, areasValue);



        $('.page').addClass('done').removeClass('ativo');

        $('#ranking').addClass('ativo').addClass('done');

        $("#perTotal").text(result);

        $("#perPessoal").text(area1);

        $("#perProfissional").text(area2);

        $("#perRelacionamento").text(area3);

        $("#perQualidade").text(area4);



        $(".grausFelicidade").text(result);

        $(".titDicas .ambiente").text("Ambiente "+areas[areasValue.indexOf(min)]);

        $(".titDicas .grausAmbiente").text(min);



        $('.tagTermometro').fadeOut('fast');

        $('#progressBar').css('width', '100%');

        $('.marcPessoal').css('opacity', '1');

        $('.marcProfissional').css('opacity', '1');

        $('.marcRelacionamento').css('opacity', '1');

        $('.marcQualidade').css('opacity', '1');

        valueTotal();

    } else {

        if (area1) {

            $("#perPessoal").text(area1);

            $('.tagTermometro').removeClass('pessoal');

            $('.page').removeClass('ativo');

            $('#pessoal').addClass('done');

            $('.marcPessoal').css('opacity', '1');

            $("#progressBar").val(25).css('width', '25%');

            $('#pessoalParabens').addClass('ativo');

            if (!area2) {

                $('#pessoalParabens').delay(5000).fadeOut(function () {

                    $(this).next('.page').addClass('ativo');

                });

                pageActive();

                setTimeout(function () {

                    ambienteProfissional();

                    setTimeout(function () {

                        pageActive();

                        $('.tagTermometro').addClass('profissional').fadeIn('fast');

                        $('.perguntas .item.ativo').removeClass('ativo');

                        $('#profissional').find('.perguntas .item:first-child').addClass('ativo');

                    }, 6000);

                }, 6000);

            }

        }

        if (area2) {

            $("#perProfissional").text(area2);

            $('.tagTermometro').removeClass('profissional');

            $('.page').removeClass('ativo');

            $('#profissional').addClass('done');

            $('.marcProfissional').css('opacity', '1');

            $("#progressBar").val(50).css('width', '50%');

            $('#profissionalParabens').addClass('ativo');

            if (!area3) {

                $('#profissionalParabens').delay(5000).fadeOut(function () {

                    $(this).next('.page').addClass('ativo');

                });

                pageActive();

                setTimeout(function () {

                    ambienteRelacionamento();

                    setTimeout(function () {

                        pageActive();

                        $('.tagTermometro').addClass('relacionamento').fadeIn('fast');

                        $('.perguntas .item.ativo').removeClass('ativo');

                        $('#relacionamento').find('.perguntas .item:first-child').addClass('ativo');

                    }, 6000);

                }, 6000);

            }

        }

        if (area3) {

            $("#perRelacionamento").text(area3);

            $('.tagTermometro').removeClass('relacionamento');

            $('.page').removeClass('ativo');

            $('#relacionamento').addClass('done');

            $('.marcRelacionamento').css('opacity', '1');

            $("#progressBar").val(75).css('width', '75%');

            $('#relacionamentoParabens').addClass('ativo');

            if (!area4) {

                $('#relacionamentoParabens').delay(5000).fadeOut(function () {

                    $(this).next('.page').addClass('ativo');

                });

                pageActive();

                setTimeout(function () {

                    ambienteQualidade();

                    setTimeout(function () {

                        pageActive();

                        $('.tagTermometro').addClass('qualidade').fadeIn('fast');

                        $('.perguntas .item.ativo').removeClass('ativo');

                        $('#qualidade').find('.perguntas .item:first-child').addClass('ativo');

                    }, 6000);

                }, 6000);

            }

        }

    }

}



function pageActive() {

    $('.page.ativo').fadeOut(function () {

        $(this).next().addClass('ativo');

    });

}



function pageTriggerInit() {

    $('.page.inicio').delay(5000).fadeOut(function () {

        $(this).next().addClass('ativo');

    });



    //Transição ambiente pessoal

    setTimeout(function () {

        $('#pessoalCidade').find('.casa').addClass('animate');

    }, 3000);

    $('#pessoalCidade').find('.ambiente-animado').delay(2500).fadeOut(5000);

}



//Transição ambiente profissional

function ambienteProfissional() {

    var profissionalCidade = $('#profissionalCidade');

    if (profissionalCidade.hasClass('ativo')) {

        setTimeout(function () {

            $('#profissionalCidade').find('.predio').addClass('animate');

        }, 3000);

        profissionalCidade.find('.ambiente-animado').delay(2500).fadeOut(5000);

    }

}



//Transição ambiente de relacionamento

function ambienteRelacionamento() {

    var relacionamentoCidade = $('#relacionamentoCidade');

    if (relacionamentoCidade.hasClass('ativo')) {

        setTimeout(function () {

            $('#relacionamentoCidade').find('.zoomRelacionamento').addClass('animate');

        }, 3000);

        relacionamentoCidade.find('.ambiente-animado').delay(2500).fadeOut(5000);

    }

}



//Transição ambiente de qualidade

function ambienteQualidade() {

    var qualidadeCidade = $('#qualidadeCidade');

    if (qualidadeCidade.hasClass('ativo')) {

        setTimeout(function () {

            $('#qualidadeCidade').find('.zoomQualidade').addClass('animate');

        }, 3000);

        qualidadeCidade.find('.ambiente-animado').delay(2500).fadeOut(5000);

    }

}



//Transição Ranking

function valueTotal() {

    var valorTotal = $("#perTotal").text();

    appurl = appurl+'?score='+valorTotal;

    $('.barTotal').addClass(valorTotal).css("bottom", (valorTotal) + "%");

    var smileTotal = $('.smileTotal');

    smileTotal.css("bottom", (valorTotal) + "%");

    if (valorTotal <= 33) {

        smileTotal.addClass('smile-1');

        $(".tagResultado").append("Frio");

        appurl = appurl+'&temp=frio';

    } else if (valorTotal > 33 && valorTotal <= 66) {

        smileTotal.addClass('smile-2');

        $(".tagResultado").append("Morno");

        appurl = appurl+'&temp=morno';

    } else if (valorTotal > 66) {

        smileTotal.addClass('smile-3');

        $(".tagResultado").append("Quente");

        appurl = appurl+'&temp=quente';

    }

    setTimeout(function(){ shareFbPopup(); }, 10000);

}



function valuePessoal() {

    var valorPessoal = $("#perPessoal").text();

    $('.barPessoal').addClass(valorPessoal).css("bottom", (valorPessoal) + "%");

    var smilePessoal = $('.smilePessoal');

    smilePessoal.css("bottom", (valorPessoal) + "%");

    if (valorPessoal <= 33) {

        smilePessoal.addClass('smile-1');

    } else if (valorPessoal > 33 && valorPessoal <= 66) {

        smilePessoal.addClass('smile-2');

    } else if (valorPessoal > 66) {

        smilePessoal.addClass('smile-3');

    }

}



function valueProfissional() {

    var valorProfissional = $("#perProfissional").text();

    $('.barProfissional').addClass(valorProfissional).css("bottom", (valorProfissional) + "%");

    var smileProfissional = $('.smileProfissional');

    smileProfissional.css("bottom", (valorProfissional) + "%");

    if (valorProfissional <= 33) {

        smileProfissional.addClass('smile-1');

    } else if (valorProfissional > 33 && valorProfissional <= 66) {

        smileProfissional.addClass('smile-2');

    } else if (valorProfissional > 66) {

        smileProfissional.addClass('smile-3');

    }

}



function valueRelacionamento() {

    var valorRelacionamento = $("#perRelacionamento").text();

    $('.barRelacionamento').addClass(valorRelacionamento).css("bottom", (valorRelacionamento) + "%");

    var smileRelacionamento = $('.smileRelacionamento');

    smileRelacionamento.css("bottom", (valorRelacionamento) + "%");

    if (valorRelacionamento <= 33) {

        smileRelacionamento.addClass('smile-1');

    } else if (valorRelacionamento > 33 && valorRelacionamento <= 66) {

        smileRelacionamento.addClass('smile-2');

    } else if (valorRelacionamento > 66) {

        smileRelacionamento.addClass('smile-3');

    }

}



function valueQualidade() {

    var valorQualidade = $("#perQualidade").text();

    $('.barQualidade').addClass(valorQualidade).css("bottom", (valorQualidade) + "%");

    var smileQualidade = $('.smileQualidade');

    smileQualidade.css("bottom", (valorQualidade) + "%");

    if (valorQualidade <= 33) {

        smileQualidade.addClass('smile-1');

    } else if (valorQualidade > 33 && valorQualidade <= 66) {

        smileQualidade.addClass('smile-2');

    } else if (valorQualidade > 66) {

        smileQualidade.addClass('smile-3');

    }

}



function scrollPoint() {

    var ranking = $('#ranking');

    if (ranking.hasClass('done')) {

        var docViewTop = $(window).scrollTop(),

            docViewBottom = docViewTop + $(window).height(),

            elemTop = ranking.find('.listaAmbientes > ul section').offset().top;

            //elemBottom = elemTop + ranking.find('.listaAmbientes > ul section').height();

        if ((elemTop >= docViewBottom)) {

            return true;

        } else {

            setTimeout(function () {

                ranking.find('.listaAmbientes > ul').addClass("ativo");

                valuePessoal();

                valueProfissional();

                valueRelacionamento();

                valueQualidade();

            }, 600);

        }

    }

}



function triggerFunctionScroll() {

    scrollPoint();

}

function triggerFunctionResize() {}



//Funções perguntas

function perguntasAction() {

    var progressBarElem = $("#progressBar");

    progressBarElem.val(0);

    $('.perguntas .listaRespostas span').on('click', function () {

        var dataValue = $(this).data('value'),

            progressBar = progressBarElem[0],

            progressBarValue = progressBar.value = parseFloat(progressBar.value, 10) + 2.78;

        $('#progressBar').css('width', progressBarValue + '%');

        $('.perguntas .listaRespostas span').parents('li').removeClass('ativo');

        $(this).addClass('checked');

        $(this).parents('li').addClass('ativo');

        $(this).parents('li').prevAll().addClass('ativo');

        $('.perguntas .item.ativo').attr('data-value', dataValue);

        setTimeout(function () {

            var item = $('.perguntas .item.ativo').next('.item')

            item.addClass('ativo');

            item.prevAll('.item').removeClass('ativo');

        }, 200);

    });



    $('#pessoal').find('.perguntas .item:last-child .listaRespostas span').on('click', function () {

        var items = $('#pessoal').find('.perguntas .item');

        var count = items.length;

        var perPessoal = 0;

        for(var i=0; i<count; i++)

        {

            perPessoal += parseInt($(items[i]).attr('data-value'))*10;

        }

        perPessoal = Math.round(perPessoal/count);

        $("#perPessoal").text(perPessoal);

        $.post('save_area.php', 'area=area1&value='+perPessoal);



        $('.tagTermometro').fadeOut('fast').removeClass('pessoal');

        $('#pessoal').addClass('done');

        $('.marcPessoal').css('opacity', '1');

        $('#pessoalParabens').delay(5000).fadeOut(function () {

            $(this).next('.page').addClass('ativo');

        });

        pageActive();



        //Iniciando ambiente profissional

        setTimeout(function () {

            if ($('#pessoal').hasClass('done')) {

                ambienteProfissional();

                setTimeout(function () {

                    pageActive();

                    $('.tagTermometro').addClass('profissional').fadeIn('fast');

                    $('.perguntas .item.ativo').removeClass('ativo');

                    $('#profissional').find('.perguntas .item:first-child').addClass('ativo');

                }, 6000);

            }

        }, 6000);

    });



    $('#profissional').find('.perguntas .item:last-child .listaRespostas span').on('click', function () {

        var items = $('#profissional').find('.perguntas .item');

        var count = items.length;

        var perProfissional = 0;

        for(var i=0; i<count; i++)

        {

            perProfissional += parseInt($(items[i]).attr('data-value'))*10;

        }

        perProfissional = Math.round(perProfissional/count);

        $("#perProfissional").text(perProfissional);

        $.post('save_area.php', 'area=area2&value='+perProfissional);



        $('.tagTermometro').fadeOut('fast').removeClass('profissional');

        $('#profissional').addClass('done');

        $('.marcProfissional').css('opacity', '1');

        $('#profissionalParabens').delay(5000).fadeOut(function () {

            $(this).next('.page').addClass('ativo');

        });

        pageActive();



        //Iniciando ambiente de relacionamento

        setTimeout(function () {

            if ($('#profissional').hasClass('done')) {

                ambienteRelacionamento();

                setTimeout(function () {

                    pageActive();

                    $('.tagTermometro').addClass('relacionamento').fadeIn('fast');

                    $('.perguntas .item.ativo').removeClass('ativo');

                    $('#relacionamento').find('.perguntas .item:first-child').addClass('ativo');

                }, 6000);

            }

        }, 6000);

    });



    $('#relacionamento').find('.perguntas .item:last-child .listaRespostas span').on('click', function () {

        var items = $('#relacionamento').find('.perguntas .item');

        var count = items.length;

        var perRelacionamento = 0;

        for(var i=0; i<count; i++)

        {

            perRelacionamento += parseInt($(items[i]).attr('data-value'))*10;

        }

        perRelacionamento = Math.round(perRelacionamento/count);

        $("#perRelacionamento").text(perRelacionamento);

        $.post('save_area.php', 'area=area3&value='+perRelacionamento);



        $('.tagTermometro').fadeOut('fast').removeClass('relacionamento');

        $('#relacionamento').addClass('done');

        $('.marcRelacionamento').css('opacity', '1');

        $('#relacionamentoParabens').delay(5000).fadeOut(function () {

            $(this).next('.page').addClass('ativo');

        });

        pageActive();



        //Iniciando ambiente de qualidade de vida

        setTimeout(function () {

            if ($('#relacionamento').hasClass('done')) {

                ambienteQualidade();

                setTimeout(function () {

                    pageActive();

                    $('.tagTermometro').addClass('qualidade').fadeIn('fast');

                    $('.perguntas .item.ativo').removeClass('ativo');

                    $('#qualidade').find('.perguntas .item:first-child').addClass('ativo');

                }, 6000);

            }

        }, 6000);

    });



    $('#qualidade').find('.perguntas .item:last-child .listaRespostas span').on('click', function () {

        var items = $('#qualidade').find('.perguntas .item');

        var count = items.length;

        var perQualidade = 0;

        for(var i=0; i<count; i++)

        {

            perQualidade += parseInt($(items[i]).attr('data-value'))*10;

        }

        perQualidade = Math.round(perQualidade/count);

        $("#perQualidade").text(perQualidade);

        $.post('save_area.php', 'area=area4&value='+perQualidade);



        var areasValue = [parseInt($("#perPessoal").text()), parseInt($("#perProfissional").text()), parseInt($("#perRelacionamento").text()), parseInt($("#perQualidade").text())];

        var areas = ["Pessoal", "Profissional", "dos Relacionamentos", "da Qualidade de Vida"];

        var min = Math.min.apply(null, areasValue);

        var perTotal = 0;

        var params = '';

        count = areasValue.length;

        for(i=0; i<count; i++)

        {

            perTotal += areasValue[i];

            params += 'area'+(i+1)+'='+areasValue[i]+'&'

        }

        perTotal = Math.round(perTotal/count);

        $("#perTotal").text(perTotal);

        $.post('save_result.php', params+'result='+perTotal);



        $(".grausFelicidade").text(perTotal);

        $(".titDicas .ambiente").text("Ambiente "+areas[areasValue.indexOf(min)]);

        $(".titDicas .grausAmbiente").text(min);



        $('.tagTermometro').fadeOut('fast');

        $('#qualidade').addClass('done');

        $('.marcQualidade').css('opacity', '1');

        $('#qualidadeParabens').delay(5000).fadeOut(function () {

            $(this).next('.page').addClass('ativo');

        });

        pageActive();

        $('#ranking').addClass('done');

        setTimeout(function () {

            if ($('#ranking').hasClass('done')) {

                valueTotal();

            }

        }, 6000);

    });

}



function invitePopup() {

    FB.ui({

        method: 'apprequests',

        message: "Venha fazer o teste do IBC Coaching!"

    }, send_wall_invitation);

}



function send_wall_invitation(response) {

    var send_invitation_url = appurl;

    jQuery.ajax({

        url: send_invitation_url,

        data: {},

        dataType: "json",

        type: 'POST',

        success: function (data) {}

    });

}



function shareFbPopup(){

    FB.ui({

        method: 'share',

        href: appurl

    }, function(response){});

}



function shareTwitterPopup(score){

    var width  = 575,

        height = 400,

        left   = ($(window).width()  - width)  / 2,

        top    = ($(window).height() - height) / 2,

        url    = appurl,

        opts   = 'status=1' +

            ',width='  + width  +

            ',height=' + height +

            ',top='    + top    +

            ',left='   + left;



    window.open('http://twitter.com/share?url=' + url + '&text=' + 'Meu grau de felicidade é de '+score+'°' + '&via=ibccoaching', 'twitterwindow', opts);

}



function shareGPlusPopup(){

    var width  = 575,

        height = 400,

        left   = ($(window).width()  - width)  / 2,

        top    = ($(window).height() - height) / 2,

        url    = appurl,

        opts   = 'status=1' +

            ',width='  + width  +

            ',height=' + height +

            ',top='    + top    +

            ',left='   + left;



    window.open('https://plus.google.com/share?url=' + url, 'googlepluswindow', opts);

}