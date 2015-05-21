<?php namespace tinkoff\Http\Controllers;

use tinkoff\Parser;
use tinkoff\Exchange;
use tinkoff\Update;
use Illuminate\Http\Request;
use DB;

class ParserController extends Controller {

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function proceed(Request $request){
        $updates = Update::all();

        if( $_SERVER['REQUEST_METHOD'] == 'GET' ){
            //Sell initial data if get request
            $request->debit_card_transfer = 1;
            $request->sell = 1;
            $request->USDRUB =1;
        }

        $dates=[];
        foreach( $updates->lists('created_at') as $up )
            $dates[] = $up->format('d.m.Y H:i');

     /* | DepositClosingBenefit  |
        | DepositClosing         |
        | DepositPayments        |
        | DebitCardsTransfers    |
        | DebitCardsOperations   |
        | CreditCardsOperations  |
        | CreditCardsTransfers   |
        | PrepaidCardsTransfers  |
        | PrepaidCardsOperations |
        | SavingAccountTransfers | */

        //categories
        $categories = array();
        if( $request->credit_card_transfer )    $categories[] = 'CreditCardsTransfers';
        if( $request->credit_card_operations)   $categories[] = 'CreditCardsOperations';
        if( $request->debit_card_transfer)      $categories[] = 'DebitCardsTransfers';
        if( $request->debit_card_operations)    $categories[] = 'DebitCardsOperations';
        if( $request->deposit_payments )        $categories[] = 'DepositPayments';
        if( $request->deposit_closing_benefit ) $categories[] = 'DepositClosingBenefit';
        if( $request->deposit_closing )         $categories[] = 'DepositClosing';
        if( $request->prepaid_card_transfer )   $categories[] = 'PrepaidCardTransfer';
        if( $request->prepaid_card_operations ) $categories[] = 'PrepaidCardOperations';

        //operations
        $operations = array();
        if( $request->buy )  $operations[] = 'buy';
        if( $request->sell ) $operations[] = 'sell';

        //currencies
        $from = array();
        $to = array();
        if( $request->USDRUB ){
            $from[] = 'USD'; $to[] = 'RUB';
        }

        $exchanges = DB::table('exchanges')
                       ->whereIn('category', $categories )
                       ->whereIn('operation', $operations )
                       ->whereIn('from', $from )
                       ->whereIn('to', $to )
                       ->get();

        $rates = array();
        foreach($exchanges as $rate){
            $rates[ $rate->category . '_'
                  . $rate->operation . '_'
                  . $rate->from . '_'
                  . $rate->to
                  ][] = $rate->value;
        }

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

        $data = array();
        foreach( $rates as $label => $r  ){
            $color = array_pop($colors);
            $data[] = array( 'label' => $label
                           , 'data'=> $r
                           , 'strokeColor' => '#' . $color['stroke']
                           , 'pointColor' => '#' . $color['point'] );
        }

        return view('chart')->with('updates', $dates)->with('data', $data)->with('request', $request);
    }
}