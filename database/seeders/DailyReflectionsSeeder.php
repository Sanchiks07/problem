<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DailyReflectionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('daily_reflections')->insert([
            'questions' => json_encode([
                'What mattered most to you today?',
                'What drained you today?',
                'What inspired you today?'
            ]),
        ]);
    }
}
