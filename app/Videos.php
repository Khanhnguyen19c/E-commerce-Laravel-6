<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Videos extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'video_name',  'video_link', 'video_desc' ,'slug_video','video_image'
  ];
  protected $primaryKey = 'video_id';
   protected $table = 'tbl_videos';
}
