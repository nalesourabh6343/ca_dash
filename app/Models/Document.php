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

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id', 'client_id');
    }

    public function category()
    {
        return $this->belongsTo(DocumentCategory::class, 'pk_document_categorie_id', 'document_categorie_id');
    }
}
