<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientToken extends Model
{
    use HasFactory;

    protected $attributes = [
        'token' => 'test'
    ];

    /**
     * Client that owns this token
     */
    public function user()
    {
        return $this->belongsTo(Client::class);
    }
}
