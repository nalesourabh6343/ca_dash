<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DocumentCategory extends Model
{
    use SoftDeletes;

    protected $table = 'document_categories';
    protected $primaryKey = 'document_categorie_id';

    /**
     * Guard only primary key
     * Everything else is mass assignable
     */
    protected $guarded = ['document_categorie_id'];
}
