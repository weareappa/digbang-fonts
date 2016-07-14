<?php
namespace Digbang\FontAwesome;

use Collective\Html\HtmlBuilder;

/**
 * Class FontAwesome
 */
class FontAwesome
{
    /**
     * @type string
     */
    private $tag = 'i';
    
    /**
     * @type HtmlBuilder
     */
    private $htmlBuilder;
    
    /**
     * @param HtmlBuilder $htmlBuilder
     */
    public function __construct(HtmlBuilder $htmlBuilder)
    {
        $this->htmlBuilder = $htmlBuilder;
    }
    
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
        
        $options['class'] = $this->getClasses($name, array_pull($options, 'class'));
        
        return $this->openTag($this->htmlBuilder->attributes($options)) . $this->closeTag();
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
        if (substr($name, 0, 3) == 'fa-')
        {
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
}
