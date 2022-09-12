<?php

declare(strict_types=1);

namespace Codea\Bundle\Superfaktura\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

final class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('superfaktura');
        $treeBuilder->getRootNode()
            ->children()
            ->scalarNode('dns')->isRequired()->end()
            ->end()
            ->children()
            ->arrayNode('credentials')
            ->children()
            ->scalarNode('email')->isRequired()->end()
            ->scalarNode('key')->isRequired()->end()
            ->scalarNode('company')->isRequired()->end()
            ->end()
            ->end()
            ->end();

        return $treeBuilder;
    }
}
