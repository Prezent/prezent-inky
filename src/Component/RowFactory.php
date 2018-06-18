<?php

declare(strict_types=1);

namespace Prezent\Inky\Component;

/**
 * @author Sander Marechal
 */
class RowFactory extends BaseFactory
{
    protected static $template = <<<EOL
<table class="row">
    <tbody>
        <tr>
            <inky-content />
        </tr>
    </tbody>
</table>
EOL;

    /**
     * {@inheritDoc}
     */
    public function getName(): string
    {
        return 'row';
    }

    public function parse(\DOMNode $target)
    {
        $class = $target->hasAttribute('class') ? $target->getAttribute('class') : null;
        $table = $this->replace($target, self::$template);

        if ($class) {
            $table->setAttribute('class', 'row ' . $class);
        }
    }
}
