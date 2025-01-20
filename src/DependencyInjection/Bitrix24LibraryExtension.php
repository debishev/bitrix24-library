<?php

namespace Debishev\Bitrix24Library\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class Bitrix24LibraryExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        // Обрабатываем пользовательские конфигурации
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);


        // Устанавливаем параметры в контейнер
        $container->setParameter('bitrix24_library.webhook_url', $config['webhook_url']);
        $container->setParameter('bitrix24_library.base_url', $config['base_url']);

        $loader = new YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.yaml');


    }
}