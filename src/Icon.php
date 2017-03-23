<?php
namespace Digbang\Fonts;

use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\HtmlString;

class Icon implements Htmlable
{
    /**
     * @var string
     */
    private $tag;

    /**
     * @var string
     */
    private $name;

    /**
     * @var array
     */
    private $options;

    /**
     * @var string
     */
    private $content;

    /**
     * @param string $tag
     * @param string $name
     * @param array  $options
     */
    public function __construct($tag, $name, array $options)
    {
        $this->tag = $tag;
        $this->name = $name;
        $this->options = $options;
    }

    /**
     * @param string $tag
     *
     * @return Icon
     */
    public function withTag($tag)
    {
        return (new Icon($tag, $this->name, $this->options))->withContent($this->content);
    }

    /**
     * @param string $content
     *
     * @return Icon
     */
    public function withContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content as a string of HTML.
     *
     * @return string
     */
    public function toHtml()
    {
        return (new HtmlString(
            $this->openTag($this->attributes($this->options)) .
            $this->content .
            $this->closeTag()
        ))->toHtml();
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
        return '<'.$this->tag.$content.'>';
    }

    /**
     * Closes the configured tag.
     *
     * @return string
     */
    private function closeTag()
    {
        return '</'.$this->tag.'>';
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

            if ($element !== null) {
                $html[] = $element;
            }
        }

        return count($html) > 0 ? ' '.implode(' ', $html) : '';
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

        if ($value !== null) {
            return $key.'="'.e($value).'"';
        }
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->toHtml();
    }
}
