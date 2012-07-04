<?php

namespace Soloist\Bundle\SitemapBundle\DependencyInjection;

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
        $rootNode = $treeBuilder->root('soloist_sitemap');

        $rootNode
            ->children()
                // Define a sitemap array, if there's not, we create a "default" sitemap
                ->arrayNode('sitemaps')
                    ->useAttributeAsKey('id')
                    ->addDefaultChildrenIfNoneSet('default')
                    ->prototype('array')
                        ->children()
                            // Sitemap root configuration, with default values
                            ->arrayNode('root')
                                ->addDefaultsIfNotSet()
                                ->children()
                                    ->scalarNode('title')->defaultValue('Homepage')->end()
                                    ->scalarNode('route')->defaultValue('homepage')->end()
                                    ->arrayNode('params')
                                        ->useAttributeAsKey('param')
                                        ->prototype('variable')->end()
                                    ->end()
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
