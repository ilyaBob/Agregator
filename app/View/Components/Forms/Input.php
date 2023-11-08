<?php

namespace App\View\Components\Forms;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Input extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $name,
        public $placeholder = null,
        public $id = null,
        public $label = null,
        public $type = "text",
        public $value = null,
        public $class = null,
        public $disabled = null,
        public $formClass = null,
        public $multiple = false,
    )
    {
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.forms.input');
    }
}
