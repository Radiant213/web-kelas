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
        Schema::table('students', function (Blueprint $table) {
            $table->string('username')->nullable()->after('user_id');
        });

        // Populate username from users table
        $students = DB::table('students')->get();
        foreach ($students as $student) {
            $user = DB::table('users')->where('id', $student->user_id)->first();
            if ($user) {
                DB::table('students')
                    ->where('id', $student->id)
                    ->update(['username' => $user->username]);
            }
        }

        Schema::table('students', function (Blueprint $table) {
            $table->string('username')->nullable(false)->change();
            $table->foreign('username')->references('username')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropForeign(['username']);
            $table->dropColumn('username');
        });
    }
};
