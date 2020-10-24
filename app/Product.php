<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $table='products';
    protected $fillable=['category_id','product_name','price','description','image','stock','pro_sale'];


public function category(){
	return $this->belongsTo('App\Category','category_id','id');
}
public function sale(){
	return $this->hasOne('App\Sale','product_id','id');
}
// public fuction setSaleAttribute($value){
// 	if($value==true){
// 		 $this->attributes['sale']=1;
// 	}else{
// 		 $this->attributes['sale']=0;
// 	}
//  }
}
