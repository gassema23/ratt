<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MySqlDump extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:dump';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Runs the mysqldump utility using info from .env';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $host = env('DB_HOST');
        $port = env('DB_PORT');
        $username = env('DB_USERNAME');
        $password = '';
        $database = env('DB_DATABASE');
        $tables = 'activity_log';
        $file = public_path().'/sql/activity_logs.sql';

        //$command = 'mysqldump -h 127.0.0.1 -u root -p projectmanagement --single-transaction  > '.public_path().'/sql/activity_logs.sql';
        $command = sprintf('mysqldump.exe -h %s -P %s -u %s %s --single-transaction > %s', $host, $port, $username, $password, $database . ' ' . $tables, $file);

        exec($command);

        $filejson = public_path().'/json/activity_logs.json';

        $commandjson = sprintf('mysqldump.exe -h %s -P %s -u %s -p\'%s\' %s  --single-transaction > | sqldump-to > %s', $host, $port, $username, $password, $database . ' ' . $tables, $filejson);

        exec($commandjson);
    }
}
