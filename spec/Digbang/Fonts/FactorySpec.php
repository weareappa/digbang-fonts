<?php
namespace spec\Digbang\Fonts;

use Digbang\Fonts\Factory;
use Digbang\Fonts\Icon;
use Illuminate\Contracts\Support\Htmlable;
use PhpSpec\ObjectBehavior;

/**
 * @mixin Factory
 */
class FactorySpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith('fa');
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(Factory::class);
    }

    public function it_should_give_me_an_icon()
    {
        $this->icon('times')->shouldMatch('/class="[^"]*fa fa-times[^"]*"/');
        $this->icon('fa-times')->shouldMatch('/class="[^"]*fa fa-times[^"]*"/');
        $this->icon('times', ['class' => 'fa-bigger'])->shouldMatch('/class="[^"]*fa fa-times[^"]* fa-bigger[^"]*"/');
        $this->icon('fa-times', 'fa-bigger')->shouldMatch('/class="[^"]*fa fa-times[^"]* fa-bigger[^"]*"/');
    }

    public function it_should_let_me_change_the_tag()
    {
        $this->withTag('span')->icon('times')->shouldMatch('/^<span/');
    }

    public function it_should_return_an_htmlable_object()
    {
        $this->icon('foo')->shouldBeAnInstanceOf(Htmlable::class);
    }

    public function it_should_return_an_html_string_object()
    {
        $this->icon('foo')->shouldBeAnInstanceOf(Icon::class);
    }

    public function getMatchers()
    {
        return [
            'match' => function ($subject, $argument) {
                return preg_match($argument, (string) $subject) > 0;
            },
        ];
    }
}
