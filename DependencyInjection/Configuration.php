<?php

namespace NS\ContactBundle\DependencyInjection;

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
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('ns_contact');

        $rootNode
        ->children()
            ->scalarNode('emailto')->isRequired()->cannotBeEmpty()->end()
            ->scalarNode('sender_name')->isRequired()->cannotBeEmpty()->end()
            ->scalarNode('subject')->defaultNull()->end()
            ->scalarNode('template')->defaultNull()->end()
            ->scalarNode('success_url')->defaultNull()->end()
            ->booleanNode('disable_delivery')->defaultFalse()->end()
        ->end();

        return $treeBuilder;
    }
}
