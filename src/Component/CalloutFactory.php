<?php

declare(strict_types=1);

namespace Prezent\Inky\Component;

/**
 * @author Sander Marechal
 */
class CalloutFactory extends BaseFactory
{
    protected static $template = <<<EOL
<table class="callout">
    <tr>
        <th class="callout-inner"></th>
        <th class="expander"></th>
    </tr>
</table>
EOL;

    /**
     * {@inheritDoc}
     */
    public function getName(): string
    {
        return 'callout';
    }

    public function parse(\DOMNode $target)
    {
        $template = $this->getTemplate();

        $table = $target->ownerDocument->importNode($template->documentElement, true);
        $target->parentNode->replaceChild($table, $target);

        $content = $table->firstChild->firstChild;

        if ($target->hasAttribute('class')) {
            $content->setAttribute('class', $content->getAttribute('class') . ' ' . $target->getAttribute('class'));
        }

        while ($child = $target->firstChild) {
            $content->appendChild($child);
        }
    }
}
