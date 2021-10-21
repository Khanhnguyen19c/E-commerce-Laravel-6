<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wards extends Model
{
    public $timetamps= false;
    protected $fillabe=[
        'name_xaphuong' ,'type','maqh'];
    protected $primaryKey ='xaid';
    protected $table ='tbl_xaphuongthitran';
}
