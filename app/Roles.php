<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    public $timetamps= false;
    protected $fillabe=[
        'name'];
    protected $primaryKey ='id_roles';
    protected $table ='tbl_roles';
    public function admin(){
        return $this->belongsToMany('App\Admin');
    }
}
