<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user =  new User();

        $user->name = 'Administrador';
        $user->email = 'admin@test.com';
        $user->email_verified_at = now();
        $user->password = bcrypt('password');

        $user->save();

        $user = User::find(1);
        $user->assignRole('Administrator');
    }
}
