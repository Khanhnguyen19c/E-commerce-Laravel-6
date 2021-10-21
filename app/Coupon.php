<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    public $timetamps= false;
    protected $fillabe=[
        'coupon_name' ,'coupon_code','coupon_time','coupon_number','coupon_condition','coupon_used','coupon_date_end','coupon_date_start'];
    protected $primaryKey ='coupon_id';
    protected $table ='tbl_coupon';
}
