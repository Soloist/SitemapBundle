<?php

namespace Soloist\Bundle\SitemapBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class SoloistSitemapExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.xml');

        $this->loadSitemaps($config['sitemaps'], $container);
        $this->loadIndexes($config['indexes'], $container);
    }

    private function loadSitemaps(array $config, ContainerBuilder $container)
    {
        // Iterate over sitemaps definitions, and create sitemap services
        foreach ($config as $id => $sitemapConfig) {
            $definition = new Definition(
                $container->getParameter('soloist_sitemap.sitemap.class'),
                array(new Reference('router'), new Reference('event_dispatcher'))
            );

            // Set the root parameters
            $definition
                ->addMethodCall('setId', array($id))
                ->addMethodCall('setTitle', array($sitemapConfig['root']['title']))
                ->addMethodCall('setRoute', array($sitemapConfig['root']['route']))
                ->addMethodCall('setParams', array($sitemapConfig['root']['params']))
            ;

            // Add the service to the container
            $container->setDefinition('soloist_sitemap.sitemap.'.$id, $definition);

            // If we've got just one sitemap, we create an alias to it.
            if (1 === count($config) && !$container->hasDefinition('sitemap')) {
                $container->setAlias('sitemap', 'soloist_sitemap.sitemap.'.$id);
            }
        }
    }

    private function loadIndexes(array $config, ContainerBuilder $container)
    {
        foreach ($config as $id => $index) {
            $definition = new Definition($container->getParameter('soloist_sitemap.index.class'));

            foreach ($index['sitemaps'] as $sitemap) {
                $definition->addMethodCall('add', array(new Reference('soloist_sitemap.sitemap.'.$sitemap)));
            }

            $container->setDefinition('soloist_sitemap.index.'.$id, $definition);

            // If we've got just one sitemap, we create an alias to it.
            if (1 === count($config) && !$container->hasDefinition('sitemap')) {
                $container->setAlias('sitemap.index', 'soloist_sitemap.index.'.$id);
            }
        }
    }

}
