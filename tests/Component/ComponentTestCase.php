<?php

namespace Prezent\Inky\Tests\Component;

use PHPUnit\Framework\TestCase;
use Symfony\Component\DomCrawler\Crawler;

/**
 * @author Sander Marechal
 */
abstract class ComponentTestCase extends TestCase
{
    /**
     * Create a DOM crawler
     *
     * @param string $html
     * @return Crawler
     */
    protected function createCrawler($html)
    {
        return new Crawler('<html><head></head><body>' . $html . '</body></html>', 'http://localhost');
    }
}
