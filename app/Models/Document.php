<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Document extends Model
{
    use SoftDeletes;

    protected $table = 'documents';
    protected $primaryKey = 'document_id';

    /**
     * Guard only primary key
     * Everything else is mass assignable
     */
    protected $guarded = ['document_id'];
}
