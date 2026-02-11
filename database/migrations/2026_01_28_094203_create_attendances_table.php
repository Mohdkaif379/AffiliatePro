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
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // users table se link
            $table->timestamp('mark_in_time')->nullable();
            $table->timestamp('mark_out_time')->nullable();
            $table->date('today_date');
            $table->enum('status', ['Absent', 'Present', 'Halfday', 'Holiday', 'Leave'])
                  ->default('Absent');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
