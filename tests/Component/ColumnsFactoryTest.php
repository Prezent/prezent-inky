<?php

declare(strict_types=1);

namespace Prezent\Inky\Tests\Component;

use Prezent\Inky\Component\ColumnsFactory;
use Symfony\Component\DomCrawler\Crawler;

/**
 * @author Sander Marechal
 */
class ColumnsFactoryTest extends ComponentTestCase
{
    public function testBasic()
    {
        $crawler = $this->createCrawler('<container><row><columns>foo</columns></row></container>');
        $factory = new ColumnsFactory();

        foreach ($crawler->filter('columns') as $node) {
            $factory->parse($node);
        }

        $this->assertCount(2, $crawler->filter('container row > th.columns table th'));
        $this->assertCount(1, $crawler->filter('container row > th.columns table th.expander:last-child'));
    }

    public function testAttributes()
    {
        $crawler = $this->createCrawler('<container><row><columns class="bar" small="6" large="4">foo</columns></row></container>');
        $factory = new ColumnsFactory();

        foreach ($crawler->filter('columns') as $node) {
            $factory->parse($node);
        }

        $this->assertCount(2, $crawler->filter('container row th.small-6.large-4.columns.bar table th'));
    }
}
