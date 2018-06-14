<?php

namespace FM\RFMBundle\Tests;

use FM\RFMBundle\FMRFMBundle;

/**
 * Class FMRFMBundleTest
 */
class FMRFMBundleTest extends \PHPUnit\Framework\TestCase
{
    public function testBundle()
    {
        $bundle = new FMRFMBundle();
        $this->assertInstanceOf('Symfony\Component\HttpKernel\Bundle\Bundle', $bundle);
    }

    public function testCompilerPasses()
    {
        $containerBuilder = $this->getMockBuilder('Symfony\Component\DependencyInjection\ContainerBuilder')
            ->disableOriginalConstructor()
            ->setMethods(array('addCompilerPass'))
            ->getMock();
        $containerBuilder
            ->expects($this->at(0))
            ->method('addCompilerPass')
            ->with($this->isInstanceOf('FM\RFMBundle\DependencyInjection\Compiler\TwigFormPass'))
            ->will($this->returnSelf());
        $containerBuilder
            ->expects($this->at(1))
            ->method('addCompilerPass')
            ->with($this->isInstanceOf('Symfony\Component\EventDispatcher\DependencyInjection\RegisterListenersPass'))
            ->will($this->returnSelf());
        $bundle = new FMRFMBundle();
        $bundle->build($containerBuilder);
    }
}
