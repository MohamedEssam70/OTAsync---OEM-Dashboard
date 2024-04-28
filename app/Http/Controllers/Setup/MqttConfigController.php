<?php

namespace App\Http\Controllers\Setup; 
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use PhpMqtt\Client\ConnectionSettings;
use PhpMqtt\Client\MqttClient;
use PhpMqtt\Client\Facades\MQTT;


class MqttConfigController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $server = 'test.mosquitto.org';
        // $port = '1883';
        // $clientId = 'xxx';
        // $username = 'xxx';
        // $password = 'xxx';
        // $clean_session = true;
        // $topic = 'aaa';
        // $message = 'MQTT!!';
        // $mqtt = new MqttClient($server, $port, $clientId);
        // $mqtt->connect();
        // $mqtt->publish($topic, "Received message on topic [". $topic . "]: " . $message, 0);
        // $mqtt->loop();
        // $mqtt->disconnect();
        return view("content.dashboard.setup.mqtt-config");
    }

    public function publish()
    {
        $server   = 'test.mosquitto.org';
        $port     = 1883;
        $clientId = 'test-publisher';

        $mqtt = new MqttClient($server, $port, $clientId);
        $mqtt->connect();
        $mqtt->publish('php-mqtt/client/test', 'Hello World!', 0);
        $mqtt->disconnect();
    }
    public function subscribe($topic, $message)
    {
        $server   = 'test.mosquitto.org';
        $port     = 1883;
        $clientId = 'test-subscriber';

        $mqtt = new MqttClient($server, $port, $clientId);
        $mqtt->connect();
        $mqtt->subscribe('php-mqtt/client/test', function ($topic, $message, $retained, $matchedWildcards) {
            echo sprintf("Received message on topic [%s]: %s\n", $topic, $message);
        }, 0);
        $mqtt->loop(true);
        $mqtt->disconnect();
    }
}
