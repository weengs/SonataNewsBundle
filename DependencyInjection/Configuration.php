<?php
/*
 * This file is part of the Sonata package.
 *
 * (c) Thomas Rabaix <thomas.rabaix@sonata-project.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sonata\NewsBundle\DependencyInjection;

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
        $rootNode = $treeBuilder->root('sonata_news');

        $rootNode
            ->children()
                ->scalarNode('title')->isRequired()->end()
                ->scalarNode('link')->isRequired()->end()
                ->scalarNode('description')->isRequired()->end()
                ->scalarNode('permalink_generator')->defaultValue('sonata.news.permalink.date')->end()
                ->scalarNode('salt')->isRequired()->end()

                ->arrayNode('comment')
                    ->children()
                        ->arrayNode('notification')
                            ->children()
                                ->arrayNode('emails')
                                    ->prototype('scalar')->cannotBeEmpty()->end()
                                ->end()
                                ->scalarNode('from')->cannotBeEmpty()->end()
                                ->scalarNode('template')->cannotBeEmpty()->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
