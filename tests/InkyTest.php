<?php

namespace Prezent\Inky\Tests;

use PHPUnit\Framework\TestCase;
use Prezent\Inky\Inky;
use Symfony\Component\DomCrawler\Crawler;

/**
 * @author Sander Marechal
 */
class InkyTest extends TestCase
{
    public function testAllComponentsProcessed()
    {
        $template = <<<EOL
<html>
    <head></head>
    <body>
        <wrapper class="header">
            <container>
                <row class="collapse">
                    <columns small="6" valign="middle">
                        <center>
                            <menu>
                                <item href="#foo">Foo</item>
                                <item href="#bar">Bar</item>
                            </menu>
                        </center>
                    </columns>
                    <columns small="6" valign="middle">
                        <spacer size="20" />
                        <row>
                            <columns>Col 1</columns>
                            <columns>Col 2</columns>
                        </row>
                        <spacer size="20" />
                    </columns>
                </row>
            </container>
        </wrapper>
    </body>
</html>
EOL;

        $inky = new Inky();
        $crawler = new Crawler($inky->parse($template));

        $this->assertCount(0, $crawler->filter('wrapper'));
        $this->assertCount(0, $crawler->filter('container'));
        $this->assertCount(0, $crawler->filter('row'));
        $this->assertCount(0, $crawler->filter('columns'));
        $this->assertCount(0, $crawler->filter('spacer'));
        $this->assertCount(0, $crawler->filter('menu'));
        $this->assertCount(0, $crawler->filter('item'));
        $this->assertCount(0, $crawler->filter('center:not([data-parsed])'));
    }
}
