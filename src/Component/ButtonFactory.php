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
                    <td><a href="#"><inky-content /></a></td>
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
        $href = $target->hasAttribute('href') ? $target->getAttribute('href') : '#';
        $class = trim(($target->hasAttribute('class') ? $target->getAttribute('class') : '') . ' button');

        $table = $this->replace($target, self::$template);
        $table->setAttribute('class', $class);

        $xpath = new \DOMXpath($table->ownerDocument);
        $link = $xpath->query('//a', $table)->item(0);
        $link->setAttribute('href', $href);

        if (in_array('expanded', explode(' ', $class))) {
            $this->wrap($link, '<center data-parsed="data-parsed"><inky-content /></center>');
        }
    }
}
