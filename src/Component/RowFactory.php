<?php

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
    public function getName()
    {
        return 'row';
    }

    public function parse(\DOMNode $target)
    {
        $class = $target->hasAttribute('class') ? $target->getAttribute('class') : null;
        $table = $this->replace($target, self::$template);

        if ($class) {
            $this->addClass($table, $class);
        }

        // Add first/last class to all columns
        $xpath = new \DOMXpath($table->ownerDocument);
        $columns = $xpath->query('tbody/tr/columns|tbody/tr/th[contains(@class, "columns")]', $table);

        if ($columns->length) {
            $this->addClass($columns->item(0), 'first');
            $this->addClass($columns->item($columns->length - 1), 'last');
        }
    }
}
