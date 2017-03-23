<?php
namespace Digbang\Fonts;

use Illuminate\Support\Arr;

class Factory
{
    /**
     * @var string
     */
    private $tag;

    /**
     * @var string
     */
    private $prefix;

    /**
     * @param string $prefix
     * @param string $tag
     */
    public function __construct($prefix, $tag = 'i')
    {
        $this->prefix = $prefix;
        $this->tag = $tag;
    }

    /**
     * Builds an HTML icon.
     *
     * @param string $name    The icon name, as indicated in the FA documentation.
     * @param array  $options Extra class/es to add to the icon
     *
     * @return Icon
     */
    public function icon($name, $options = [])
    {
        $options = $this->parseOptions($options);

        $options['class'] = $this->getClasses($name, Arr::pull($options, 'class'));

        return new Icon($this->tag, $name, $options);
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
        if (strpos($name, "{$this->prefix}-") === 0) {
            return $name;
        }

        return "{$this->prefix}-{$name}";
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
        return trim(implode(' ', [
            $this->prefix,
            $this->parse($name),
            $extra
        ]));
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
     *
     * @return Factory
     */
    public function withTag($tag)
    {
        return new Factory($this->prefix, $tag);
    }

    /**
     * @return string
     */
    public function getTag()
    {
        return $this->tag;
    }
}
