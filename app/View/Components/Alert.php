<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Alert extends Component
{
    public $type;

    public $noicon;

    public function __construct(string $type, bool $noicon = false)
    {
        $this->type = $type;
        $this->noicon = $noicon;
    }

    public function render()
    {
        return view('components.alert');
    }
}
