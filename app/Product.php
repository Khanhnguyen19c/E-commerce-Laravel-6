<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $timestamps= false;
    protected $fillable=[
        'category_id','brand_id','product_name','product_desc','slug_product','product_content','product_tags','product_price','price_cost','price_sold','price_promotion','product_quantity','product_status','product_image','product_views','product_docs','created_at','update_at'];
    protected $primaryKey ='product_id';
    protected $table ='tbl_product';
    public function brand(){
        return $this->belongsTo('App\Brand','brand_id'); // lấy sản phẩm theo thương hiệu
      }
      public function category(){
        return $this->belongsTo('App\Category_product','category_id'); // lấy sản phẩm theo thương hiệu
      }
}
