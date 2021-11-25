<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'lastName' => $this->faker->lastName(),
            'companyId' => 1,
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->phoneNumber()
        ];
    }
}
