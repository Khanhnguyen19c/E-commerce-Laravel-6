<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    public $timetamps= false;
    protected $fillabe=[
        'brand_name' ,'brand_desc','slug_brand','brand_desc','brand_status'];
    protected $primaryKey ='brand_id';
    protected $table ='tbl_brand_product';

     public function product(){
        return $this->hasMany('App\Product','brand_id'); // lấy sản phẩm theo thương hiệu
     }
}
