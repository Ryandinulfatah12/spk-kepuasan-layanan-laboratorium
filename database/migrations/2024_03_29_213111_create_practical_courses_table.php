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
        Schema::create('practical_courses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('lecturer_id');
            $table->unsignedBigInteger('lab_id');
            $table->dateTime('schedule');
            $table->text('description');
            $table->timestamps();

            $table->foreign('lecturer_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('lab_id')->references('id')->on('labs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('practical_courses');
    }
};
