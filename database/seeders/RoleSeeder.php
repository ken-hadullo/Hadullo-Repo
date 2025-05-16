<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Define the roles to be created
        $roles = [
            'Super Admin',  
            'Applicant',            
            'Reviewer',
            'Committee',           
            
        ];

        // Loop through the roles and create them if they don't already exist
        foreach ($roles as $roleName) {
            Role::firstOrCreate(['name' => $roleName]);
        }
    }
}

