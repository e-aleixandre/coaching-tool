<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    /**
     * Add attributes automatically when retrieving the model
     */
    protected $appends = [ 'edited_at' ];

    /**
     * Belongs to a Client
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * Human-readable edited at date
     */
    public function getEditedAtAttribute()
    {
        return $this->updated_at->diffForHumans();
    }
}
