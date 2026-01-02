<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Business extends Model
{
    use SoftDeletes;

    protected $table = 'businesses';
    protected $primaryKey = 'business_id';

    protected $guarded = ['business_id'];
}
