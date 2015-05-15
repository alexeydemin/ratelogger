<?php namespace tinkoff\Http\Controllers;

use tinkoff\Parser;
use tinkoff\Exchange;

class ParserController extends Controller {

    public function __construct()
    {
        $this->middleware('guest');
    }


    public function index()
    {
        $parser = new Parser();
        $data = $parser->parse();
        $obj  =json_decode($data);
        $rates = $obj->payload->rates;

        //var_dump($rates);
        foreach( $rates as $rate ){
            $row = new Exchange();
            $row->category  = $rate->category;
            $row->operation = 'buy';
            $row->from      = $rate->fromCurrency->name;
            $row->to        = $rate->toCurrency->name;
            $row->value     = $rate->buy;
            //$row->save();
            if( isset( $rate->sell ) ){
                $row = new Exchange();
                $row->category  = $rate->category;
                $row->operation = 'sell';
                $row->from      = $rate->fromCurrency->name;
                $row->to        = $rate->toCurrency->name;
                $row->value     = $rate->sell;
                //$row->save();
            }

            echo $rate->category . '-'
               . $rate->fromCurrency->name . '-'
               . $rate->toCurrency->name . '-'
               . $rate->buy . '-'
               . ( isset( $rate->sell ) ? $rate->sell : '0000' )
               . '<br>'
               ;

        }
        //return view('welcomezz');
    }

    public function chart(){
        return Exchange::all();
    }
}