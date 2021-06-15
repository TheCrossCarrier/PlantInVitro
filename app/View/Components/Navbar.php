<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Navbar extends Component
{
    public $type;

    public $expand;

    public $tag;

    public function __construct(
        string $type = null,
        string $expand = null,
        string $tag = 'div',
    )
    {
        $this->type = $type;
        $this->expand = $expand;
        $this->tag = $tag;
    }

    public function render()
    {
        return view('components.navbar');
    }
}
