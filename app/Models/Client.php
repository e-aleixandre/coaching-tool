<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Defining properties to avoid "calling magic method" warnings
 *
 * @property String $email
 * @property String $first_name
 * @property String $last_name
 * @property String $phone
 * @property Object $birthdate
 * @property Boolean $isCreated
 */
class Client extends Model
{
    use HasFactory;

    protected $fillable = ['first_name', 'last_name', 'phone', 'birthdate'];

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
         * The function should check if the client is already created,
         * if not it should create a token, set its client_id (auto), store it to the db, update isCreated
         * and send an email notification to the Client.
         *
         * NOTE: We dont need to check if the token already exists. firstOrCreate will not create a second one,
         * and this can be used in case someone doesnt get the email and we need to resend it
         */
        if ($this->isCreated)
            return "Mal, error";

        $token = $this->token()->firstOrCreate();

        $this->isCreated = true;

        $this->save();

        return $token;
    }
}
