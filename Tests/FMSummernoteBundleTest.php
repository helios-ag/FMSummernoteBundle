<?php

namespace FM\SummernoteBundle\Tests;

use FM\SummernoteBundle\FMSummernoteBundle;

/**
 * Class FMSummernoteBundleTest.
 */
class FMSummernoteBundleTest extends \PHPUnit\Framework\TestCase
{
    public function testBundle()
    {
        $bundle = new FMSummernoteBundle();
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
            ->with($this->isInstanceOf('FM\SummernoteBundle\DependencyInjection\Compiler\TwigFormPass'))
            ->will($this->returnSelf());

        $bundle = new FMSummernoteBundle();
        $bundle->build($containerBuilder);
    }
}
