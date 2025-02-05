<?php

namespace Debishev\Bitrix24Library\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('bitrix24_library');

        $treeBuilder->getRootNode()
            ->children()
                ->scalarNode('app_client_id')->defaultValue('%env(BITRIX24_APP_CLIENT_ID)%')->end()
                ->scalarNode('app_client_secret')->defaultValue('%env(BITRIX24_APP_CLIENT_SECRET)%')->end()
                ->scalarNode('webhook_url')->defaultValue('%env(BITRIX24_WEBHOOK_URL)%')->end()
                ->scalarNode('base_url')->defaultValue('%env(BITRIX24_BASE_URL)%')->end()
            ->end();

        return $treeBuilder;
    }
}