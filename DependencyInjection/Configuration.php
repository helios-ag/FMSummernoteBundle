<?php

namespace FM\SummernoteBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Class Configuration.
 */
class Configuration implements ConfigurationInterface
{
    /**
     * @return TreeBuilder
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('fm_summernote');

        $rootNode
            ->children()
                ->integerNode('width')->defaultValue(600)->end()
                ->integerNode('height')->defaultValue(400)->end()
                ->booleanNode('include_jquery')->defaultTrue()->end()
                ->booleanNode('include_bootstrap')->defaultTrue()->end()
                ->booleanNode('include_fontawesome')->defaultTrue()->end()
                ->scalarNode('fontawesome_path')->defaultValue('vendor/font-awesome.min.css')->end()
                ->scalarNode('bootstrap_css_path')->defaultValue('vendor/bootstrap.min.css')->end()
                ->scalarNode('bootstrap_js_path')->defaultValue('vendor/bootstrap.min.js')->end()
                ->scalarNode('jquery_path')->defaultValue('vendor/jquery-1.11.3.min.js')->end()
                ->scalarNode('summernote_css_path')->defaultValue('summernote.css')->end()
                ->scalarNode('summernote_js_path')->defaultValue('summernote.min.js')->end()
                ->scalarNode('basePath')->end()
                ->scalarNode('init_template')->defaultValue('FMSummernoteBundle::init.html.twig')->end()
                ->scalarNode('selector')->defaultValue('.summernote')->end()
                ->scalarNode('language')->end()
                ->arrayNode('plugins')
                    ->prototype('scalar')->end()
                ->end()
                ->arrayNode('toolbar')
                    ->useAttributeAsKey('name')
                    ->prototype('array')
                        ->useAttributeAsKey('name')
                            ->prototype('variable')->end()
                    ->end()
                ->end()
                ->arrayNode('extra_toolbar')
                    ->useAttributeAsKey('name')
                    ->prototype('array')
                        ->useAttributeAsKey('name')
                            ->prototype('variable')->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}
