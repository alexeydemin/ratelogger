<?php namespace tinkoff;

class Repository {

    public  $labels;
    public  $colors;

    function __construct()
    {
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

        $color = [
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

        $this->colors = $color;

    }

}