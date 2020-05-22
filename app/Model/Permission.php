<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    // relate to table
    public $table = 'permission';
    // primary key
    public $primaryKey = 'id';
    // fileds that can be operated
    public $guarded = [];
    // do not need to add created_at and updated_at
    public $timestamps = false;
}
