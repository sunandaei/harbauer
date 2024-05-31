<?php
namespace App\Console\Commands;
use Illuminate\Console\Command;
use TextLocal;

class GetReceivedMessages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'textlocal:get-received-messages';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Find and store and messages received into Text Local';
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
       


        // Load our inboxes
        $inboxes = TextLocal::getBalance();
        
        $start = 0;
        $limit = 1000;
        $min_time = strtotime('-1 day');
        $max_time = time(); // now
       /* 
        // Loop through the inboxes
        foreach($inboxes->inboxes as $inbox) {
            
            // Load the messages for the current inbox (which we will call a folder)
            $folder = TextLocal::getMessages($inbox->id, $start, $limit, $min_time,$max_time);
            
            // If there are messages in the folder...
            if(sizeof($folder->messages) > 0) {
                foreach($folder->messages as $message) {
                    dump($message->message);
                }
            }
        }*/
    }
}