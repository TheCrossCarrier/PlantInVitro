<?php

namespace App\View\Components;

use Illuminate\View\Component;

class NavbarNav extends Component
{
    public $tag;

    public $scroll;

    public function __construct(
        string $tag = 'ul',
        string $scroll = null,
    )
    {
        $this->tag = $tag;
        $this->scroll = $scroll;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.navbar-nav');
    }
}
