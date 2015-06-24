new Vue({
    el: '#ratelogger',

    data: {
        debitcardstransfers: true,
        sell: true,
        usdrub: true
    },

    ready: function() {
        postRequest();
    },

    methods: {
        onClick: function (e) {
            postRequest();
        }
    }
});

function prepareCanvas(chartData){

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

function WriteLegend( data ){
    $('#legend').empty();
    $.each(data, function( key, value){
        var str = '<tr><td class="tab"><div class="circle" style="background:' + value.pointColor + '"></div></td><td>' +  value.label + '</td></tr>';
        $('#legend').append(str);
    });
}

function postRequest(){
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