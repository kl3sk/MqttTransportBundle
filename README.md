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

Create your Message and Message handler [Symfony documentation](https://symfony.com/doc/current/messenger.html)

_services.yaml_
```yaml
services:
    framework:
        messenger:
            # ... your definitions
            transports:
                mqtt:
                    dsn: '%env(MESSENGER_MQTT_TRANSPORT_DSN)%'
                    serializer: Kl3sk\MqttTransportBundle\Serializer\JsonMessageSerializer
            routing:
                # Route your messages to the transports
                'Kl3sk\MqttTransportBundle\Message\ExampleMessage': mqtt
```

## Examples
See in the `Mqtt` folder


Thanks to [Namoshek](https://github.com/Namoshek) for his client and his help.