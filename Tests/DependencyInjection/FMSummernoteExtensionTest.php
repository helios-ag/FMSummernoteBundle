<?php

namespace FM\ElfinderBundle\Tests\DependencyInjection;

use FM\RFMBundle\DependencyInjection\FMRFMExtension;
use Matthias\SymfonyDependencyInjectionTest\PhpUnit\AbstractExtensionTestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Yaml\Parser;

/**
 * Class FMRFMExtensionTest
 */
class FMRFMExtensionTest extends AbstractExtensionTestCase
{
    protected function getContainerExtensions()
    {
        return array(
            new FMRFMExtension(),
        );
    }

    public function testServices()
    {
        $this->load();
        $this->assertContainerBuilderHasAlias('fm_rfm.configurator');
        $this->assertContainerBuilderHasService('fm_rfm.loader');
        $this->assertContainerBuilderHasService('fm_rfm.configurator.default');
        $this->assertContainerBuilderHasService('twig.extension.fm_rfm_init');
    }

    public function testMinimumConfiguration()
    {
        $this->container = new ContainerBuilder();
        $loader          = new FMRFMExtension();
        $loader->load(array($this->getMinimalConfiguration()), $this->container);
        $this->assertTrue($this->container instanceof ContainerBuilder);
    }

    protected function getMinimalConfiguration()
    {
        $yaml = <<<'EOF'
instances:
    default:
      locale: '%locale%'
      editor: simple # other choices are tinymce or simple
      include_assets: true
      fullscreen: true
      connector:
          debug: true # defaults to false
          roots:       # at least one root must be defined
              uploads:
                  driver: LocalFileSystem
                  path: uploads
                  upload_allow: ['image/png', 'image/jpg', 'image/jpeg']
                  upload_deny: ['all']
                  upload_max_size: 2M
EOF;
        $parser = new Parser();

        return $parser->parse($yaml);
    }
}
