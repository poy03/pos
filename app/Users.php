<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    protected $table = 'tbl_users';
    public $timestamps = false;
    protected $hidden = ['password'];
}
