<?php

namespace Prezent\Inky\Component;

/**
 * @author Sander Marechal
 */
class CenterFactory extends BaseFactory
{
    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'center';
    }

    public function parse(\DOMNode $target)
    {
        if ($target->hasAttribute('data-parsed')) {
            return;
        }

        $target->setAttribute('data-parsed', 'data-parsed');

        foreach ($target->childNodes as $child) {
            if ($child->nodeType !== XML_ELEMENT_NODE) {
                continue;
            }

            $child->setAttribute('align', 'center');
            $this->addClass($child, 'float-center');
        }
    }
}
