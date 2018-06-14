<?php

declare(strict_types=1);

namespace Prezent\Inky\Tests\Component;

use Prezent\Inky\Component\CalloutFactory;
use Symfony\Component\DomCrawler\Crawler;

/**
 * @author Sander Marechal
 */
class CalloutFactoryTest extends ComponentTestCase
{
    public function testBasic()
    {
        $crawler = $this->createCrawler('<callout><p>foo</p><p>bar</p></callout>');
        $factory = new CalloutFactory();

        foreach ($crawler->filter('callout') as $node) {
            $factory->parse($node);
        }

        $this->assertCount(2, $crawler->filter('table.callout th.callout-inner p'));
    }

    public function testClasses()
    {
        $crawler = $this->createCrawler('<callout class="primary"><p>foo</p></callout>');
        $factory = new CalloutFactory();

        foreach ($crawler->filter('callout') as $node) {
            $factory->parse($node);
        }

        $this->assertCount(1, $crawler->filter('table.callout th.callout-inner.primary p'));
    }
}
