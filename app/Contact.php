<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    public $timestamps= false;
    protected $fillabe=[
        'info_contact' ,'info_map','info_image','info_logo','slogan_logo','info_fanpage'];
    protected $primaryKey ='info_id';
    protected $table ='tbl_contact';
}
