<?php

declare(strict_types=1);

namespace FM\SummernoteBundle\Tests;

use FM\SummernoteBundle\FMSummernoteBundle;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class FMSummernoteBundleTest extends TestCase
{
    public function testBundle(): void
    {
        $bundle = new FMSummernoteBundle();
        $this->assertInstanceOf(Bundle::class, $bundle);
    }
}
