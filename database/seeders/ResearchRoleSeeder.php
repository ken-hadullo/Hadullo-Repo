<?php

namespace Database\Seeders;

use App\Models\ResearchRole;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ResearchRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Define the research roles and their corresponding descriptions
        $research_roles = [
            'Principal Investigator (PI)' => 'The Principal Investigator (PI) is the lead researcher responsible for the overall design, conduct, and management of the research project.',
            'Co-Principal Investigator (Co-PI)' => 'A Co-Principal Investigator (Co-PI) shares the responsibilities of the PI, often with complementary expertise in a specific area of the project.',
            'Co-Investigator (Co-I)' => 'A Co-Investigator (Co-I) works closely with the PI and Co-PI to carry out specific aspects of the project, providing expertise and research support.',
            'Research Assistant (RA)' => 'A Research Assistant (RA) helps with the day-to-day tasks of the research, such as data collection, conducting experiments, and assisting in the analysis.',
            'Research Fellow' => 'A Research Fellow is an experienced researcher who contributes to the research project with specialized expertise and often supervises junior researchers.',
            'Project Manager' => 'A Project Manager ensures that the research project runs smoothly, overseeing logistics, budgets, and timelines, while coordinating the team’s efforts.'
        ];

        // Loop through the roles and create them if they don't already exist
        foreach ($research_roles as $roleTitle => $description) {
            // Generate a slug for each role
            $slug = Str::slug($roleTitle);

            // Create or find the role and assign the description
            ResearchRole::firstOrCreate([
                'title' => $roleTitle,
            ], [
                'slug' => $slug, // Ensure the slug is unique for each role
                'description' => $description, // Assign the description
            ]);
        }
    }
}
