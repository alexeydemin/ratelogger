@extends('main')
@section('content')
<div class="container">
  <div class="row"> <!-- big row -->

    



    <div class="col-md-3">
      <div class="container">

          <!-- CATEGORIES -->
          <div class="row" >
          {!! Form::open() !!}
              <div class="col-md-3" style="background-color:#ffdd2e">
                <div class="table-responsive">
                  <table class="table">
                    <tr>
                      <td></td><td>+</td><td>-</td>
                    </tr>
                    <tr>
                      <td>Кредитная карта</td>
                      <td>{!! Form::checkbox('credit_card_transfer') !!}</td>
                      <td>{!! Form::checkbox('credit_card_operations') !!}</td>
                    </tr>
                    <tr>
                      <td>Дебетовая карта</td>
                      <td>{!! Form::checkbox('debit_card_transfer', 1, true, ['class' => 'form-control']) !!}</td>
                      <td>{!! Form::checkbox('debit_card_operations') !!}</td>
                    </tr>
                    <tr>
                      <td>Вклад
                      <td>{!! Form::checkbox('deposit_payments') !!}</td>
                      <td>{!! Form::checkbox('deposit_closing_benefit') !!}
                            {!! Form::checkbox('deposit_closing') !!}</td>
                    </tr>
                    <tr>
                      <td>Электронные деньги</td>
                      <td>{!! Form::checkbox('prepaid_card_transfer') !!}</td>
                      <td> {!! Form::checkbox('prepaid_card_operations') !!}</td>
                    </tr>
                  </table>
                </div>
              </div>
          </div>
          <!-- /CATEGORIES-->



          <!-- OPERATIONS -->
          <div class="row" >
            <div class="col-md-3" style="background-color:#ffe86a">
              <div class="table-responsive">
                <table class="table">
                  <tr>
                    <td>Покупка</td>
                    <td>Продажа</td>
                  </tr>
                  <tr>
                    <td>{!! Form::checkbox('buy', 1, true) !!}</td>
                    <td>{!! Form::checkbox('sell') !!}</td>
                  </tr>
                </table>
              </div>
            </div>
          </div>
          <!-- /OPERATIONS -->



          <!-- CURRENCIES -->
          <div class="row" >
            <div class="col-md-3" style="background-color:#fff2ac">
              <div class="table-responsive">
                <table class="table">
                  <tr>
                    <td>&Oslash;</td><td>P</td><td>$</td><td>&euro;</td><td>&pound;</td>
                  </tr>
                  <tr>
                    <td>P</td><td>&Oslash;</td><td>{!! Form::checkbox('RUBUSD', 1, true) !!}</td><td>{!! Form::checkbox('RUBEUR') !!}</td><td>{!! Form::checkbox('RUBGBP') !!}</td>
                  </tr>
                  <tr>
                    <td>$</td><td>{!! Form::checkbox('USDRUB') !!}</td><td>&Oslash;</td><td>{!! Form::checkbox('USDEUR') !!}</td><td>{!! Form::checkbox('USDGBP') !!}</td>
                  </tr>
                  <tr>
                    <td>&euro;</td><td>{!! Form::checkbox('EURRUB') !!}</td><td>{!! Form::checkbox('EURUSD') !!}</td><td>&Oslash;</td><td>{!! Form::checkbox('EURGBP') !!}</td>
                  </tr>
                  <tr>
                    <td>&pound;</td><td>{!! Form::checkbox('GBPRUB') !!}</td><td>{!! Form::checkbox('GBPUSD') !!}</td><td>{!! Form::checkbox('GBPEUR') !!}</td><td>&Oslash;</td>
                  </tr>
                </table>
              </div>
            </div>
          </div>
          <!-- /CURRENCIES -->

        <div class="row">
            {!! Form::submit('Применить', ['class' => 'btn btn-primary'] ) !!}
            {!! Form::close() !!}
        </div>
      </div>
    </div>



    <div class="col-md-1"></div>
    <div class="col-md-8" style="background-color: aliceblue">
        <!-- Водка-водка-водка и пивко -->
        <canvas id="report" width="700" height="500"></canvas>
    </div>
  </div>
</div>
@endsection

@section('footer')
<script src="/js/chart.min.js"></script>

<script>
    (function(){
        var ctx = document.getElementById('report').getContext('2d');
        var chart = {
            labels: {!! json_encode($updates) !!},
            datasets: {!! json_encode($data) !!}

        };

        new Chart(ctx).Line(chart, {bezierCurve:false, datasetFill : false, multiTooltipTemplate: "<%= datasetLabel %> - <%= value %>"});
    })();
</script>
@endsection