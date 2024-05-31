<?php
namespace App\Console\Commands;
use Illuminate\Console\Command;

class SendEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:sendEmailNow';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'sendEmailNow description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //

        $start = 0;
        $limit = 1000;
        $min_time = strtotime('-1 day');
        $max_time = time(); // now
        echo 'mrphpgir';
        dump($max_time);
    }
}
