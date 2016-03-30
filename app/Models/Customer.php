<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Customer extends Authenticatable
{
    protected $table = "customers";
    protected $fillable = ['first-name', 'last-name', 'name', 'email', 'password'];
    protected $hidden = ['password', 'remember_token'];
}
