<?php namespace tinkoff;

use Illuminate\Database\Eloquent\Model;

class Exchange extends Model {

    protected $fillable = ['category', 'operation', 'from', 'to', 'value'];

}
