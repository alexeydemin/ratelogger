$(document).ready(function(){
    //Set initial checkboxes
    $('[name="cat[DebitCardsTransfers]"]').prop('checked', true);
    $('[name="opr[sell]"]').prop('checked', true);
    $('[name="cur[USDRUB]"]').prop('checked', true);

    $(':checkbox').click(function(){
        GetChartData();
    });
    GetChartData();
});

function WriteLegend( data ){
    $('#legend').empty();
    $.each(data, function( key, value){
        var str = '<tr><td class="tab"><div class="circle" style="background:' + value.pointColor + '"></div></td><td>' +  value.label + '</td></tr>';
        $('#legend').append(str);
    });
}

function GetChartData(){
    $.ajax({
        url: '/json',
        method: 'GET',
        data: $('#checkboxes').serialize(),
        dataType: 'json',
        success: function (d) {
            chartData = {
                labels: d.AxisLabels,
                datasets: d.DataSets
            };

            prepareCanvas(chartData);
            WriteLegend(chartData.datasets);
        }
    });
}

function prepareCanvas(chartData){

//        console.log( 'chartdata=<' + chartData.datasets + '>' );
//        console.log( chartData.datasets.length );
//        console.log( chartData );

    if( !chartData.datasets.length ){
        lineChart.destroy();
        return false;
    }

    if (typeof lineChart != "undefined") {
        lineChart.destroy();
    }

    var ctx = document.getElementById('report').getContext('2d');
    lineChart = new Chart(ctx).Line(chartData, { bezierCurve: false,
        datasetFill : false,
        pointHitDetectionRadius : 3,
        //animation: false,
        multiTooltipTemplate: "<%= datasetLabel %> - <%= value %>"
    });
}
