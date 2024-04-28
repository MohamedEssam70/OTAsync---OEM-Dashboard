<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use PhpMqtt\Client\Facades\MQTT;

class MqttListener extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:mqtt-listener';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // MQTT::publish('some/topic', 'Hello World!');

        // $mqtt = MQTT::connection();
        // $mqtt->publish('some/topic', 'foo', 1);
        // $mqtt->loop(true);
    }
}
