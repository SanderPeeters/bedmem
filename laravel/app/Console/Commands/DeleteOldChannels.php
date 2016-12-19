<?php

namespace App\Console\Commands;

use App\Pusherchannel;
use Illuminate\Console\Command;

class DeleteOldChannels extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'deleteoldchannels';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Everyday delete all the old unused channels';

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
        $now = new \DateTime('now');
        $channels = Pusherchannel::all();
        foreach ($channels as $channel){
            $date = new \DateTime($channel->created_at);
            $date->add(new \DateInterval('PT1H'));
            if ($date < new \DateTime('now')){
                $channel->delete();
            }
        }
    }
}
