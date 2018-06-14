<?php

declare(strict_types=1);

namespace Prezent\Inky\Tests\Component;

use PHPUnit\Framework\TestCase;
use Symfony\Component\DomCrawler\Crawler;

/**
 * @author Sander Marechal
 */
abstract class ComponentTestCase extends TestCase
{
    protected function createCrawler(string $html)
    {
        return new Crawler('<html><head></head><body>' . $html . '</body></html>', 'http://localhost');
    }
}
