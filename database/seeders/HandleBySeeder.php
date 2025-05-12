<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HandleBySeeder extends Seeder
{
    public function run(): void
    {
        $users = [];

        for ($i = 1; $i <= 10; $i++) {
            $users[] = [
                'id' => $i,
                'name' => 'User ' . $i,
            ];
        }

        DB::table('handle_by')->insert($users);
    }
}
