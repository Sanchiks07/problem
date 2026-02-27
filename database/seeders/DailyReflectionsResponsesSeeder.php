<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DailyReflectionsResponsesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('daily_reflection_responses')->insert([
            'user_id' => '1',
            'date' => '2026-02-22',
            'responses' => json_encode([
                'I did a lot of work on my project and made a lot of progress.',
                'I felt drained bc I had a lot of work to do and didn\'t know where to start.',
                'I was inspired by my own progress and felt motivated to keep going.'
            ])
        ]);
    }
}
