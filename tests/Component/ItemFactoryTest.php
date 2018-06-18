<?php

declare(strict_types=1);

namespace Prezent\Inky\Tests\Component;

use Prezent\Inky\Component\ItemFactory;
use Symfony\Component\DomCrawler\Crawler;

/**
 * @author Sander Marechal
 */
class ItemFactoryTest extends ComponentTestCase
{
    public function testBasic()
    {
        $crawler = $this->createCrawler('<menu><item href="/foo">item</item></menu>');
        $factory = new ItemFactory();

        foreach ($crawler->filter('item') as $node) {
            $factory->parse($node);
        }

        $this->assertCount(1, $crawler->filter('menu > th.menu-item > a'));
        $this->assertEquals('/foo', $crawler->filter('menu > th.menu-item > a')->attr('href'));
    }

    public function testDefaultHref()
    {
        $crawler = $this->createCrawler('<menu><item>item</item></menu>');
        $factory = new ItemFactory();

        foreach ($crawler->filter('item') as $node) {
            $factory->parse($node);
        }

        $this->assertCount(1, $crawler->filter('menu > th.menu-item > a'));
        $this->assertEquals('#', $crawler->filter('menu > th.menu-item > a')->attr('href'));
    }

    public function testClasses()
    {
        $crawler = $this->createCrawler('<menu><item href="/foo" class="bar">item</item></menu>');
        $factory = new ItemFactory();

        foreach ($crawler->filter('item') as $node) {
            $factory->parse($node);
        }

        $this->assertCount(1, $crawler->filter('menu > th.menu-item.bar > a'));
    }
}
