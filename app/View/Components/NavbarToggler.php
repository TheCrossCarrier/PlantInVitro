<?php

namespace App\View\Components;

use Illuminate\View\Component;

class NavbarToggler extends Component
{
    public $target;

    public function __construct(string $target)
    {
        $this->target = $target;
    }

    public function render()
    {
        return view('components.navbar-toggler');
    }
}
