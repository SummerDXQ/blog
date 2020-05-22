<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    // relate to table
    public $table = 'role';
    // primary key
    public $primaryKey = 'id';
    // fileds that can be operated
    public $guarded = [];
    // do not need to add created_at and updated_at
    public $timestamps = false;
    // get a dynamic attr to relate permission model
    public function permission(){
        return $this->belongsToMany('App\Model\Permission','role_permission','role_id','permission_id');
    }
}
