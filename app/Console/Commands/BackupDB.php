<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class BackupDB extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:backup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Backup DB MySQL.';

    protected $suffix = '-backup.sql';
    protected $processBackup;
    protected $processDeleteBackup;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        
        $backup_db = storage_path('backups/' . date('Y-m-d') . $this->suffix);
        $delete_db = storage_path('backups/'. date('Y-m-d', strtotime('-3 days')) . $this->suffix);

        $this->processBackup = new Process(sprintf(
            '/usr/bin/mysqldump -u%s -p%s %s > %s',
            env('DB_USERNAME'),
            env('DB_PASSWORD'),
            env('DB_DATABASE'),
            $backup_db
        ));
        
        $this->processDeleteBackup = new Process(sprintf(
            '/bin/rm -Rf %s',
            $delete_db
        ));
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if (!file_exists(storage_path('backups'))) {
            mkdir(storage_path('backups'), 0777, true);
        }

        try {
            $this->processBackup->mustRun();
            $this->processDeleteBackup->mustRun();

            $this->info('The backup has been proceed successfully.');
        } catch (ProcessFailedException $exception) {
            $this->error('The backup process has been failed.' .  $exception);
        }
    }
}
