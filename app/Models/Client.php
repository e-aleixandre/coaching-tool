<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

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

    public function generateClientToken()
    {
        /**
         * FUNCTIONALITY
         * The function should check if the client is already created or already has a token, if not it should
         * create a token, set its client_id, store it to the db, update isCreated and send an email notification to the Client
         */
        if ($this->isCreated || $this->token()->first())
            return "Mal, error";

        $token = $this->token()->firstOrCreate();

        $this->isCreated = true;

        $this->save();

        return $token;
    }
}
