// Create a client instance
const client = new Paho.MQTT.Client('e01eebd935794e0b9876143ab709f203.s1.eu.hivemq.cloud', Number(8884), "client-1");

// set callback handlers
client.onConnectionLost = onConnectionLost;
client.onMessageArrived = onMessageArrived;

// connect the client
client.connect({
onSuccess:onConnect,
mqttVersion: 3,
useSSL: true,
userName : "OTAsync_system",
password : "$fWGY%R3"
});

// called when the client connects
function onConnect() {
// Once a connection has been made, make a subscription and send a message.
console.log("onConnect");
client.subscribe("my/test/topic");
client.subscribe("test");
}

// called when the client loses its connection
function onConnectionLost(responseObject) {
if (responseObject.errorCode !== 0) {
    console.log("onConnectionLost:"+responseObject.errorMessage);
}
}

// called when a message arrives
function onMessageArrived(message) {
console.log("onMessageArrived:"+message.payloadString);
}