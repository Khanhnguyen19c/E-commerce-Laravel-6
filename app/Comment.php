<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;
class Comment extends Model
{
    public $timetamps= false;
    protected $fillabe=[
        'comment' ,'comment_name','comment_status','comment_product_id','created_at','updated_at'];
    protected $primaryKey ='comment_id';
    protected $table ='tbl_comments';
    public function product(){
        return $this->belongsTo('App\Product','comment_product_id'); // lấy sản phẩm theo thương hiệu
      }
}
