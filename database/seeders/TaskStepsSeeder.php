<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaskStepsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('task_steps')->insert([
            'task_id' => '1',
            'steps' => json_encode([
                'make the wepage',
                'fix bugs',
                'make the code pretty',
                'make sure everything is like it is supposed to be',
                'turn in your work'
            ])
        ]);
    }
}
