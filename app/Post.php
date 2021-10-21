<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category_Post;
class Post extends Model
{
    public $timetamps= false;
    protected $fillabe=[
        'post_title','category_post_id','post_desc','post_content','post_slug','post_meta_desc','post_meta_keywords','post_status','post_image'];
    protected $primaryKey ='post_id';
    protected $table ='tbl_posts';
     public function cate_post(){
       return $this->belongsTo('App\Category_Post','category_post_id'); // lấy sản phẩm theo thương hiệu
     }
}
