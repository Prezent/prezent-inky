<?php

declare(strict_types=1);

namespace Prezent\Inky\Tests\Component;

use Prezent\Inky\Component\ContainerFactory;
use Symfony\Component\DomCrawler\Crawler;

/**
 * @author Sander Marechal
 */
class ContainerFactoryTest extends ComponentTestCase
{
    public function testBasic()
    {
        $crawler = $this->createCrawler('<container><row><columns>foo</columns></row></container>');
        $factory = new ContainerFactory();

        foreach ($crawler->filter('container') as $node) {
            $factory->parse($node);
        }

        $this->assertCount(1, $crawler->filter('table.container tbody row columns'));
    }

    public function testClasses()
    {
        $crawler = $this->createCrawler('<container class="bar"><row><columns>foo</columns></row></container>');
        $factory = new ContainerFactory();

        foreach ($crawler->filter('container') as $node) {
            $factory->parse($node);
        }

        $this->assertCount(1, $crawler->filter('table.container tbody td.bar row columns'));
    }
}
