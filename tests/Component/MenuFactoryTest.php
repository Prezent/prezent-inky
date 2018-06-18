<?php

declare(strict_types=1);

namespace Prezent\Inky\Tests\Component;

use Prezent\Inky\Component\MenuFactory;
use Symfony\Component\DomCrawler\Crawler;

/**
 * @author Sander Marechal
 */
class MenuFactoryTest extends ComponentTestCase
{
    public function testBasic()
    {
        $crawler = $this->createCrawler('<menu><item href="#foo">item</item></menu>');
        $factory = new MenuFactory();

        foreach ($crawler->filter('menu') as $node) {
            $factory->parse($node);
        }

        $this->assertCount(1, $crawler->filter('table.menu > tr > td > table > tr > item'));
    }

    public function testClasses()
    {
        $crawler = $this->createCrawler('<menu class="vertical"><item href="#foo">item</item></menu>');
        $factory = new MenuFactory();

        foreach ($crawler->filter('menu') as $node) {
            $factory->parse($node);
        }

        $this->assertCount(1, $crawler->filter('table.menu.vertical > tr > td > table > tr > item'));
    }
}
