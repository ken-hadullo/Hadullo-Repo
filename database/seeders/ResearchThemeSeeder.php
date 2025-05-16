<?php

namespace Database\Seeders;

use App\Models\ResearchTheme;
use App\Models\Department;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ResearchThemeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::beginTransaction(); // Start a transaction to ensure data consistency

        try {
            // Define research themes with descriptions and department names
            $researchThemes = [
                ['name' => 'Health and Medicine', 'department' => 'Health Sciences', 'description' => 'Includes research in public health, biomedical sciences, mental health, and global health.'],
                ['name' => 'Environmental Sustainability', 'department' => 'Environmental Studies', 'description' => 'Focuses on climate change, renewable energy, conservation, and environmental policies.'],
                ['name' => 'Technology and Innovation', 'department' => 'Computer Science', 'description' => 'Covers AI, robotics, cybersecurity, IoT, and blockchain research.'],
                ['name' => 'Education and Learning', 'department' => 'Education', 'description' => 'Focuses on teaching methods, educational technologies, and inclusive education.'],
                ['name' => 'Social Sciences and Humanities', 'department' => 'Humanities', 'description' => 'Covers sociology, psychology, anthropology, and political science.'],
                ['name' => 'Engineering and Infrastructure', 'department' => 'Engineering', 'description' => 'Includes civil, architectural, environmental, electrical, and aerospace engineering.'],
                ['name' => 'Business and Economics', 'department' => 'Business Administration', 'description' => 'Includes entrepreneurship, finance, marketing, and supply chain management.'],
                ['name' => 'Law and Governance', 'department' => 'Law', 'description' => 'Covers international law, criminal justice, and environmental law.'],
                ['name' => 'Agriculture and Food Security', 'department' => 'Agriculture', 'description' => 'Includes sustainable agriculture, food technology, and global food security.'],
                ['name' => 'Artificial Intelligence and Data Science', 'department' => 'Computer Science', 'description' => 'Includes machine learning, big data, and AI ethics research.'],
                ['name' => 'Humanities and Cultural Studies', 'department' => 'Humanities', 'description' => 'Covers literature, history, philosophy, and media studies.'],
                ['name' => 'Urban Studies and Public Policy', 'department' => 'Urban Studies', 'description' => 'Focuses on urban planning, transportation, and public policy.'],
            ];

            foreach ($researchThemes as $theme) {
                // Find or create the department
                $department = Department::firstOrCreate(
                    ['name' => $theme['department']],
                    ['slug' => Str::slug($theme['department'])]
                );

                // Create the research theme
                ResearchTheme::firstOrCreate(
                    ['name' => $theme['name']],
                    [
                        'description' => $theme['description'],
                        'department_id' => $department->id,
                        'slug' => Str::slug($theme['name']),
                    ]
                );
            }

            DB::commit(); // Commit the transaction
            Log::info('Research themes seeded successfully.');

        } catch (\Exception $e) {
            DB::rollBack(); // Rollback transaction on error
            Log::error('Error seeding research themes: ' . $e->getMessage());
        }
    }
}

