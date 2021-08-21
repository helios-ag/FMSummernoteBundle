<?php

namespace FM\SummernoteBundle\Tests\DependencyInjection;

use FM\SummernoteBundle\DependencyInjection\FMSummernoteExtension;
use Matthias\SymfonyDependencyInjectionTest\PhpUnit\AbstractExtensionTestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Yaml\Parser;

class FMSummernoteExtensionTest extends AbstractExtensionTestCase
{
    protected function getContainerExtensions(): array
    {
        return [
            new FMSummernoteExtension(),
        ];
    }

    public function testServices()
    {
        $this->load();
        $this->assertContainerBuilderHasService('twig.extension.fm_summernote');
    }

    public function testMinimumConfiguration()
    {
        $this->container = new ContainerBuilder();
        $loader          = new FMSummernoteExtension();
        $loader->load([$this->getMinimalConfiguration()], $this->container);
        $this->assertTrue($this->container instanceof ContainerBuilder);
    }

    protected function getMinimalConfiguration(): array
    {
        $yaml = <<<'EOF'
plugins:
    - video
    - elfinder # by default plugins not set, bundle comes with elfinder plugin / provides integration with FMElfinderBundle
selector: .summernote #defines summernote selector for apply to
toolbar: # define toolbars, if no toolbar configured, default toolbars defined
    style: [style]
    bold: [bold]
extra_toolbar: # extra toolbar can be used for plugins toolbar and as additional toolbar setings, when 'toolbar' option is omitted
    elfinder: [elfinder]
width: 600
height: 400
language: '' # define language (with language culture code like de-DE, fr-FR, etc.) by default, it is in english
include_jquery: true #include js libraries, if your template already have them, set to false
include_bootstrap: true
include_fontawesome: true
EOF;
        $parser = new Parser();

        return $parser->parse($yaml);
    }
}
