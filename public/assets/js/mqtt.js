// Create a client instance
const client = new Paho.MQTT.Client('e01eebd935794e0b9876143ab709f203.s1.eu.hivemq.cloud', Number(8884), "client-" + Math.round(Math.random(100000000, 1000000000)*1000000000));

// set callback handlers
client.onConnectionLost = onConnectionLost;
client.onMessageArrived = onMessageArrived;

// connect the client
MQTT_connect();

function MQTT_connect()
{
    client.connect({
    onSuccess:onConnect,
    keepAliveInterval :1200,
    mqttVersion: 3,
    useSSL: true,
    userName : "hivemq.webclient.1720346967812",
    password : "B69A0<d8:oWcva@PFU%m"
    });
}

// called when the client connects
function onConnect() {
// Once a connection has been made, make a subscription and send a message.
console.log("onConnect");
client.subscribe("#");
}

// called when the client loses its connection
function onConnectionLost(responseObject) {
if (responseObject.errorCode !== 0) {
    console.log("onConnectionLost:"+responseObject.errorMessage);
    MQTT_connect();
}
}

// called when a message arrives
function onMessageArrived(message) {
console.log("onMessageArrived:"+message.payloadString);
}