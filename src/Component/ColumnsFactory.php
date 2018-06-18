<?php

declare(strict_types=1);

namespace Prezent\Inky\Component;

/**
 * @author Sander Marechal
 */
class ColumnsFactory extends BaseFactory
{
    protected static $template = <<<EOL
<th class="columns">
    <table>
        <tr>
            <th><inky-content /></th>
            <th class="expander"></th>
        </tr>
    </table>
</th>
EOL;

    /**
     * {@inheritDoc}
     */
    public function getName(): string
    {
        return 'columns';
    }

    public function parse(\DOMNode $target)
    {
        $class = $target->hasAttribute('class') ? $target->getAttribute('class') : null;
        $small = $target->hasAttribute('small') ? $target->getAttribute('small') : null;
        $large = $target->hasAttribute('large') ? $target->getAttribute('large') : null;

        $th = $this->replace($target, self::$template);

        if ($class) {
            $this->addClass($th, $class);
        }

        if ($small) {
            $this->addClass($th, 'small-' . $small);
        }

        if ($large) {
            $this->addClass($th, 'large-' . $large);
        }
    }
}
