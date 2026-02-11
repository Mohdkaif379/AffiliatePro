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
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->string('offer_title');
            $table->text('description')->nullable();
            $table->string('offer_category')->nullable();
            $table->string('offer_url')->nullable();
            $table->unsignedBigInteger('advertiser_name')->nullable();
            $table->decimal('advertiser_price', 10, 2)->nullable();
            $table->decimal('affiliate_price', 10, 2)->nullable();
            $table->date('schedule')->nullable();
            $table->string('device_brand')->nullable();
            $table->string('os_version')->nullable();
            $table->string('operating_system')->nullable(); // Android / iOS / Windows
            $table->string('device')->nullable(); // Mobile / Desktop / Tablet
            $table->string('country')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->string('user_language')->nullable();
            $table->string('browser')->nullable();
            $table->string('upload_file')->nullable();
            $table->longText('terms_conditions')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
             $table->foreign('advertiser_name')
                  ->references('id')
                  ->on('users')
                  ->cascadeOnDelete(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offers');
    }
};
