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

    public function services()
    {
        return $this->belongsToMany(Service::class, 'client_service', 'client_id', 'service_id');
    }

    public function businesses()
    {
        return $this->hasMany(Business::class, 'client_id', 'client_id');
    }

    public function documents()
    {
        return $this->hasMany(Document::class, 'client_id', 'client_id');
    }
}
