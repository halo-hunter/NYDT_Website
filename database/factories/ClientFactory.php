<?php

namespace Database\Factories;

use App\Models\Crm\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Client>
 */
class ClientFactory extends Factory
{
    protected $model = Client::class;

    public function definition(): array
    {
        return [
            'firstname' => $this->faker->firstName(),
            'lastname' => $this->faker->lastName(),
            'a_number' => $this->faker->randomNumber(7),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => preg_replace('/[^0-9]/', '', $this->faker->phoneNumber()),
            'social_security' => $this->faker->optional()->numerify('#########'),
            'address_country' => strtoupper($this->faker->countryCode()),
            'address_state_code' => strtoupper($this->faker->stateAbbr()),
            'address_city' => $this->faker->city(),
            'address_zip_code' => $this->faker->postcode(),
            'address_unit' => $this->faker->optional()->bothify('Unit ##'),
            'address_address' => $this->faker->streetAddress(),
            'profile_photo' => null,
            'password' => null,
            'password_status' => 'pending',
        ];
    }
}
