<?php namespace tinkoff;

use Illuminate\Database\Eloquent\Model;

class Update extends Model {

	protected $fillable = ['hash'];

    public function exchanges()
    {
        return $this->hasMany('tinkoff\Exchange');
    }

}
