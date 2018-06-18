<?php

namespace Prezent\Inky\Component;

/**
 * @author Sander Marechal
 */
class ItemFactory extends BaseFactory
{
    protected static $template = <<<EOL
<th class="menu-item"><a href="#"><inky-content /></a></th>
EOL;

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'item';
    }

    public function parse(\DOMNode $target)
    {
        $href = $target->hasAttribute('href') ? $target->getAttribute('href') : '#';
        $class = $target->hasAttribute('class') ? $target->getAttribute('class') : null;

        $th = $this->replace($target, self::$template);

        if ($class) {
            $this->addClass($th, $class);
        }

        $th->firstChild->setAttribute('href', $href);
    }
}
