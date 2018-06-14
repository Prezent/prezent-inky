<?php

declare(strict_types=1);

namespace Prezent\Inky;

use Prezent\Inky\Component\ComponentFactory;

/**
 * @author Sander Marechal
 */
class Inky
{
    /**
     * @var array
     */
    private $componentFactories;

    /**
     * Constructor
     */
    public function __construct(array $componentFactories = [])
    {
        if (empty($componentFactories)) {
            $componentFactories = self::getDefaultComponentFactories();
        }

        foreach ($componentFactories as $factory) {
            $this->addComponentFactory($factory);
        }
    }

    /**
     * Add a component factory
     */
    public function addComponentFactory(ComponentFactory $componentFactory): self
    {
        $this->componentFactories[$componentFactory->getName()] = $componentFactory;
        return $this;
    }

    /**
     * Parse HTML and replace inky components
     */
    public function parse(string $html): string
    {
        $errorHandling = libxml_use_internal_errors(true);

        $dom = new \DOMDocument();
        $dom->loadHTML($html, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

        $xpath = new \DOMXpath($dom);

        foreach ($this->componentFactories as $tag => $factory) {
            $tags = $xpath->query('//' . $tag);

            if ($tags) {
                foreach ($tags as $node) {
                    $factory->parse($node);
                }
            }
        }

        libxml_clear_errors();
        libxml_use_internal_errors($errorHandling);

        return $dom->saveHTML();
    }

    /**
     * Get default component factories
     */
    public static function getDefaultComponentFactories(): array
    {
        return [
            new Component\ButtonFactory(),
        ];
    }
}
