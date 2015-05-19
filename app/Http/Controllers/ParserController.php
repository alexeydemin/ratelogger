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

/*    public function chart(){
        $updates = Update::all();
        dd($updates); die;

        $dates=[];
        foreach( $updates->lists('created_at') as $up )
            $dates[] = $up->format('d.m.Y H:i');;

        return view('chart')->with('updates', $dates);
    }*/

    public function proceed(Request $request){
        $updates = Update::all();

        //dd( $request->buy );
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
        if( Request::get('credit_card_transfer') )
            $categories[] = 'CreditCardsTransfers';

        if( Request::get('credit_card_operations'))
            $categories[] = 'CreditCardsOperations';

        if( Request::get('debit_card_transfer'))
            $categories[] = 'DebitCardsTransfers';

        if( Request::get('debit_card_operations'))
            $categories[] = 'DebitCardsOperations';

        //operations
        $operations = array();
        if( Request::get('buy') )
            $operations[] = 'buy';

        if( Request::get('sell') )
            $operations[] = 'sell';

        //currencies
        $from = array();
        $to = array();
        if( Request::get('RUBUSD') ){
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
        //dd($data);
        return view('chart')->with('updates', $dates)->with('data', $data);
    }
}