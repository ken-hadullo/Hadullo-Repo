<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds and create a Super Admin.
     *
     * @return void
     */
    public function run()
    {
        // Ensure the role exists
        $role = Role::firstOrCreate(['name' => 'Super Admin']);

        // Ensure the user doesn't already exist
        $user = User::firstOrCreate(
            ['email' => env('SUPER_ADMIN_EMAIL', 'khadullo@gmail.com')],
            [
                'name' => 'Kennedy Hadullo',
                'role_id' => 1,
                'verified' => 1,
                'email_verified_at' => now(),
                'password' => bcrypt(env('SUPER_ADMIN_PASSWORD', 'KenHad@2025')),
            ]
        );

        // Assign the role to the user
        $user->assignRole($role);
    }
}
