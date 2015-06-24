<?php namespace tinkoff\Http\Controllers;

use tinkoff\Update;
use Request;
use Illuminate\Support\Input;
use DB;

class ParserController extends Controller {

    public $colors;
    public $labels;
    public $input = [];
    public $categories = [];
    public $operations = [];
    public $from = [];
    public $to = [];


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
        $label['opr']['buy'] = 'Покупка';
        $label['opr']['sell'] = 'Продажа';
        $label['cur']['USDRUB'] = null;
        $label['cur']['USDEUR'] = null;
        $label['cur']['USDGBP'] = null;
        $label['cur']['EURRUB'] = null;
        $label['cur']['EURUSD'] = null;
        $label['cur']['EURGBP'] = null;
        $label['cur']['GBPRUB'] = null;
        $label['cur']['GBPUSD'] = null;
        $label['cur']['GBPEUR'] = null;

        $this->labels = $label;
    }

    public function proceed()
    {
        $js_data = $this->get_data();

        return view('purechart')->with('data',    $js_data)
                                ->with('input',   $this->input )
                                ->with('width',   23*count($js_data['AxisLabels']));
    }

    protected function decorate_label( $label )
    {
        list($category, $operation, $from, $to) = explode('_', $label);
        $operation = $this->labels['opr'][$operation];
        $category = $this->labels['cat'][$category];

        return "$operation $from за $to ($category)";
    }

    protected function decorate_dates( $dates )
    {
        $saved = '';
        foreach ($dates as &$date) {
            $tmp = $date;
            if( strncmp($date, $saved, 10) === 0 )
            $date = substr($date, 11);
            $saved = $tmp;
        }

        return $dates;
    }

    /**
     * @return array
     */
    public function get_data()
    {
        $input  = [];
        foreach ($this->labels as $type => $value) {
            foreach ($value as $name => $lbl) {
                $input[$type][$name] = Request::input("$type.$name", null);

                if ($input[$type][$name]) {
                    if ($type == 'cat') $this->categories[] = $name;
                    if ($type == 'opr') $this->operations[] = $name;
                    if ($type == 'cur') {
                        $this->from[] = substr($name, 0, 3);
                        $this->to[] = substr($name, 3, 3);
                    }
                }
            }
        }

        $updates = Update::all();
        $dates = [];
        foreach ($updates->lists('created_at') as $up)
            $dates[] = $up->format('d.m.Y H:i');

        $from = $this->from;
        $to = $this->to;
        $exchanges = DB::table('exchanges')
            ->whereIn('category', $this->categories)
            ->whereIn('operation', $this->operations)
            ->where(function ($q) use ($from, $to) {
                $wh = '';
                foreach ($from as $key => $fr) {
                    $wh .= "`from`='{$from[$key]}' AND `to`='{$to[$key]}' OR ";
                }
                $wh .= '1=0';
                $q->whereRaw($wh);
            })
            ->get();

        $rates = [];
        foreach ($exchanges as $rate) {
            $rates[$rate->category . '_'
            . $rate->operation . '_'
            . $rate->from . '_'
            . $rate->to][] = $rate->value;
        }


        $data = [];
        foreach ($rates as $label => $r) {
            $color = array_pop($this->colors);
            $data[] = array('label' => $this->decorate_label($label)
            , 'data' => $r
            , 'strokeColor' => '#' . $color['stroke']
            , 'pointColor' => '#' . $color['point']);
        }
        usort($data, function($a, $b){ return $b['data'][0] - $a['data'][0]; }  );
        $json_data['DataSets'] = $data;
        $json_data['AxisLabels'] = $this->decorate_dates($dates);

        $this->input = $input;

        return $json_data;
    }


}