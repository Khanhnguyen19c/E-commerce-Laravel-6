<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductSize extends Model
{
    public $timestamps= false;
    protected $fillable=[
        'product_id','product_size','product_quantity_size'];
    protected $primaryKey ='product_size_id';
    protected $table ='tbl_product_size';
    public function product(){
        return $this->belongsTo('App\Product','product_id'); // lấy sản phẩm theo thương hiệu
      }
}
