<?php

namespace Prezent\Inky\Component;

/**
 * @author Sander Marechal
 */
class MenuFactory extends BaseFactory
{
    protected static $template = <<<EOL
<table class="menu">
    <tr>
        <td>
            <table>
                <tr><inky-content /></tr>
            </table>
        </td>
    </tr>
</table>
EOL;

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'menu';
    }

    public function parse(\DOMNode $target)
    {
        $class = $target->hasAttribute('class') ? $target->getAttribute('class') : null;
        $table = $this->replace($target, self::$template);

        if ($class) {
            $this->addClass($table, $class);
        }
    }
}
