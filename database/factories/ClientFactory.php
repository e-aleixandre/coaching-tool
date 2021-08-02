<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Client::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // Decides whether the client is created or pending
        $isCreated = $this->faker->boolean();

        // Email is mandatory even for pending clients
        $user = [
            'email' => $this->faker->unique()->safeEmail()
        ];

        // If it is created we fill the remaining fields
        if ($isCreated)
            $user = array_merge($user, [
                'name' => $this->faker->name(),
                'lastname' => $this->faker->lastName(),
                'phone' => $this->faker->optional()->phoneNumber(),
                'birthdate' => $this->faker->date(),
                'isCreated' => true
            ]);

        return $user;
    }
}
