<?php

declare(strict_types=1);

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
            <td></td>
        </tr>
    </tbody>
</table>
EOL;

    /**
     * {@inheritDoc}
     */
    public function getName(): string
    {
        return 'container';
    }

    public function parse(\DOMNode $target)
    {
        $template = $this->getTemplate();

        $table = $target->ownerDocument->importNode($template->documentElement, true);
        $target->parentNode->replaceChild($table, $target);

        $content = $table->firstChild->firstChild->firstChild;

        if ($target->hasAttribute('class')) {
            $content->setAttribute('class', $content->getAttribute('class') . ' ' . $target->getAttribute('class'));
        }

        while ($child = $target->firstChild) {
            $content->appendChild($child);
        }
    }
}
