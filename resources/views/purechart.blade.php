@extends('main')
@section('content')

<div class="pure-g" v-on = "click: onClick"><!-- first-row -->
  <div class="pure-u-1-6"><!-- left settings column-->
  {!! Form::open( array('id' => 'checkboxes') ) !!}
    <!-- /CATEGORIES-->
    <div class="settings">
    <div class="stn" id="cts">
      <div class="pure-g stnr">
        <div class="pure-u-3-5"></div>
        <div class="pure-u-1-5"><span title="Пополнение">+</span></div>
        <div class="pure-u-1-5"><span title="Операции">-</span></div>
      </div>
      <div class="pure-g stnr">
        <div class="pure-u-3-5">Кредитная карта</div>
        <div class="pure-u-1-5">{!! Form::checkbox('cat[CreditCardsTransfers]', 1, $input['cat']['CreditCardsTransfers'], ['title' => 'Кредитная карта, пополнение']) !!}</div>
        <div class="pure-u-1-5">{!! Form::checkbox('cat[CreditCardsOperations]', 1, $input['cat']['CreditCardsOperations'], ['title' => 'Кредитная карта, операции']) !!}</div>
      </div>
      <div class="pure-g stnr">
        <div class="pure-u-3-5">Дебетовая карта</div>
        <div class="pure-u-1-5">{!! Form::checkbox('cat[DebitCardsTransfers]', 1, $input['cat']['DebitCardsTransfers'], ['v-model' => 'debitcardstransfers', 'title' => 'Дебетовая карта, пополнение']) !!}</div>
        <div class="pure-u-1-5">{!! Form::checkbox('cat[DebitCardsOperations]', 1, $input['cat']['DebitCardsOperations'], ['title' => 'Дебетовая карта, операции']) !!}</div>
      </div>
      <div class="pure-g stnr">
        <div class="pure-u-3-5">Вклад</div>
        <div class="pure-u-1-5">{!! Form::checkbox('cat[DepositPayments]', 1, $input['cat']['DepositPayments'], ['title' => 'Вклад, пополнение']) !!}</div>
        <div class="pure-u-1-5">{!! Form::checkbox('cat[DepositClosingBenefit]', 1, $input['cat']['DepositClosingBenefit'], ['title' => 'Вклад, закрытие']) !!}
                                {!! Form::checkbox('cat[DepositClosing]', 1, $input['cat']['DepositClosing'], ['title' => 'Вклад, досрочное изъятие']) !!}</div>
      </div>
      <div class="pure-g stnr">
        <div class="pure-u-3-5">Электронные ДС</div>
        <div class="pure-u-1-5">{!! Form::checkbox('cat[PrepaidCardsTransfers]', 1, $input['cat']['PrepaidCardsTransfers'], ['title' => 'Электронные ДС, пополнение']) !!}</div>
        <div class="pure-u-1-5">{!! Form::checkbox('cat[PrepaidCardsOperations]', 1, $input['cat']['PrepaidCardsOperations'], ['title' => 'Электронные ДС, операции']) !!}</div>
      </div>
    </div>
    <!-- /CATEGORIES-->
    <!-- OPERATIONS -->
    <div class="stn" id="ops">
      <div class="pure-g stnr">
        <div class="pure-u-1-2">Покупка</div>
        <div class="pure-u-1-2">Продажа</div>
      </div>
      <div class="pure-g stnr">
        <div class="pure-u-1-2">{!! Form::checkbox('opr[buy]', 1, $input['opr']['buy'], ['title' => 'Покупка банком']) !!}</div>
        <div class="pure-u-1-2">{!! Form::checkbox('opr[sell]', 1, $input['opr']['sell'], ['v-model'=> 'sell', 'title' => 'Продажа банком']) !!}</div>
      </div>
    </div>
    <!-- /OPERATIONS -->
    <!-- CURRENCIES -->
    <div class="stn" id="crs">
      <div class="pure-g stnr">
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
        <div class="pure-u-1-5">{!! Form::checkbox('cur[USDRUB]', 1, $input['cur']['USDRUB'], ['v-model'=> 'usdrub', 'title' => 'USD/RUB']) !!}</div>
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


<div class="pure-g"> <!-- legend row -->
  <div class="pure-u-1-6"></div>
  <div class="pure-u-5-6">
    <table class="tab" id="legend">
    </table>
  </div>
</div> <!-- /legend row -->
@endsection

@section('footer')
<script src="/js/vendor.js"></script>
<script src="/js/app.js"></script>
@endsection