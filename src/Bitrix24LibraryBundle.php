<?php

namespace Debishev\Bitrix24Library;

use Symfony\Component\Config\Definition\Configurator\DefinitionConfigurator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Bundle\AbstractBundle;

class Bitrix24LibraryBundle extends AbstractBundle
{
    public function configure(DefinitionConfigurator $definition): void
    {
        $definition->rootNode()
            ->children()
                ->arrayNode('bitrix24')
                    ->children()
                        ->arrayNode('webhook')
                            ->children()
                                ->integerNode('url')->end()
                                ->scalarNode('url')->end()
                            ->end()
                        ->end() // webhook
                        ->integerNode('webhook_url')->end()
                        ->scalarNode('base_url')->end()
                    ->end()
                ->end() // bitrix24
            ->end()
        ;
    }

    public function loadExtension(array $config, ContainerConfigurator $container, ContainerBuilder $builder): void
    {
        $container->services()->get($this->getContainerExtension())
            ->get('bitrix24')->get('webhook')
            ->arg(0, $config['bitrix24']['webhook_url'])
            ->arg(1, $config['bitrix24']['base_url'])
        ;
    }


}