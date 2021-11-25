<?php

namespace Database\Seeders;

use Database\Factories\CompanyFactory;
use Database\Factories\EmployeeFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        CompanyFactory::factory(15)->create();
        EmployeeFactory::factory(20)->create();

        $this->call(
            [
                PermissionSeeder::class,
                UserSeeder::class,
            ]
        );
    }
}
