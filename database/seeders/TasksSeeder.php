<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TasksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tasks')->insert([
            'user_id' => '1',
            'title' => 'Seeder Task',
            'emotional_weight' => 'high',
            'due_date' => '2026-03-08'
        ]);
    }
}
