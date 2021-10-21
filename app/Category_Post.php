<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category_Post extends Model
{
    public $timetamps= false;
    protected $fillable =[
        'category_post_name','category_post_desc','category_post_status','category_post_slug'];
    protected $primaryKey ='category_post_id';
    protected $table ='tbl_category_post';
}
