<?php

declare(strict_types=1);

namespace Prezent\Inky\Tests\Component;

use Prezent\Inky\Component\CenterFactory;
use Symfony\Component\DomCrawler\Crawler;

/**
 * @author Sander Marechal
 */
class CenterFactoryTest extends ComponentTestCase
{
    public function testCenter()
    {
        $crawler = $this->createCrawler('<center><p>foo</p><img src="/bar" /></center>');
        $factory = new CenterFactory();

        foreach ($crawler->filter('center') as $node) {
            $factory->parse($node);
        }

        $this->assertCount(1, $crawler->filter('center[data-parsed]'));
        $this->assertCount(1, $crawler->filter('center[data-parsed] p[align="center"].float-center'));
        $this->assertCount(1, $crawler->filter('center[data-parsed] img[align="center"].float-center'));
    }
}
