<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    // relate to table
    public $table = 'user';
    // primary key
    public $primaryKey = 'user_id';
    // fileds that can be operated
    // public $fillable = ['user_name','user_pass','email','phone'];
    public $guarded = [];
    // do not need to add created_at and updated_at
    public $timestamps = false;
}
