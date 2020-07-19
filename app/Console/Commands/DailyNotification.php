<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DateTime;
use SunAsterisk\Chatwork\Chatwork;
use SunAsterisk\Chatwork\Helpers\Message;

class DailyNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:notification';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send a daily message to chatwork';

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
     * @return int
     */
    public function handle()
    {
        $now = new DateTime();
        $chatwork = Chatwork::withAPIToken(config('services.chatwork.key'));
        
        $mg = '[toall] Giờ cơm đã đến. Hôm nay ăn gì đây ta ???(eat)(coffee)';
        $message = Chatwork::message($mg);
        $chatwork->room(config('services.chatwork.room_id'))->messages()->create((string) $message);
        
    }
}
