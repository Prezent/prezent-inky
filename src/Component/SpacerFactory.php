<?php

declare(strict_types=1);

namespace Prezent\Inky\Component;

/**
 * @author Sander Marechal
 */
class SpacerFactory extends BaseFactory
{
    protected static $template = <<<EOL
<table class="spacer">
    <tbody>
        <tr>
            <td>&#xA0;</td>
        </tr>
    </tbody>
</table>
EOL;

    /**
     * {@inheritDoc}
     */
    public function getName(): string
    {
        return 'item';
    }

    public function parse(\DOMNode $target)
    {
        $size = $target->hasAttribute('size') ? $target->getAttribute('size') : 10;
        $class = $target->hasAttribute('class') ? $target->getAttribute('class') : null;

        $table = $this->replace($target, self::$template);

        if ($class) {
            $this->addClass($table, $class);
        }

        $xpath = new \DOMXpath($table->ownerDocument);
        $spacer = $xpath->query('tbody/tr/td', $table)->item(0);

        $spacer->setAttribute('height', $size . 'px');
        $spacer->setAttribute('style', 'font-size:' . $size . 'px;line-height:' . $size . 'px;');
    }
}
