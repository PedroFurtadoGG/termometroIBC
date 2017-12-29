$(function(){
    $("#order").change(function(){
        $(this).closest('form').submit();
    });
    $('input[name=direction]').click(function(){
        $(this).closest('form').submit();
    });
    $('.tabs .tab').click(function(){
        $('.tabs .tab').each(function(){
            $(this).removeClass('active');
            $('#'+$(this).data('target')).hide();
        });
        $(this).addClass('active');
        $('#'+$(this).data('target')).show();
    });

    if($('#date').length > 0) {
        $('#date').datepicker({
            dateFormat: 'dd/mm/yy',
            dayNames: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'],
            dayNamesMin: ['D', 'S', 'T', 'Q', 'Q', 'S', 'S', 'D'],
            dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb', 'Dom'],
            monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
            monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
            nextText: 'Próximo',
            prevText: 'Anterior'
        });
    }

    $('.remote-form').submit(function(event)
    {
        event.preventDefault();
        $.ajax({
            type: "POST",
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: "script"
        });
    });

    $(document).on('click', '.remote-link', function(event){
        event.preventDefault();
        $.ajax({
            type: "GET",
            url: $(this).attr('href'),
            dataType: "script"
        });
    });

    $('.questions').sortable({
        connectWith: '.questions',
        placeholder: "question-placeholder",
        stop: function(event, ui) {
            var area1_array = $('#area1').sortable('toArray');
            var area2_array = $('#area2').sortable('toArray');
            var area3_array = $('#area3').sortable('toArray');
            var area4_array = $('#area4').sortable('toArray');
            var post_data = {area1: area1_array, area2: area2_array, area3: area3_array, area4: area4_array};
            $.post("sort_questions.php", post_data);
        }
    });

});

function genderGraphic(data, titulo, id){
    $(id).highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false
        },
        title: { text: titulo },
        tooltip: {
            pointFormat: '{series.name}: <b>({point.percentage:.1f}%)</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                },
                showInLegend: true
            }
        },
        series: [{
            type: 'pie',
            name: 'Dados',
            data: data
        }]
    });
}
function genderGraphicColuna(data, titulo, eixoXText, id){
    $(id).highcharts({
        chart: {
            type: 'column'
        },
        yAxis: {
            min: 0,
            title: { text: 'Pontuação Média' }
        },
        xAxis: {
            categories: [eixoXText],
            crosshair: true
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.y}pts</b>'
        },
        plotOptions: {
            column: {
                dataLabels: {
                    enabled: true
                }
            }
        },
        title: { text: titulo },
        series: data
    });
}

function changeExportDate(dates){
    setExportDate(dates);
    $('#test').change(function(){
        setExportDate(dates);
    });
}

function setExportDate(dates){
    var date = dates[$("#test").val()];
    if(date == null)
        date = 'Nunca';
    $('.last-export-date span').text(date);
}