<?php namespace tinkoff\Http\Controllers;

use tinkoff\Parser;
use tinkoff\Exchange;
use tinkoff\Update;
//use Illuminate\Http\Request;
use Request;
use Illuminate\Support\Input;
use DB;

class ParserController extends Controller {

    public $colors;
    public $labels;
    public $currencies;

    public function __construct()
    {
        $this->middleware('guest');
        $colors = [
            [ 'color'  => 'green'
                , 'stroke' => '9ee06e'
                , 'point'  => '5faa29' ],
            [ 'color'  => 'red'
                , 'stroke' => 'd76e6e'
                , 'point'  => 'aa2929' ],
            [ 'color'  => 'blue'
                , 'stroke' => '8a7aff'
                , 'point'  => '1e00ff' ],
            [ 'color'  => 'violet'
                , 'stroke' => 'e293ff'
                , 'point'  => 'ba00ff' ],
            [ 'color'  => 'orange'
                , 'stroke' => 'ffb763'
                , 'point'  => 'ff8a00' ],
            [ 'color'  => 'black'
                , 'stroke' => '9d9d9d'
                , 'point'  => '000000' ],
            [ 'color'  => 'brown'
                , 'stroke' => 'ca975a'
                , 'point'  => '4d2a00' ],
        ];

        $this->colors = $colors;

        $label['cat']['CreditCardsOperations']  = 'кредитные карты, операции';
        $label['cat']['CreditCardsTransfers']   = 'кредитные карты, пополнение';
        $label['cat']['DebitCardsOperations']   = 'дебетовые карты, операции';
        $label['cat']['DebitCardsTransfers']    = 'дебетовые карты, пополнение';
        $label['cat']['DepositClosing']         = 'досрочное изъятие вклада';
        $label['cat']['DepositClosingBenefit']  = 'закрытие вклада';
        $label['cat']['DepositPayments']        = 'пополнение вклада';
        $label['cat']['PrepaidCardsOperations'] = 'ЭДС, операции';
        $label['cat']['PrepaidCardsTransfers']  = 'ЭДС, переводы';
        $label['cat']['SavingAccountTransfers'] = 'накопительные счета';
        $label['ope']['buy'] = 'Покупка';
        $label['ope']['sell'] = 'Продажа';

        $this->labels = $label;

        $currencies = ['RUB', 'USD', 'EUR', 'GBP'];
        $this->currencies = $currencies;
    }

    public function proceed(Request $request)
    {

        $input = Request::all();

        //var_dump( $request->cur );
        if(!isset($input['cur']) ){
            $name = Request::input('name', 'Sally');;
        }

        //dd( Input::has('debit_card_transfer') );

        foreach($this->currencies as $cur1){
            foreach($this->currencies as $cur2){

            }
        }

        //dd( $request->cur );
        $updates = Update::all();//->take(15);
        if( $_SERVER['REQUEST_METHOD'] == 'GET' ){
            //Sell initial data if get request
            $request->debit_card_transfer = 1;
            $request->sell = 1;

            //dd($request);
            //dd($request->sell);
            $request->cur = [];
            $request->cur['USDRUB'] = 1;
        }

        $dates=[];
        foreach( $updates->lists('created_at') as $up )
            $dates[] = $up->format('d.m.Y H:i');

        //categories
        $categories = [];
        if( $request->credit_card_transfer )    $categories[] = 'CreditCardsTransfers';
        if( $request->credit_card_operations)   $categories[] = 'CreditCardsOperations';
        if( $request->debit_card_transfer)      $categories[] = 'DebitCardsTransfers';
        if( $request->debit_card_operations)    $categories[] = 'DebitCardsOperations';
        if( $request->deposit_payments )        $categories[] = 'DepositPayments';
        if( $request->deposit_closing_benefit ) $categories[] = 'DepositClosingBenefit';
        if( $request->deposit_closing )         $categories[] = 'DepositClosing';
        if( $request->prepaid_card_transfer )   $categories[] = 'PrepaidCardsTransfers';
        if( $request->prepaid_card_operations ) $categories[] = 'PrepaidCardsOperations';

        //operations
        $operations = [];
        if( $request->buy )  $operations[] = 'buy';
        if( $request->sell ) $operations[] = 'sell';

        //currencies
        $from = [];
        $to = [];
        if( isset( $request->cur ) ){
            foreach( $request->cur as $key => $value )
                if( in_array( substr($key,0,3), $this->currencies) &&  in_array(substr($key,3,3), $this->currencies ) ){
                    $from[] = substr($key,0,3); $to[] = substr($key,3,3);
                }
        }


/*        $exchanges = DB::table('exchanges')
                       ->whereIn('category', $categories )
                       ->whereIn('operation', $operations )
                       ->whereIn('from', $from )
                       ->whereIn('to', $to )
                       ->get();*/

          $exchanges = DB::table('exchanges')
                               ->whereIn('category', $categories )
                               ->whereIn('operation', $operations )
                               ->where(function($q) use($from, $to){
                                   // dd($from, $to);
                                    foreach( $from as $key => $fr )
                                        $q->where('from', '=', $from[$key])
                                          ->where('to', '=', $to[$key]);
                                })
                               ->get();


        $rates = array();
        foreach($exchanges as $rate){
            $rates[ $rate->category . '_'
                  . $rate->operation . '_'
                  . $rate->from . '_'
                  . $rate->to
                  ][] = $rate->value;
        }


        $data = array();
        foreach( $rates as $label => $r  ){
            $color = array_pop($this->colors);
            $data[] = array( 'label' => $this->prepare_label($label)
                           , 'data'=> $r
                           , 'strokeColor' => '#' . $color['stroke']
                           , 'pointColor' => '#' . $color['point'] );
        }

        $saved = '';
        foreach ($dates as &$date) {
            $tmp = $date;
            if( strncmp($date, $saved, 10) === 0 )
                $date = substr($date, 11);
            $saved = $tmp;
        }

        return view('purechart')->with('updates', $dates)
                            ->with('data', $data)
                            ->with('request', $request)
                            ->with('width', 23*count($dates));
    }

    protected function prepare_label( $label )
    {
        list($category, $operation, $from, $to) = explode('_', $label);
        $operation = $this->labels['ope'][$operation];
        $category = $this->labels['cat'][$category];
        return "$operation $from за $to ($category)";

    }
}