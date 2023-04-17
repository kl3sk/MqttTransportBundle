<?php

// src/AcmeTestBundle.php
namespace Kl3sk\MqttTransportBundle;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Bundle\AbstractBundle;

class MqttTransportBundle extends AbstractBundle {
    public function getPath(): string
    {
        return \dirname(__DIR__);
    }

    public function loadExtension(array $config, ContainerConfigurator $container, ContainerBuilder $builder): void
    {
        $container->parameters()
            ->set('framework.messenger.transports.mqtt', "dsn: '%env(MESSENGER_MQTT_TRANSPORT_DSN)%'");


        // load an XML, PHP or Yaml file
        $container->import('../config/services.yaml');
    }

    public function prependExtension(ContainerConfigurator $container, ContainerBuilder $builder): void
    {
        $container->import('../config/messenger.yaml');
    }
}
