<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BranchesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define the branches to insert
        $branches = [
            ['branch' => 'Colombo', 'user_id' => 1],
            ['branch' => 'Batticaloa', 'user_id' => 2],
            ['branch' => 'Kilinochchi', 'user_id' => 3],
            ['branch' => 'Mannar', 'user_id' => 4],
        ];

        // Insert the branches into the database
        DB::table('branches')->insert($branches);
    }
}
