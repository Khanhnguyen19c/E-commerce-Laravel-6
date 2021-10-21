<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    public $timetamps= false;
    protected $fillabe=[
        'shipping_name' ,'shipping_address','shipping_phone','shipping_email','shipping_notes','shipping_method'];
    protected $primaryKey ='shipping_id';
    protected $table ='tbl_shipping';
}
