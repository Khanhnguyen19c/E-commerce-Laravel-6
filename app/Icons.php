<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Icons extends Model
{
    public $timestamps = false;
    protected $fillable = [
         'icon_name', 'icon_link','icon_image'
    ];
    protected $primaryKey ='icon_id';
    protected $table ='tbl_icons';
}
