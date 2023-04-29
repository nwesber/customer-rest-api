<?php

namespace Database\Factories;

use App\Models\Customers;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Model>
 */
class CustomersFactory extends Factory
{

    protected $model = Customers::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'email' => $this->faker->email(),
            'password' => md5($this->faker->password()),
            'country' => 'Australia',
            'username' => $this->faker->userName(),
            'gender' => 'male',
            'city' => $this->faker->city(),
            'phone' => $this->faker->phoneNumber()
        ];
    }
}
