<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Staff extends Model
{
    use SoftDeletes;

    protected $table = 'staff';
    protected $primaryKey = 'staff_id';

    protected $fillable = [
        'name',
        'image',
        'email',
        'phone',
        'address',
        'pincode',
    ];
}
