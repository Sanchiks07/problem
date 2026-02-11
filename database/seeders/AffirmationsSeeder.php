<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AffirmationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('affirmations')->insert([
            'affirmations' => json_encode([
                'I am capable of achieving my goals.',
                'When I feel like I have failed before I\'ve started, I say, "One percent is better than no percent."',
                'I am not my diagnosis. I am made of power and love, and I am sound in mind.',
                'Don\'t let doubts take up real estate in your mind. You\'ve got this.',
                'Things are always worse in your head. This too shall pass',
                'Done is better than perfect.',
                'You are doing a great job. I\'m very proud of you.',
                'We can\'t always be the best, but we always have the choice to do our best.',
                'I breathe in a sense of peace. I breathe out my worries.',
                'There is more than one right way to do things.',
                'Just focus on the next step.',
                'I can make the changes I want to make.',
                'My mind works in creative and unique ways.',
                'My hard work will pay off. I may not know when, but I am willing to keep trying.',
                'A clear plan creates a clear mind.',
                'One task at a time.',
                'I am a creative problem solver.',
                'You can do anything, but not everything.',
                'Better than it was!',
                'Don\'t let perfect get in the way of done.',
                'Baby steps are still steps',
                'The best time to do the thing was yesterday. The second best time is right now.',
                'If it\'s stupid and it works it isn\'t stupid.',
                'No problems, only solutions.',
                'Just because it\'s taking time doesn\'t mean it\'s not happening.',
                'Trust the process.',
                'The fewer steps, the more achievable.',
                'Just one foot in front of the other.',
                'Half-assed is better than not at all.',
                'You can do hard things.',
                'Start where you are, use what you have, do what you can.',
                'You\'re clean, you\'re dressed, and you\'re here. So you\'re doing a great job.',
                'Just keep swimming. Just keep swimming.',
                'I know what to do and have what it takes.',
                'Don\'t make problems for your future self.',
                'Being messy is not a moral failure. You\'re not a bad person if you have clutter.',
                'It is okay to start small.',
                'Progress counts even when it feels invisible.',
                'I don\'t need motivation to begin. I just need to begin.',
                'Momentum comes after action, not before.',
                'My brain is different, not broken.',
                'Rest is productive when my brain needs it.',
                'I can pause without quitting.',
                'Confusion is a step, not a failure.',
                'I am allowed to take shortcuts that help me.',
                'Starting messy is how I start at all.',
                'I don\'t have to finish everything today.',
                'My worth is not measured by my productivity.',
                'Focus comes and goes. I work with it, not against it.',
                'Interruptions do not erase my progress.',
                'I can return to a task after walking away.',
                'Forgetting does not mean I don\'t care.',
                'I am learning systems that support my brain.',
                'It\'s okay to need reminders. That\'s what tools are for.',
                'I am not lazy. My energy works differently.',
                'Doing one thing imperfectly still moves me forward.',
                'I don\'t need to feel ready to take the next step.',
                'My best looks different every day, and that\'s okay.',
                'Getting back on track counts as success.',
                'I can build habits slowly and still win.',
                'Struggling does not cancel my intelligence.',
                'I can ask for help without shame.',
                'Today\'s effort is enough for today.',
                'I am allowed to do things the easy way.',
                'Consistency can be gentle.',
                'My brain is noisy, but it is also brilliant.',
                'Stopping is not the same as giving up.',
                'I am allowed to try again as many times as it takes.',
                'Clarity comes after movement.',
                'I can handle this moment. I don\'t need to handle all of them.',
                'I don\'t need to fix myself to succeed.',
                'I can make progress even on low-energy days.',
                'Your brain is a raccoon with a jet engine. You\'re doing fine steering it.'
            ]),
        ]);
    }
}
