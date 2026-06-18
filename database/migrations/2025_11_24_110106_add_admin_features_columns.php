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
        Schema::table('general_settings', function (Blueprint $table) {
            $table->text('teacher_quote')->nullable()->after('teacher_image');
        });

        Schema::table('students', function (Blueprint $table) {
            $table->string('position')->nullable()->after('bio');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('general_settings', function (Blueprint $table) {
            $table->dropColumn('teacher_quote');
        });

        Schema::table('students', function (Blueprint $table) {
            $table->dropColumn('position');
        });
    }
};
