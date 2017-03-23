<?php
namespace Digbang\Fonts;

/**
 * @method static Factory fa()
 * @method static Factory mat()
 * @method static \Illuminate\Support\HtmlString|string icon(string $name, array $options = [])
 * @method static Factory create(string $prefix)
 * @method static void setTag(string $tag)
 * @method static string getTag()
 */
class Facade extends \Illuminate\Support\Facades\Facade
{
    protected static function getFacadeAccessor()
    {
        return FontManager::class;
    }
}
