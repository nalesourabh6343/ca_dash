<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use SoftDeletes;

    protected $table = 'clients';
    protected $primaryKey = 'client_id';

    /**
     * Guard only primary key
     * Everything else is mass assignable
     */
    protected $guarded = ['client_id'];
}
