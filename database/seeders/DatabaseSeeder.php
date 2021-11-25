<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Employee;
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
        Company::factory(15)->create();
        Employee::factory(20)->create();

        $this->call(
            [
                PermissionSeeder::class,
                UserSeeder::class,
            ]
        );
    }
}
