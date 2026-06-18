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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // --- UPDATE KOLOM DI SINI ---
            $table->string('full_name');           // Nama Lengkap
            $table->string('place_of_birth');      // Tempat Lahir
            $table->date('date_of_birth');         // Tanggal Lahir
            $table->string('origin_school');       // Asal SMP
            $table->text('address');               // Alamat (Pake text biar muat panjang)
            $table->integer('child_number');       // Anak ke berapa
            $table->string('nickname')->nullable(); // Opsional
            $table->string('photo')->nullable();    // Opsional
            $table->text('bio')->nullable();        // Motto/Bio
            $table->boolean('is_completed')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
