<?php
namespace Digbang\Fonts;

use Illuminate\Support\Traits\Macroable;

class FontManager
{
    use Macroable;

    const FONT_AWESOME    = 'fa';
    const MATERIAL_DESIGN = 'zmdi';

    /**
     * @var string
     */
    private $defaultTag = 'i';

    /**
     * @var Factory[]
     */
    private $factories = [];

    /**
     * @var string
     */
    private $defaultLibrary;

    /**
     * @param string $defaultLibrary
     */
    public function __construct($defaultLibrary)
    {
        $this->defaultLibrary = $defaultLibrary;
    }

    /**
     * Create a FontAwesome icon.
     *
     * @return Factory
     */
    public function fa()
    {
        return $this->create(self::FONT_AWESOME);
    }

    /**
     * Create a Material Design icon.
     *
     * @return Factory
     */
    public function mat()
    {
        return $this->create(self::MATERIAL_DESIGN);
    }

    /**
     * @param string $prefix
     *
     * @return Factory
     */
    public function create($prefix)
    {
        return $this->factories[$prefix] ?? $this->factories[$prefix] = new Factory($prefix, $this->defaultTag);
    }

    /**
     * @param string $name
     * @param array $options
     *
     * @return Icon
     */
    public function icon($name, $options = [])
    {
        return $this->create($this->defaultLibrary)->icon($name, $options);
    }

    /**
     * @return string
     */
    public function getDefaultTag()
    {
        return $this->defaultTag;
    }

    /**
     * @param string $tag
     */
    public function setDefaultTag($tag)
    {
        $this->defaultTag = $tag;
    }

    /**
     * @return string
     */
    public function getDefaultLibrary()
    {
        return $this->defaultLibrary;
    }

    /**
     * @param string $defaultLibrary
     */
    public function setDefaultLibrary($defaultLibrary)
    {
        $this->defaultLibrary = $defaultLibrary;
    }
}
