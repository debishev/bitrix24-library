<?php

namespace Debishev\Bitrix24Library;

use Symfony\Component\Config\Definition\Configurator\DefinitionConfigurator;
use Symfony\Component\HttpKernel\Bundle\AbstractBundle;

class Bitrix24LibraryBundle extends AbstractBundle
{
    public function configure(DefinitionConfigurator $definition): void
    {
        $definition->rootNode()
            ->children()
                ->arrayNode('bitrix24')
                    ->children()
                        ->integerNode('webhook_url')->end()
                        ->scalarNode('base_url')->end()
                    ->end()
                ->end() // bitrix24
            ->end()
        ;
    }

}