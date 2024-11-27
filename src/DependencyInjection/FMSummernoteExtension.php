<?php

declare(strict_types=1);

namespace FM\SummernoteBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\DependencyInjection\Extension\Extension;

class FMSummernoteExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container): void
    {
        $config = $this->processConfiguration(new Configuration(), $configs);

        $loader = new XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.xml');

        $container->setParameter('fm_summernote', $config);
    }

    public function getAlias(): string
    {
        return 'fm_summernote';
    }

    public function getNamespace(): string
    {
        return 'http://helios-ag.github.io/schema/dic/fm_summernote';
    }
}
