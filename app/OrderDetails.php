<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    public $timetamps= false;
    protected $fillabes=[
        'order_code' ,'product_id','product_name','product_price','product_save_quantity','product_coupon','product_feeship'];
    protected $primaryKey ='order_details_id';
    protected $table ='tbl_order_details';
    public function product(){
        return  $this->belongsTo('App\Product','product_id'); //thuộc về model product
    }
}
