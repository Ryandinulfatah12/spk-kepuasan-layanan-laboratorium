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
        Schema::create('facility_feedback', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('feedback_id');
            $table->unsignedBigInteger('facility_id');
            $table->integer('rating')->nullable();
            $table->timestamps();

            $table->foreign('feedback_id')->references('id')->on('feedback')->onDelete('cascade');
            $table->foreign('facility_id')->references('id')->on('facilities')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('facility_feedback');
    }
};
