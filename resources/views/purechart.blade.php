@extends('main')
@section('content')

<div class="pure-g"><!-- first-row -->
  <div class="pure-u-1-6"><!-- left settings column-->
  {!! Form::open( array('id' => 'checkboxes') ) !!}
    <!-- /CATEGORIES-->
    <div class="settings">
    <div class="stn" id="cts">
      <div class="pure-g stnr"><!-- first-settings-row empty #ffdd2e -->
        <div class="pure-u-3-5"></div>
        <div class="pure-u-1-5"><span title="Пополнение">+</span></div>
        <div class="pure-u-1-5"><span title="Операции">-</span></div>
      </div><!-- /first-settings-row -->
      <div class="pure-g stnr"><!-- second-settings-row credit card #ffdd2e -->
        <div class="pure-u-3-5">Кредитная карта</div>
        <div class="pure-u-1-5">{!! Form::checkbox('cat[CreditCardsTransfers]', 1, $input['cat']['CreditCardsTransfers'], ['class' => 'cb', 'title' => 'Кредитная карта, пополнение']) !!}</div>
        <div class="pure-u-1-5">{!! Form::checkbox('cat[CreditCardsOperations]', 1, $input['cat']['CreditCardsOperations'], ['class' => 'cb', 'title' => 'Кредитная карта, операции']) !!}</div>
      </div>
      <div class="pure-g stnr"><!-- third-settings-row debit card #ffdd2e -->
        <div class="pure-u-3-5">Дебетовая карта</div>
        <div class="pure-u-1-5">{!! Form::checkbox('cat[DebitCardsTransfers]', 1, $input['cat']['DebitCardsTransfers'], ['title' => 'Дебетовая карта, пополнение']) !!}</div>
        <div class="pure-u-1-5">{!! Form::checkbox('cat[DebitCardsOperations]', 1, $input['cat']['DebitCardsOperations'], ['title' => 'Дебетовая карта, операции']) !!}</div>
      </div>
      <div class="pure-g stnr"><!-- fourth-settings-row deposit #ffdd2e -->
        <div class="pure-u-3-5">Вклад</div>
        <div class="pure-u-1-5">{!! Form::checkbox('cat[DepositPayments]', 1, $input['cat']['DepositPayments'], ['title' => 'Вклад, пополнение']) !!}</div>
        <div class="pure-u-1-5">{!! Form::checkbox('cat[DepositClosingBenefit]', 1, $input['cat']['DepositClosingBenefit'], ['title' => 'Вклад, закрытие']) !!}
                                {!! Form::checkbox('cat[DepositClosing]', 1, $input['cat']['DepositClosing'], ['title' => 'Вклад, досрочное изъятие']) !!}</div>
      </div>
      <div class="pure-g stnr"><!-- fourth-settings-row deposit #ffdd2e -->
        <div class="pure-u-3-5">Электронные ДС</div>
        <div class="pure-u-1-5">{!! Form::checkbox('cat[PrepaidCardsTransfers]', 1, $input['cat']['PrepaidCardsTransfers'], ['title' => 'Электронные ДС, пополнение']) !!}</div>
        <div class="pure-u-1-5">{!! Form::checkbox('cat[PrepaidCardsOperations]', 1, $input['cat']['PrepaidCardsOperations'], ['title' => 'Электронные ДС, операции']) !!}</div>
      </div>
    </div>
    <!-- /CATEGORIES-->
    <!-- OPERATIONS -->
    <div class="stn" id="ops">
      <div class="pure-g stnr"><!-- fifth-settings-row titles #ffe86a -->
        <div class="pure-u-1-2">Покупка</div>
        <div class="pure-u-1-2">Продажа</div>
      </div>
      <div class="pure-g stnr"><!-- sixth-settings-row titles #ffe86a -->
        <div class="pure-u-1-2">{!! Form::checkbox('opr[buy]', 1, $input['opr']['buy'], ['title' => 'Покупка банком']) !!}</div>
        <div class="pure-u-1-2">{!! Form::checkbox('opr[sell]', 1, $input['opr']['sell'], ['title' => 'Продажа банком']) !!}</div>
      </div>
    </div>
    <!-- /OPERATIONS -->
    <!-- CURRENCIES -->
    <div class="stn" id="crs">
      <div class="pure-g stnr"><!-- 0-currencies-row titles #fff2ac -->
        <div class="pure-u-1-5">&Oslash;</div>
        <div class="pure-u-1-5">P</div>
        <div class="pure-u-1-5">$</div>
        <div class="pure-u-1-5">&euro;</div>
        <div class="pure-u-1-5">&pound;</div>
      </div>
      <div class="pure-g stnr">
        <div class="pure-u-1-5">P</div>
        <div class="pure-u-1-5">&Oslash;</div>
        <div class="pure-u-1-5">{!! Form::checkbox('RUBUSD', 1, null, ['disabled']) !!}</div>
        <div class="pure-u-1-5">{!! Form::checkbox('RUBEUR', 1, null, ['disabled']) !!}</div>
        <div class="pure-u-1-5">{!! Form::checkbox('RUBGBP', 1, null, ['disabled']) !!}</div>
       </div>
      <div class="pure-g stnr">
        <div class="pure-u-1-5">$</div>
        <div class="pure-u-1-5">{!! Form::checkbox('cur[USDRUB]', 1, $input['cur']['USDRUB'], ['title' => 'USD/RUB']) !!}</div>
        <div class="pure-u-1-5">&Oslash;</div>
        <div class="pure-u-1-5">{!! Form::checkbox('cur[USDEUR]', 1, $input['cur']['USDEUR'], ['title' => 'USD/EUR']) !!}</div>
        <div class="pure-u-1-5">{!! Form::checkbox('cur[USDGBP]', 1, $input['cur']['USDGBP'], ['title' => 'USD/GBP']) !!}</div>
      </div>
      <div class="pure-g stnr">
        <div class="pure-u-1-5">&euro;</div>
        <div class="pure-u-1-5">{!! Form::checkbox('cur[EURRUB]', 1, $input['cur']['EURRUB'], ['title' => 'EUR/RUB']) !!}</div>
        <div class="pure-u-1-5">{!! Form::checkbox('cur[EURUSD]', 1, $input['cur']['EURUSD'], ['title' => 'EUR/USD']) !!}</div>
        <div class="pure-u-1-5">&Oslash;</div>
        <div class="pure-u-1-5">{!! Form::checkbox('cur[EURGBP]', 1, $input['cur']['EURGBP'], ['title' => 'EUR/GBP']) !!}</div>
      </div>
      <div class="pure-g stnr">
        <div class="pure-u-1-5">&pound;</div>
        <div class="pure-u-1-5">{!! Form::checkbox('cur[GBPRUB]', 1, $input['cur']['GBPRUB'], ['title' => 'GBP/RUB']) !!}</div>
        <div class="pure-u-1-5">{!! Form::checkbox('cur[GBPUSD]', 1, $input['cur']['GBPUSD'], ['title' => 'GBP/USD']) !!}</div>
        <div class="pure-u-1-5">{!! Form::checkbox('cur[GBPEUR]', 1, $input['cur']['GBPEUR'], ['title' => 'GBP/EUR']) !!}</div>
        <div class="pure-u-1-5">&Oslash;</div>
      </div>
    </div>
    </div>
    <!-- /CURRENCIES -->
  {!! Form::close() !!}
  </div><!-- /left settings column-->

  <div class="pure-u-5-6" ><!-- right chart column-->
      <div class="chart"><canvas id="report"  width="{{$width}}" height="500"></canvas></div>
  </div><!-- right chart column-->
</div> <!-- /first row -->


<div class="pure-g"> <!-- second row -->
  <div class="pure-u-1-6"></div>
  <div class="pure-u-5-6">
    <table class="tab" id="legend">
    </table>
  </div>
</div> <!-- /second row -->
@endsection

@section('footer')
<script src="/js/chart.min.js"></script>
<script>
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

</script>
<style>
    #cts {background-color: #ffdd2e}
    #ops {background-color: #ffe86a}
    #crs {background-color: #fff2ac}

    .stn{
        padding-bottom:2em;
        padding-left:1em;
    }
    .stnr{
        padding:.3em;
    }
    .chart{
        /*max-width: 1000px;*/
        overflow-x:scroll;
        background-color: aliceblue;
        padding: 2em;
        height:520px;
    }
    .settings{
        height:578px;
        background-color: #fff2ac;
    }
    .circle {
        border-radius: 50%/50%;
        width: 20px;
        height: 20px;
        background: black;
    }
    .tab {
            padding: 3px;

    }
    table.tab{
        margin-top:2em;
    }

    .pure-g [class*="pure-u"] {
        font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
        color: #333;
        font-size: 14px;
    }

</style>
@endsection