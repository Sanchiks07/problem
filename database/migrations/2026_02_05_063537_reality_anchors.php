<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reality_anchors', function (Blueprint $table) {
            $table->id();
            // question categories, each has a question to keep the user grounded, randomly gets outputted one by one based on a time interval
            $table->json('intention_questions');
            $table->json('surrounding_questions');
            $table->json('stuck_questions');
            $table->json('state_check_questions');
            $table->json('orientation_questions');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reality_anchors');
    }
};
