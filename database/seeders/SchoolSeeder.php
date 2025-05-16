<?php

namespace Database\Seeders;

use App\Models\School;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str; // Import the Str class

class SchoolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Define the schools to be created in a specific order
        $schools = [
            'Institute of Computing and Informatics',
            'School of Applied and Health Sciences',
            'School of Engineering and Technology',
            'School of Business',        
            'School of Humanities and Social Studies',
        ];

        // Loop through the schools and create them if they don't already exist
        foreach ($schools as $schoolName) {
            // Generate a slug for each school to ensure uniqueness
            $slug = Str::slug($schoolName);

            // Generate the school code using the new method
            $code = $this->getSchoolCode($schoolName);

            // Create the school and let the database handle the ID assignment
            School::firstOrCreate([
                'name' => $schoolName,
                'slug' => $slug, // Ensure the slug is unique for each school
                'code' => $code, // Use the generated code
            ]);
        }
    }

    /**
     * Get the TUM school code with three letters from the school name.
     *
     * @param string $schoolName
     * @return string
     */
    protected function getSchoolCode($schoolName)
    {
        // Split the name into words and get the first letter of each word
        $words = explode(' ', $schoolName);
        $initials = '';

        // Loop through the first three words and extract the first letter
        foreach (array_slice($words, 0, 3) as $word) {
            $initials .= strtoupper(substr($word, 0, 1)); // Take the first letter of each word
        }

        // Return the code in the format "TUM" followed by the first 3 letters
        return 'TUM' . strtoupper($initials); 
    }
}
