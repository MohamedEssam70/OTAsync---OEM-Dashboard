import mqtt from 'mqtt';

var options = {
    host: 'e01eebd935794e0b9876143ab709f203.s1.eu.hivemq.cloud',
    port: 8884,
    protocol: 'mqtts',
    qos: 2,
    protocolVersion: 5,
    reconnectPeriod: 5000,
    username: 'OTAsync_system',
    password: '$fWGY%R3'
}

// initialize the MQTT client
const client = mqtt.connect(options);

// setup the callbacks
client.on('connect', function () {
    console.log('Connected');
});

client.on('error', function (error) {
    console.log(error);
});

client.on('message', function (topic, message) {
    // called each time a message is received
    console.log('Received message:', topic, message.toString());
});

// subscribe to topic 
client.subscribe({'test': {qos: 2, nl: true, properties: { userProperties: { 'Source-Sensor-ID': '2dfxby20v2.1hz;vg' } }}}, (err) => {
    if (err) {
      console.error('Failed to subscribe:', err);
    } else {
      console.log('Topic subscribe with user properties');
    }
});

// publish message 'Hello' to topic 
client.publish('test', 'Hello from Node', {qos: 2, properties: {messageExpiryInterval: 30}}, (err) => {
  if (err) {
    console.error('Failed to publish message:', err);
  } else {
    console.log('Message published with user properties');
  }
});

client.on('offline', () => {
console.log('Client is offline');
});

client.on('reconnect', () => {
console.log('Reconnecting...');
});

client.on('end', () => { 
console.log('Connection to MQTT broker ended');
});

