<?php

namespace App\Commands;

use App\Models\Account;
use App\Strategies\followDrop;
use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;
use App\Brokers\Bitstamp;
use App\Brokers\Simulator;

class StartBot extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'bot:start';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $broker = new Bitstamp();
        $account = new Account();
        $account->fetchData($broker);

        $strategies = new followDrop();
        $strategies->setBroker($broker);
        $strategies->setAccount($account);
        $x = $strategies->run();
        print_r($x);
        return true;
    }

    /**
     * Define the command's schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    public function schedule(Schedule $schedule): void
    {
        // $schedule->command(static::class)->everyMinute();
    }
}
