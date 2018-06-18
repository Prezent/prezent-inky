<?php

namespace Prezent\Inky\Component;

/**
 * @author Sander Marechal
 */
abstract class BaseFactory implements ComponentFactory
{
    /**
     * Wrap a DOM node in a template
     *
     * @param string $html
     */
    protected function wrap(\DOMElement $element, $html)
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
     *
     * @param string $html
     */
    protected function replace(\DOMElement $element, $html)
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

    /**
     * Add a class to an element
     *
     * @param string $class
     */
    protected function addClass(\DOMElement $element, $class)
    {
        if ($element->hasAttribute('class')) {
            $element->setAttribute('class', $element->getAttribute('class') . ' ' . $class);
        } else {
            $element->setAttribute('class', $class);
        }
    }
}
