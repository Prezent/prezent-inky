<?php

namespace Prezent\Inky\Tests\Component;

use Prezent\Inky\Component\WrapperFactory;
use Symfony\Component\DomCrawler\Crawler;

/**
 * @author Sander Marechal
 */
class WrapperFactoryTest extends ComponentTestCase
{
    public function testBasic()
    {
        $crawler = $this->createCrawler('<wrapper><p>foo</p></wrapper>');
        $factory = new WrapperFactory();

        foreach ($crawler->filter('wrapper') as $node) {
            $factory->parse($node);
        }

        $this->assertCount(1, $crawler->filter('table.wrapper > tr > td.wrapper-inner > p'));
    }

    public function testClasses()
    {
        $crawler = $this->createCrawler('<wrapper class="bar"><p>foo</p></wrapper>');
        $factory = new WrapperFactory();

        foreach ($crawler->filter('wrapper') as $node) {
            $factory->parse($node);
        }

        $this->assertCount(1, $crawler->filter('table.wrapper.bar > tr > td.wrapper-inner > p'));
    }
}
