<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FormControl extends Component
{
    public $name;

    public $type;

    public $novalidate;

    public function __construct(
        string $name,
        string $type = 'text',
        bool $novalidate = false,
    ) {
        $this->name = $name;
        $this->type = $type;
        $this->novalidate = $novalidate;
    }

    public function render()
    {
        return view('components.form-control');
    }
}
