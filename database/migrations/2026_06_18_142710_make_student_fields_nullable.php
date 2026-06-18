<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->string('place_of_birth')->nullable()->change();
            $table->date('date_of_birth')->nullable()->change();
            $table->string('origin_school')->nullable()->change();
            $table->text('address')->nullable()->change();
            $table->string('city')->nullable()->change();
            $table->integer('child_number')->nullable()->change();
            $table->string('nickname')->nullable()->change();
            $table->string('gender')->nullable()->change();
            $table->string('photo')->nullable()->change();
            $table->text('bio')->nullable()->change();
            $table->string('position')->nullable()->change();
            $table->string('github_url')->nullable()->change();
            $table->string('instagram_url')->nullable()->change();
            $table->string('tiktok_url')->nullable()->change();
            $table->text('programming_languages')->nullable()->change();
        });

        // Clear existing data
        DB::table('students')->update([
            'place_of_birth' => null,
            'date_of_birth' => null,
            'origin_school' => null,
            'address' => null,
            'city' => null,
            'child_number' => null,
            'nickname' => null,
            'gender' => null,
            'photo' => null,
            'bio' => null,
            'position' => null,
            'github_url' => null,
            'instagram_url' => null,
            'tiktok_url' => null,
            'programming_languages' => null,
            'is_completed' => false,
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Cannot revert cleanly without original data, doing nothing here
    }
};
