<?php

namespace Aga\DateConverterBundle\Tests\Extension;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Aga\DateConverterBundle\Extension\DateConverterTwigExtension;

class DateConverterTwigExtensionTest extends \PHPUnit_Framework_TestCase
{
    public function testThatExtensionsExists()
    {
        $extension = new DateConverterTwigExtension();

        $this->assertEquals('Aga\DateConverterBundle\Extension\DateConverterTwigExtension',
            get_class($extension));

        $this->assertEquals(true, method_exists($extension, 'ago'));
    }

    public function testCreatedAgoExtension()
    {
        $extension = new DateConverterTwigExtension();

        $this->assertEquals("0 seconds ago", $extension->ago(new \DateTime()));
        $this->assertEquals("34 seconds ago", $extension->ago($this->getDateTime(-34)));
        $this->assertEquals("1 minute ago", $extension->ago($this->getDateTime(-60)));
        $this->assertEquals("2 minutes ago", $extension->ago($this->getDateTime(-120)));
        $this->assertEquals("1 hour ago", $extension->ago($this->getDateTime(-3600)));
        $this->assertEquals("1 hour ago", $extension->ago($this->getDateTime(-3601)));
        $this->assertEquals("2 hours ago", $extension->ago($this->getDateTime(-7200)));
    }

    protected function getDateTime($delta)
    {
        return new \DateTime(date("Y-m-d H:i:s", time()+$delta));
    }

}
