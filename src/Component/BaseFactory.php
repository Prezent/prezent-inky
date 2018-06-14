<?php

declare(strict_types=1);

namespace Prezent\Inky\Component;

/**
 * @author Sander Marechal
 */
abstract class BaseFactory implements ComponentFactory
{
    /**
     * @var string
     */
    protected static $template = '';

    /**
     * Get template DOM
     */
    protected function getTemplate(): \DOMDocument
    {
        $dom = new \DOMDocument();
        $dom->loadHTML(trim(static::$template), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD | LIBXML_NOBLANKS);

        return $dom;
    }

    protected function wrap(\DOMElement $element, string $tag)
    {
        $wrapper = $element->ownerDocument->createDocumentFragment();
        $wrapper->appendXML($tag);
        $target = $wrapper->firstChild;

        $element->parentNode->replaceChild($wrapper, $element);
        $target->appendChild($element);
    }
}
