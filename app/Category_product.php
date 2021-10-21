<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category_product extends Model
{
    public $timetamps= false;
    protected $fillable =[
        'category_name','category_desc','category_status','slug_category','category_keywords','category_parent','category_order'];
    protected $primaryKey ='category_id';
    protected $table ='tbl_category_product';
}
