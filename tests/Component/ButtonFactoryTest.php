<?php

declare(strict_types=1);

namespace Prezent\Inky\Tests\Component;

use Prezent\Inky\Component\ButtonFactory;
use Symfony\Component\DomCrawler\Crawler;

/**
 * @author Sander Marechal
 */
class ButtonFactoryTest extends ComponentTestCase
{
    public function testBasic()
    {
        $crawler = $this->createCrawler('<button href="/foo">Click me</button>');
        $factory = new ButtonFactory();

        foreach ($crawler->filter('button') as $node) {
            $factory->parse($node);
        }

        $this->assertCount(1, $crawler->filter('table.button table a'));
        $this->assertEquals('/foo', $crawler->filter('table.button table a')->attr('href'));
    }

    public function testDefaultHref()
    {
        $crawler = $this->createCrawler('<button>Click me</button>');
        $factory = new ButtonFactory();

        foreach ($crawler->filter('button') as $node) {
            $factory->parse($node);
        }

        $this->assertCount(1, $crawler->filter('table.button table a'));
        $this->assertEquals('#', $crawler->filter('table.button table a')->attr('href'));
    }

    public function testClasses()
    {
        $crawler = $this->createCrawler('<button class="success rounded">Click me</button>');
        $factory = new ButtonFactory();

        foreach ($crawler->filter('button') as $node) {
            $factory->parse($node);
        }

        $this->assertCount(1, $crawler->filter('table.button.success.rounded'));
    }

    public function testExpanded()
    {
        $crawler = $this->createCrawler('<button class="expanded">Click me</button>');
        $factory = new ButtonFactory();

        foreach ($crawler->filter('button') as $node) {
            $factory->parse($node);
        }

        $this->assertCount(1, $crawler->filter('table.expanded table center[data-parsed] > a'));
    }
}
