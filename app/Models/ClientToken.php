<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ClientToken extends Model
{
    use HasFactory;

    protected static function booted()
    {
        static::creating(function ($token) {
           $token->token = Str::random(64);
        });
    }
    /**
     * Client that owns this token
     */
    public function user()
    {
        return $this->belongsTo(Client::class);
    }
}
