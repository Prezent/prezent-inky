<?php

declare(strict_types=1);

namespace Prezent\Inky\Component;

/**
 * @author Sander Marechal
 */
abstract class BaseFactory implements ComponentFactory
{
    /**
     * Wrap a DOM node in a template
     */
    protected function wrap(\DOMElement $element, string $html)
    {
        $wrapper = $element->ownerDocument->createDocumentFragment();
        $wrapper->appendXML($html);

        $result = $wrapper->firstChild;
        $element->parentNode->appendChild($wrapper);

        $xpath = new \DOMXpath($element->ownerDocument);
        $targets = $xpath->query('//inky-content', $wrapper);

        if ($targets->length) {
            $parent = $targets->item(0)->parentNode;
            $parent->removeChild($targets->item(0));
            $parent->appendChild($element);
        }

        return $result;
    }

    /**
     * Replace a DOM node with a template
     */
    protected function replace(\DOMElement $element, string $html)
    {
        $wrapper = $element->ownerDocument->createDocumentFragment();
        $wrapper->appendXML($html);

        $result = $wrapper->firstChild;
        $element->parentNode->replaceChild($wrapper, $element);

        $xpath = new \DOMXpath($element->ownerDocument);
        $targets = $xpath->query('//inky-content', $wrapper);

        if ($targets->length) {
            $parent = $targets->item(0)->parentNode;
            $parent->removeChild($targets->item(0));

            while ($child = $element->firstChild) {
                $parent->appendChild($child);
            }
        }

        return $result;
    }
}
