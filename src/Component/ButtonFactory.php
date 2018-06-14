<?php

declare(strict_types=1);

namespace Prezent\Inky\Component;

/**
 * @author Sander Marechal
 */
class ButtonFactory extends BaseFactory
{
    protected static $template = <<<EOL
<table class="button">
    <tr>
        <td>
            <table>
                <tr>
                    <td><a href="#"></a></td>
                </tr>
            </table>
        </td>
    </tr>
</table>
EOL;

    /**
     * {@inheritDoc}
     */
    public function getName(): string
    {
        return 'button';
    }

    public function parse(\DOMNode $target)
    {
        $template = $this->getTemplate();

        $table = $template->documentElement;
        $link = $template->getElementsByTagName('a')->item(0);

        $href = $target->hasAttribute('href') ? $target->getAttribute('href') : '#';
        $class = trim(($target->hasAttribute('class') ? $target->getAttribute('class') : '') . ' button');

        $link->setAttribute('href', $href);
        $table->setAttribute('class', $class);

        if (in_array('expanded', explode(' ', $class))) {
            $this->wrap($link, '<center data-parsed="data-parsed"></center>');
        }

        foreach ($target->childNodes as $child) {
            $child = $template->importNode($child, true);
            $link->appendChild($child);
        }

        $clone = $target->ownerDocument->importNode($table, true);
        $target->parentNode->replaceChild($clone, $target);
    }
}
