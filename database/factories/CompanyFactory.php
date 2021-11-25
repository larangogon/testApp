<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $img = file_get_contents($this->faker->imageUrl('640', '480'));
        $username =  $this->faker->name;
        $fileName = $username.'.jpg';

        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'logo' => $fileName,
            'website' => $this->faker->name()
        ];
    }
}
