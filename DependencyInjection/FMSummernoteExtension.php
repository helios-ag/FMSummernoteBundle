<?php

namespace FM\SummernoteBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * Class FMSummernoteExtension.
 */
class FMSummernoteExtension extends Extension
{
    /**
     * @param array            $configs
     * @param ContainerBuilder $container
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $config = $this->processConfiguration(new Configuration(), $configs);

        $loader = new XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.xml');

        $container->setParameter('fm_summernote', $config);
    }

    /**
     * @return string
     */
    public function getAlias()
    {
        return 'fm_summernote';
    }

    /**
     * @return string
     */
    public function getNamespace()
    {
        return 'http://helios-ag.github.io/schema/dic/fm_summernote';
    }
}
