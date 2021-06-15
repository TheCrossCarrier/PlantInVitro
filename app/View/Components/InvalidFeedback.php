<?php

namespace App\View\Components;

use Illuminate\View\Component;

class InvalidFeedback extends Component
{
    public $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function render()
    {
        return view('components.invalid-feedback');
    }
}
