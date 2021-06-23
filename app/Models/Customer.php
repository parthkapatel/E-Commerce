<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;

class Customer extends Model
{
    use HasFactory,SoftDeletes,HasApiTokens,Authenticatable;

    protected $fillable = [
        'first_name',
        'last_name',
        'phone',
        'email',
        'user_name',
        'password',
    ];
    protected $primaryKey ='customer_id';
}
