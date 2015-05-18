<?php namespace tinkoff;

use Illuminate\Database\Eloquent\Model;

class Exchange extends Model {

    protected $fillable = ['category', 'operation', 'from', 'to', 'value'];

    public function aupdate()
    {
        return $this->belongsTo('tinkoff\Update', null, null, 'update');
    }
}
