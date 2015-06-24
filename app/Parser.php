<?php namespace tinkoff;

use Curl\Curl;
use Illuminate\Database\Eloquent\Model;

class Parser extends Model{

    public $curl;

    public function __construct(Curl $curl)
    {
        $this->curl = $curl;
    }

    public function parse()
    {
        $obj = $this->curl->get('https://www.tinkoff.ru/api/v1/currency_rates/');
        $rates = $obj->payload->rates;
        $hash = md5(serialize($rates));
        $last_update = Update::all()->last();
        if ( $last_update && $hash == $last_update->hash ){
            //nothing changed
            return "Nothing to update\n";
        }
        $update = Update::create(['hash' => $hash]);

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
        }
    }

}