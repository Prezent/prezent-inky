<?php

declare(strict_types=1);

namespace Prezent\Inky\Tests\Component;

use Prezent\Inky\Component\RowFactory;
use Symfony\Component\DomCrawler\Crawler;

/**
 * @author Sander Marechal
 */
class RowFactoryTest extends ComponentTestCase
{
    public function testBasic()
    {
        $crawler = $this->createCrawler('<container><row><columns>foo</columns></row></container>');
        $factory = new RowFactory();

        foreach ($crawler->filter('row') as $node) {
            $factory->parse($node);
        }

        $this->assertCount(1, $crawler->filter('container table.row columns'));
    }

    public function testClasses()
    {
        $crawler = $this->createCrawler('<container><row class="bar"><columns>foo</columns></row></container>');
        $factory = new RowFactory();

        foreach ($crawler->filter('row') as $node) {
            $factory->parse($node);
        }

        $this->assertCount(1, $crawler->filter('container table.row.bar columns'));
    }

    public function testSingleColumn()
    {
        $crawler = $this->createCrawler('<container><row><columns>foo</columns></row></container>');
        $factory = new RowFactory();

        foreach ($crawler->filter('row') as $node) {
            $factory->parse($node);
        }

        echo $crawler->html();

        $this->assertCount(1, $crawler->filter('container table.row columns.first.last'));
    }

    public function testMultipleColumns()
    {
        $crawler = $this->createCrawler('<container><row><columns>foo</columns><columns>bar</columns><columns>baz</columns></row></container>');
        $factory = new RowFactory();

        foreach ($crawler->filter('row') as $node) {
            $factory->parse($node);
        }

        $this->assertCount(1, $crawler->filter('container table.row columns.first:contains("foo")'));
        $this->assertCount(1, $crawler->filter('container table.row columns.last:contains("baz")'));
    }
}
