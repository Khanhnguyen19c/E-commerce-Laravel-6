<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feeship extends Model
{
    public $timetamps= false;
    protected $fillabe=[
        'fee_matp' ,'fee_maqh','fee_xaid','fee_feeship'];
    protected $primaryKey ='fee_id';
    protected $table ='tbl_feeship';
    public function city(){
        return $this->belongsTo('App\City','fee_matp'); //1 dữ liệu thì thuộc về một thành phố
    }
    public function province(){
        return $this->belongsTo('App\Province','fee_maqh');
    }
    public function wards(){
        return $this->belongsTo('App\Wards','fee_xaid');
    }
}
