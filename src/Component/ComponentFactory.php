<?php

namespace Prezent\Inky\Component;

/**
 * @author Sander Marechal
 */
interface ComponentFactory
{
    /**
     * Get the tag name of the component
     *
     * @return string
     */
    public function getName();

    /**
     * Parse the node
     */
    public function parse(\DOMNode $node);
}
