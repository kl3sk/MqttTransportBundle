# (WIP) Kl3sk/MqttTransportBundle

### Note: This bundle is a work in progress

This bundle provide a MQTT transport for symfony messenger.

## Installation
```bash
composer require kl3sk/mqtt-transport-bundle:@dev
```

## Configuration

```dotenv
MESSENGER_MQTT_TRANSPORT_DSN=mqtt://user:password@broker:1883
MQTT_CLIENT_ID=symfonyclient
MQTT_TOPICS='/topic1,/topic2'
```
## Examples
See in the `Mqtt` folder


Thanks to [Namoshek](https://github.com/Namoshek) for his client and his help.