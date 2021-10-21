<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    public $timetamps= false;
    protected $fillabe=[
        'name_qh' ,'type','matp'];
    protected $primaryKey ='maqh';
    protected $table ='tbl_quanhuyen';
}
