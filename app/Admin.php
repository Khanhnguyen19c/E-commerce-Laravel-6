<?php

namespace App;
use App\Roles;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
class Admin extends Authenticatable
{
    public $timetamps= false;
    protected $fillabe=[
        'admin_email' ,'admin_password','admin_name','admin_phone'];
    protected $primaryKey ='admin_id';
    protected $table ='tbl_admin';
    public function roles(){
        return $this->BelongsToMany('App\Roles');
    }
    public function getAuthPassword(){
        return $this->admin_password;
    }
    public function hasAnyRoles($roles){
        return null !==  $this->roles()->whereIn('name',$roles)->first(); //nhieu quyen
    }
    public function hasRole($role){
        return null !==  $this->roles()->where('name',$role)->first(); //mot quyen
    }
    
}
