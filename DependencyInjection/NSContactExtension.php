<?php

namespace NS\ContactBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class NSContactExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);
        $container->setParameter('ns_contact.disable_delivery', $config['disable_delivery']);
        $container->setParameter('ns_contact.subject', $config['subject']);
        $container->setParameter('ns_contact.emailto', $config['emailto']);
        $container->setParameter('ns_contact.sender_name', $config['sender_name']);
        $container->setParameter('ns_contact.success_url', $config['success_url']);
        $container->setParameter('ns_contact.template', $config['template']);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');
    }
}
