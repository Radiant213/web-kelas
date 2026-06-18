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
        Schema::create('class_structures', function (Blueprint $table) {
            $table->id();
            $table->string('student_username');
            $table->string('role'); // Ketua, Wakil, dll
            $table->integer('order')->default(0); // Untuk urutan tampilan
            $table->timestamps();

            $table->foreign('student_username')->references('username')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('class_structures');
    }
};
