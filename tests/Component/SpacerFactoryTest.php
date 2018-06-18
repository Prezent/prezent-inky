<?php

declare(strict_types=1);

namespace Prezent\Inky\Tests\Component;

use Prezent\Inky\Component\SpacerFactory;
use Symfony\Component\DomCrawler\Crawler;

/**
 * @author Sander Marechal
 */
class SpacerFactoryTest extends ComponentTestCase
{
    public function testBasic()
    {
        $crawler = $this->createCrawler('<spacer size="100"></spacer>');
        $factory = new SpacerFactory();

        foreach ($crawler->filter('spacer') as $node) {
            $factory->parse($node);
        }

        $this->assertCount(1, $crawler->filter('table.spacer > tbody > tr > td[height="100px"]'));
    }

    public function testClasses()
    {
        $crawler = $this->createCrawler('<spacer size="100" class="foo"></spacer>');
        $factory = new SpacerFactory();

        foreach ($crawler->filter('spacer') as $node) {
            $factory->parse($node);
        }

        $this->assertCount(1, $crawler->filter('table.spacer.foo > tbody > tr > td[height="100px"]'));
    }
}
