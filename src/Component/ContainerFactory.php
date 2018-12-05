<?php

namespace Prezent\Inky\Component;

/**
 * @author Sander Marechal
 */
class ContainerFactory extends BaseFactory
{
    protected static $template = <<<EOL
<table align="center" class="container">
    <tbody>
        <tr>
            <td><inky-content /></td>
        </tr>
    </tbody>
</table>
EOL;

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'container';
    }

    public function parse(\DOMNode $target)
    {
        $class = $target->hasAttribute('class') ? $target->getAttribute('class') : null;
        $table = $this->replace($target, self::$template);

        if ($class) {
            $xpath = new \DOMXPath($table->ownerDocument);
            $xpath->query('.//td', $table)->item(0)
                ->setAttribute('class', $class);
        }
    }
}
