<?php
namespace PhpLint\Config;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * @return TreeBuilder
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('root');
        $rootNode
            ->children()
            ->arrayNode('parserOptions')
            ->children()
            ->integerNode('phpVersion')->end()
            ->end()
            ->end()
            ->arrayNode('rules')
            ->prototype('scalar')
            ->end()
            ->end()
            ->end()
            ->end();
        return $treeBuilder;
    }
}