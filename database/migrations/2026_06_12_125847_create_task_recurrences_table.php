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
        Schema::create('task_recurrences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('task_id')->unique()->constrained()->cascadeOnDelete();
            $table->string('frequency');             // 'daily', 'weekly', 'monthly', 'yearly'
            $table->unsignedInteger('interval')->default(1); // every N frequencies
            $table->json('days_of_week')->nullable(); // [1,3,5] = Mon/Wed/Fri (weekly only)
            $table->date('starts_at');
            $table->date('ends_at')->nullable();      // null = recurs forever
            $table->dateTime('last_generated_at')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('task_recurrences');
    }
};
