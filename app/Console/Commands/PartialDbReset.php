<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class PartialDbReset extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:reset-partial';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset database tables except users and students';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting partial database reset...');

        $tablesToTruncate = [
            'announcements',
            'general_settings',
            'class_structures',
            'subjects',
            'grades',
        ];

        Schema::disableForeignKeyConstraints();

        foreach ($tablesToTruncate as $table) {
            if (Schema::hasTable($table)) {
                DB::table($table)->truncate();
                $this->info("Truncated table: {$table}");
            }
        }

        Schema::enableForeignKeyConstraints();

        $this->info('Partial database reset completed successfully!');
    }
}
