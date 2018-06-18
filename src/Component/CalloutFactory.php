<?php

namespace Prezent\Inky\Component;

/**
 * @author Sander Marechal
 */
class CalloutFactory extends BaseFactory
{
    protected static $template = <<<EOL
<table class="callout">
    <tr>
        <th class="callout-inner"><inky-content /></th>
        <th class="expander"></th>
    </tr>
</table>
EOL;

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'callout';
    }

    public function parse(\DOMNode $target)
    {
        $class = $target->hasAttribute('class') ? $target->getAttribute('class') : null;
        $table = $this->replace($target, self::$template);

        if ($class) {
            $xpath = new \DOMXPath($table->ownerDocument);
            $xpath->query('//th[contains(@class, "callout-inner")]', $table)->item(0)
                ->setAttribute('class', 'callout-inner ' . $class);
        }
    }
}
