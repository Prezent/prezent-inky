<?php

declare(strict_types=1);

namespace Prezent\Inky\Component;

/**
 * @author Sander Marechal
 */
class WrapperFactory extends BaseFactory
{
    protected static $template = <<<EOL
<table class="wrapper" align="center">
    <tr>
        <td class="wrapper-inner">
            <inky-content />
        </td>
    </tr>
</table>
EOL;

    /**
     * {@inheritDoc}
     */
    public function getName(): string
    {
        return 'wrapper';
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
