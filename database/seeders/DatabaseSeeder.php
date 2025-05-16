<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        $this->call(class:RoleSeeder::class);
		$this->call(class:SchoolSeeder::class);
		$this->call(class:DepartmentSeeder::class);
        $this->call(class:AdminSeeder::class);
		$this->call(class:ResearchRoleSeeder::class);  				
		$this->call(class:PropoLevelSeeder::class);
              
    

    }
}
