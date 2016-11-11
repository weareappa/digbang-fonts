<?php
namespace Digbang\FontAwesome;

use Illuminate\Support\Arr;
use Illuminate\Support\HtmlString;

class FontAwesome
{
    /**
     * @type string
     */
    private $tag = 'i';

    /**
     * Builds a FontAwesome icon HTML.
     *
     * @param string $name    The icon name, as indicated in the FA documentation.
     * @param array  $options Extra class/es to add to the icon
     *
     * @return string
     */
    public function icon($name, $options = [])
    {
        $options = $this->parseOptions($options);

        $options['class'] = $this->getClasses($name, Arr::pull($options, 'class'));

        return new HtmlString(
            $this->openTag($this->attributes($options)) . $this->closeTag()
        );
    }

    /**
     * Parses the given name, to check if it starts with "fa-" already.
     *
     * @param string $name
     *
     * @return string
     */
    private function parse($name)
    {
        if (strpos($name, 'fa-') === 0) {
            return $name;
        }

        return "fa-$name";
    }

    /**
     * Opens the configured tag.
     *
     * @param string $content
     *
     * @return string
     */
    private function openTag($content = '')
    {
        return '<' . $this->tag . $content . '>';
    }

    /**
     * Closes the configured tag.
     *
     * @return string
     */
    private function closeTag()
    {
        return '</' . $this->tag . '>';
    }

    /**
     * Returns all needed font-awesome classes, and any extra ones required.
     *
     * @param string $name
     * @param string $extra
     *
     * @return string
     */
    private function getClasses($name, $extra = '')
    {
        return 'fa ' . $this->parse($name) . ($extra ? " $extra" : '');
    }

    /**
     * Parse options and returns them as an array.
     *
     * @param string|array $options
     *
     * @return array
     */
    private function parseOptions($options)
    {
        if (!is_array($options)) {
            $options = ['class' => (string) $options];
        }

        return $options;
    }

    /**
     * @param string $tag
     */
    public function setTag($tag)
    {
        $this->tag = $tag;
    }

    /**
     * @return string
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * Build an HTML attribute string from an array.
     *
     * @param array $attributes
     *
     * @return string
     */
    private function attributes($attributes)
    {
        $html = [];

        foreach ((array) $attributes as $key => $value) {
            $element = $this->attributeElement($key, $value);

            if (! is_null($element)) {
                $html[] = $element;
            }
        }

        return count($html) > 0 ? ' ' . implode(' ', $html) : '';
    }

    /**
     * Build a single attribute element.
     *
     * @param string $key
     * @param string $value
     *
     * @return string
     */
    private function attributeElement($key, $value)
    {
        // For numeric keys we will assume that the key and the value are the same
        // as this will convert HTML attributes such as "required" to a correct
        // form like required="required" instead of using incorrect numerics.
        if (is_numeric($key)) {
            $key = $value;
        }

        if (! is_null($value)) {
            return $key . '="' . e($value) . '"';
        }
    }
}
