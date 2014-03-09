<?php

namespace Eberhm\PhoenixServerBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('phoenix');
        $rootNode
            ->children()
                ->booleanNode('debug')->defaultFalse()->end()
                ->scalarNode('batchController')->isRequired()->cannotBeEmpty()->end()
                ->scalarNode('jsRootFolder')->isRequired()->cannotBeEmpty()->end()
                ->scalarNode('publicRootFolder')->isRequired()->cannotBeEmpty()->end()
                ->scalarNode('batchSize')->defaultNull()->end()
                ->arrayNode('packages')->isRequired()
                    ->useAttributeAsKey('name')
                    ->prototype('array')
                        ->children()
                            ->arrayNode('files')
                                ->cannotBeEmpty()->prototype('scalar')->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ->end()
        ;


        return $treeBuilder;
    }
}
