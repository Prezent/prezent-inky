<?php

declare(strict_types=1);

namespace Prezent\Inky\Component;

/**
 * @author Sander Marechal
 */
interface ComponentFactory
{
    /**
     * Get the tag name of the component
     */
    public function getName(): string;

    /**
     * Parse the node
     */
    public function parse(\DOMNode $node);
}
