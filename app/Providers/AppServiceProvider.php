<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Carbon\Carbon;
use App\Models\DailyReflection;
use App\Models\DailyReflectionResponse;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('components.layout', function ($view) {
            $today = Carbon::today()->toDateString();

            $reflection = DailyReflection::first();
            $questions = $reflection ? $reflection->questions : [];

            $responseRow = DailyReflectionResponse::where('user_id', auth()->id() ?? 0)->where('date', $today)->first();

            $responses = $responseRow ? $responseRow->responses : [];

            $view->with([
                'dailyQuestions' => $questions,
                'dailyResponses' => $responses
            ]);
        });
    }
}
