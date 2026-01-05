<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Admin extends Authenticatable
{
    use HasFactory;

    protected $table = 'admins';   // your admin table name
    protected $guarded = [];
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'image'
    ];


}
