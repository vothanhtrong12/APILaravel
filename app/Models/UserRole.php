<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    protected $table='userrole';
    protected $fillable=['name','id','status','created_at','updated_at'];
    use HasFactory;
}
