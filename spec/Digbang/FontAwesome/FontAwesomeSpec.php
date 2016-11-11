<?php
namespace spec\Digbang\FontAwesome;

use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\HtmlString;
use PhpSpec\ObjectBehavior;

/**
 * @mixin \Digbang\FontAwesome\FontAwesome
 */
class FontAwesomeSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('Digbang\FontAwesome\FontAwesome');
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
		$this->setTag('span');

		$this->icon('times')->shouldMatch('/^<span/');
	}

    public function it_should_return_an_htmlable_object()
    {
        $this->icon('foo')->shouldBeAnInstanceOf(Htmlable::class);
	}

    public function it_should_return_an_html_string_object()
    {
        $this->icon('foo')->shouldBeAnInstanceOf(HtmlString::class);
	}

	public function getMatchers()
	{
		return [
			'match' => function($subject, $argument) {
				return preg_match($argument, $subject) > 0;
			}
		];
	}
}
