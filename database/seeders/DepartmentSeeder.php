<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str; // Import the Str class for generating slugs

class DepartmentSeeder extends Seeder
{
    public function run()
    {
        // Define the departments and their corresponding school names
        $departments = [
            // Institute of Computing and Informatics (Group 1)
            'Computer Science & IT' => 'Institute of Computing and Informatics',
            
            // Applied and Health Sciences (Group 2)
            'Mathematics and Physics' => 'School of Applied and Health Sciences',
            'Pure and Applied Science' => 'School of Applied and Health Sciences',
            'Environmental and Health Sciences' => 'School of Applied and Health Sciences',
            'Medical Sciences' => 'School of Applied and Health Sciences',

            // Engineering (Group 3)
            'Architecture and Built Environment' => 'School of Engineering and Technology',
            'Building and Civil Engineering' => 'School of Engineering and Technology',
            'Electrical and Electronic Engineering' => 'School of Engineering and Technology',
            'Mechanical and Automotive Engineering' => 'School of Engineering and Technology',
            'Medical Engineering' => 'School of Engineering and Technology',

            // School of Business (Group 4)
            'Accounting and Finance' => 'School of Business',
            'Business Administration' => 'School of Business',
            'Management Science' => 'School of Business',

            // Social Sciences and Humanities (Group 5)
            'Communication Studies' => 'School of Humanities and Social Studies',
            'Social Sciences' => 'School of Humanities and Social Studies',
            'Hospitality and Tourism Management' => 'School of Humanities and Social Studies',
        ];

        // Limit to the first 17 departments
        $departments = array_slice($departments, 0, 17);

        // Insert the departments into the database
        foreach ($departments as $department => $school_name) {
            // Find the school_id based on the school_name
            $school_id = DB::table('schools')
                ->where('name', $school_name)
                ->value('id');

            // If the school exists, insert the department with the corresponding school_id
            if ($school_id) {
                // Generate a slug for the department
                $slug = Str::slug($department);

                DB::table('departments')->insert([
                    'name' => $department,
                    'slug' => $slug, // Add the slug field here
                    'school_id' => $school_id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            } else {
                // Handle cases where the school doesn't exist (optional)
                \Log::warning("School not found: " . $school_name);
            }
        }
    }
}