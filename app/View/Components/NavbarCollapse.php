<?php

namespace App\View\Components;

use Illuminate\View\Component;

class NavbarCollapse extends Component
{
    public $tag;
    
    public function __construct(string $tag = 'div')
    {
        $this->tag = $tag;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.navbar-collapse');
    }
}
