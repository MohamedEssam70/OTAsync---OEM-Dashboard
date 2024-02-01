@extends('layouts/contentNavbarLayout',['navbarBreadcrumbPrev' => 'Setup & Configurations /', 'navbarBreadcrumbActive' => 'MQTT Configuration'])
@section('title', 'MQTT configuration')

@section('content')
@include('content.dashboard.setup.tabs', ['activeTab' => 1])
<div class="row">
  @include('content/dashboard/sub-under-maintenance')
</div>
@endsection

@section('page-script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/paho-mqtt/1.0.1/mqttws31.js" type="text/javascript"></script>
<script src="{{ asset('assets/vendor/js/require.js') }}"></script>
<script>
  require(['mqtt'], function (mqtt) {
    const clientId = 'mqttjs_' + Math.random().toString(16).substr(2, 8);

    const host = 'wss://86ddd73f989d43ef88fec03b2f6ee6eb.s2.eu.hivemq.cloud:8084/mqtt';

    const options = {
      keepalive: 60,
      clientId: clientId,
      username: 'OTAsync_system',
      password: '$fWGY%R3',
      protocolId: 'MQTT',
      protocolVersion: 4,
      clean: true,
      reconnectPeriod: 1000,
      connectTimeout: 30 * 1000,
      will: {
        topic: 'WillMsg',
        payload: 'Connection Closed abnormally..!',
        qos: 1,
        retain: false
      },
    };

    const client = mqtt.connect(host, options);

    client.on('connect', () => {
      console.log(`Client connected: ${clientId}`)
      // Subscribe
      client.subscribe('test', { qos: 1 })
    })
    // Publish
    client.publish('test', 'ws connection demo...!', { qos: 0, retain: false })
    // Receive
    client.on('message', (topic, message, packet) => {
      console.log(`Received Message: ${message.toString()} On topic: ${topic}`)
    })

    client.on("connect", () => {
      client.subscribe("test", (err) => {
        if (!err) {
          client.publish("test", "Hello mqtt");
        }
      });
    });

    // client.on("message", (topic, message) => {
    //   // message is Buffer
    //   console.log(message.toString());
    //   client.end();
    // });
    // client.on('error', (err) => {
    //   console.log('Connection error: ', err)
    //   client.end()
    // })
    // client.on('reconnect', () => {
    //   console.log('Reconnecting...')
    // })
    
    // var client = mqtt.connect('86ddd73f989d43ef88fec03b2f6ee6eb.s2.eu.hivemq.cloud',{
    //   protocolId: 'MQIsdp',
    //   protocolVersion: 3,
    //   username: 'OTAsync_system',
    //   password: '$fWGY%R3'
    // });
    // client.subscribe('test');
    // client.publish('test', 'Current time is: ' + new Date());
    // client.on('message', function(topic, message) {
    //   console.log(message);
    // });
    // client.on('connect', function(){
    //   console.log('Connected');
    // });
  });
  

  // // Create a client instance
  // client = new Paho.MQTT.Client('86ddd73f989d43ef88fec03b2f6ee6eb.s2.eu.hivemq.cloud', Number(8884), "client-1");

  // // set callback handlers
  // client.onConnectionLost = onConnectionLost;
  // client.onMessageArrived = onMessageArrived;

  // // connect the client
  // client.connect({
  //   onSuccess:onConnect,
  //   mqttVersion: 3,
  //   useSSL: true,
  //   userName : "OTAsync_system",
	//   password : "$fWGY%R3"

  // });

  // // called when the client connects
  // function onConnect() {
  //   // Once a connection has been made, make a subscription and send a message.
  //   console.log("onConnect");
  //   client.subscribe("test");
  //   message = new Paho.MQTT.Message("message");
  //   message.qos = 1;
  //   message.destinationName = "test";
  //   client.send(message); 
  // }

  // // called when the client loses its connection
  // function onConnectionLost(responseObject) {
  //   if (responseObject.errorCode !== 0) {
  //     console.log("onConnectionLost:"+responseObject.errorMessage);
  //   }
  // }

  // // called when a message arrives
  // function onMessageArrived(message) {
  //   console.log("onMessageArrived:"+message.payloadString);
  // }
</script>
@endsection