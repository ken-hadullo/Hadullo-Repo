<?php

namespace Database\Seeders;

use App\Models\PropoLevel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PropolevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Define levels with their respective costs
        $proposal_levels = [
            ['name' => 'PHD', 'cost' => 5000, 'renewal_cost' => 2000, 'amendment_cost' => 2000, 'mta_cost' => 1000],
            ['name' => 'MASTERS', 'cost' => 3000, 'renewal_cost' => 1000, 'amendment_cost' => 1000, 'mta_cost' => 1000],
            ['name' => 'UNDER GRADUATE', 'cost' => 1000, 'renewal_cost' => NIL, 'amendment_cost' => NIL, 'mta_cost' => 800],
            ['name' => 'DIPLOMA', 'cost' => 2000, 'renewal_cost' => 1500, 'amendment_cost' => 800, 'mta_cost' => 600],
            ['name' => 'NON ACADEMIC', 'cost' => 1000, 'renewal_cost' => 800, 'amendment_cost' => 500, 'mta_cost' => 300],
        ];

        // Insert each level into the database
        foreach ($proposal_levels as $proposal_level) {
            PropoLevel::create([
                'name' => $proposal_level['name'],
                'cost' => $proposal_level['cost'],
                'renewal_cost' => $proposal_level['renewal_cost'],
                'amendment_cost' => $proposal_level['amendment_cost'],
                'mta_cost' => $proposal_level['mta_cost'],
            ]);
        }
    }
}
