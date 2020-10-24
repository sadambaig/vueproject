<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    //
    protected $table='sales';
    protected $fillable=['product_id',
							'percentage',
							'form',
							'to',
							];
	public function product(){
		return $this->belongsTo('App\Product','product_id','id');
	}
}
