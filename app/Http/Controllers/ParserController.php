<?php namespace tinkoff\Http\Controllers;

use tinkoff\Parser;
use tinkoff\Exchange;
use tinkoff\Update;

class ParserController extends Controller {

    public function __construct()
    {
        $this->middleware('guest');
    }


    public function index()
    {
        $parser = new Parser();
        $data = $parser->get_text();
        $obj  =json_decode($data);
        $rates = $obj->payload->rates;

        $hash = md5(serialize($rates));
        $last_update = Update::all()->last();
        if ( $last_update && $hash == $last_update->hash ){
            //nothing changed
            return 'Nothing to update';
        }
        $update = Update::create(['hash' => $hash]);
        //var_dump($rates);
        foreach( $rates as $rate ){
            $row = new Exchange();
            $row->category  = $rate->category;
            $row->operation = 'buy';
            $row->from      = $rate->fromCurrency->name;
            $row->to        = $rate->toCurrency->name;
            $row->value     = $rate->buy;
            $row->update_id = $update->id;
            $row->save();
            if( isset( $rate->sell ) ){
                $row = new Exchange();
                $row->category  = $rate->category;
                $row->operation = 'sell';
                $row->from      = $rate->fromCurrency->name;
                $row->to        = $rate->toCurrency->name;
                $row->value     = $rate->sell;
                $row->update_id = $update->id;
                $row->save();
            }

            echo $rate->category . '-'
               . $rate->fromCurrency->name . '-'
               . $rate->toCurrency->name . '-'
               . $rate->buy . '-'
               . ( isset( $rate->sell ) ? $rate->sell : '' )
               . '<br>'
               ;

        }
        //return view('welcomezz');
    }

    public function chart(){
        return Exchange::all();
    }
}