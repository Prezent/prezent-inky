<?php

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
    private $componentFactories = [];

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
     *
     * @return self
     */
    public function addComponentFactory(ComponentFactory $componentFactory)
    {
        $this->componentFactories[$componentFactory->getName()] = $componentFactory;
        return $this;
    }

    /**
     * Parse HTML and replace inky components
     *
     * @param string $html
     * @return string
     */
    public function parse($html)
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
     *
     * @return array
     */
    public static function getDefaultComponentFactories()
    {
        return [
            new Component\ButtonFactory(),
            new Component\CalloutFactory(),
            new Component\CenterFactory(),
            new Component\ColumnsFactory(),
            new Component\ContainerFactory(),
            new Component\ItemFactory(),
            new Component\MenuFactory(),
            new Component\RowFactory(),
            new Component\SpacerFactory(),
            new Component\WrapperFactory(),
        ];
    }
}
