<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    /**
     * Emailed token to allow profile completion by user
     */
    public function token()
    {
        return $this->hasOne(ClientToken::class);
    }
}
