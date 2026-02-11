<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RealityAnchorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('reality_anchors')->insert([
            'intention_questions' => json_encode([
                'What is one small thing I want today to feel like?',
                'What would make today feel slightly easier?',
                'What is my top priority, even if nothing else gets done?',
                'What kind of energy do I want to bring into today?',
                'What is one thing I can give myself permission to not do?',
                'How do I want to treat myself today?',
                'What would “good enough” look like today?',
                'What am I hoping today gives me?',
                'What do I want to protect my energy from today?',
                'What matters most right now, not in theory?',
                'What is one thing Future Me would appreciate?',
                'What is one intention I can carry gently?',
                'What do I want to focus on instead of worrying?',
                'What would success look like in the smallest form?',
                'What pace do I want to move at today?',
                'What do I want to remember when things feel overwhelming?',
                'What feeling do I want more of today?',
                'What am I choosing to show up for today?',
                'What does “enough” mean for today?',
                'What am I allowed to let go of today?',
            ]),

            'surrounding_questions' => json_encode([
                'What is happening around me right now?',
                'What do I see in my environment?',
                'What sounds can I hear right now?',
                'What objects are near me that feel familiar?',
                'Where am I sitting or standing?',
                'What time of day is it right now?',
                'What is the temperature like around me?',
                'What smells or textures do I notice?',
                'What room or place am I in?',
                'What feels stable or solid around me?',
                'What is one thing I can touch right now?',
                'What colors do I notice around me?',
                'What feels calm or neutral in my surroundings?',
                'What is one safe thing in this space?',
                'What is something ordinary happening around me?',
                'What does the light look like right now?',
                'What objects remind me that I am here?',
                'What is one detail I hadn\'t noticed before?',
                'What feels predictable in this environment?',
                'What helps me feel grounded in this space?',
            ]),

            'stuck_questions' => json_encode([
                'What exactly feels hard right now?',
                'What am I avoiding, and why?',
                'What feels unclear or overwhelming?',
                'What part of this feels too big?',
                'What am I afraid will happen if I start?',
                'What is the smallest possible step forward?',
                'What would make this feel less heavy?',
                'What am I telling myself about this situation?',
                'What is actually required versus what I think is required?',
                'What is one thing I could do for five minutes?',
                'What am I stuck on: starting, continuing, or finishing?',
                'What support or tool could help here?',
                'What part of this can I simplify?',
                'What would I do if this didn\'t have to be perfect?',
                'What is one assumption I might be making?',
                'What is draining my energy the most?',
                'What feels noisy or cluttered in my mind?',
                'What would help me re-enter this task?',
                'What is one thing I can do instead of nothing?',
                'What would “progress” look like right now?',
            ]),

            'state_check_questions' => json_encode([
                'How does my body feel right now?',
                'What emotion is most present right now?',
                'Am I tired, hungry, overstimulated, or under-stimulated?',
                'What is my energy level right now?',
                'Do I need rest or movement?',
                'How fast are my thoughts right now?',
                'Do I feel tense or relaxed?',
                'What does my breathing feel like?',
                'What emotion am I avoiding?',
                'What emotion am I sitting with?',
                'How does my head feel right now?',
                'Am I feeling pressure or urgency?',
                'What does my nervous system need?',
                'Do I feel scattered or focused?',
                'What physical sensations do I notice?',
                'Am I feeling safe right now?',
                'What is my stress level from 1 to 10?',
                'Do I need a break or structure?',
                'What feeling needs attention right now?',
                'What would help regulate me right now?',
            ]),

            'orientation_questions' => json_encode([
                'What day is it today?',
                'What time is it right now?',
                'What have I already done today?',
                'What is coming next today?',
                'Where am I in my day right now?',
                'What task or moment am I in?',
                'What has already passed today?',
                'What is one thing that is done already?',
                'What am I currently working on?',
                'What comes immediately after this?',
                'What does the rest of today roughly look like?',
                'What is one anchor point in today?',
                'What am I transitioning from right now?',
                'What am I transitioning into?',
                'What part of the day is this?',
                'What is the current focus?',
                'What is one thing I don\'t need to think about yet?',
                'What can wait until later?',
                'What is today asking of me right now?',
                'What moment am I in, exactly?',
            ]),
        ]);
    }
}
