<?php

namespace App\Support;

use DOMDocument;
use DOMElement;
use DOMNode;

class HtmlSanitizer
{
    /**
     * Tags removed entirely, including their content (never just unwrapped).
     */
    private const STRIPPED_TAGS = ['script', 'style', 'iframe', 'object', 'embed', 'svg'];

    /**
     * @var array<string, list<string>>
     */
    private const ALLOWED_TAGS = [
        'p' => [],
        'br' => [],
        'strong' => [],
        'b' => [],
        'em' => [],
        'i' => [],
        'u' => [],
        's' => [],
        'h2' => [],
        'h3' => [],
        'ul' => [],
        'ol' => [],
        'li' => [],
        'blockquote' => [],
        'a' => ['href', 'target', 'rel'],
    ];

    /**
     * Strip any tag, attribute or protocol not explicitly allow-listed above,
     * so rich text authored by an admin can never inject scripts or event handlers.
     */
    public function clean(string $html): string
    {
        if (trim($html) === '') {
            return '';
        }

        $document = new DOMDocument;
        libxml_use_internal_errors(true);
        $document->loadHTML(
            '<?xml encoding="utf-8"?><div>'.$html.'</div>',
            LIBXML_NOERROR | LIBXML_NOWARNING
        );
        libxml_clear_errors();

        $body = $document->getElementsByTagName('div')->item(0);

        if ($body !== null) {
            $this->cleanNode($body, $document);
        }

        $inner = '';
        foreach ($body?->childNodes ?? [] as $child) {
            $inner .= $document->saveHTML($child);
        }

        return trim($inner);
    }

    private function cleanNode(DOMNode $node, DOMDocument $document): void
    {
        $children = [];
        foreach ($node->childNodes as $child) {
            $children[] = $child;
        }

        foreach ($children as $child) {
            if ($child instanceof DOMElement) {
                $tag = strtolower($child->tagName);

                if (in_array($tag, self::STRIPPED_TAGS, true)) {
                    $node->removeChild($child);

                    continue;
                }

                if (! array_key_exists($tag, self::ALLOWED_TAGS)) {
                    $this->cleanNode($child, $document);
                    $this->unwrap($child);

                    continue;
                }

                $this->stripDisallowedAttributes($child, self::ALLOWED_TAGS[$tag]);

                if ($tag === 'a') {
                    $this->sanitizeLink($child);
                }

                $this->cleanNode($child, $document);
            }
        }
    }

    /**
     * @param  list<string>  $allowedAttributes
     */
    private function stripDisallowedAttributes(DOMElement $element, array $allowedAttributes): void
    {
        $attributes = [];
        foreach ($element->attributes ?? [] as $attribute) {
            $attributes[] = $attribute->name;
        }

        foreach ($attributes as $name) {
            if (! in_array($name, $allowedAttributes, true)) {
                $element->removeAttribute($name);
            }
        }
    }

    private function sanitizeLink(DOMElement $link): void
    {
        $href = $link->getAttribute('href');

        if ($href === '' || ! preg_match('/^(https?:|mailto:|tel:|\/|#)/i', $href)) {
            $link->removeAttribute('href');
        }

        $link->setAttribute('rel', 'noopener noreferrer');
        $link->setAttribute('target', '_blank');
    }

    private function unwrap(DOMElement $element): void
    {
        $parent = $element->parentNode;

        if ($parent === null) {
            return;
        }

        while ($element->firstChild !== null) {
            $parent->insertBefore($element->firstChild, $element);
        }

        $parent->removeChild($element);
    }
}
