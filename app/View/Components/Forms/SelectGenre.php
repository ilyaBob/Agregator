<?php

namespace App\View\Components\Forms;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SelectGenre extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $name,
        public        $id = null,
        public        $label = null,
        public        $multiple = false,
        public        $dataArray = null,
        public        $value = null,
    )
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        if ($this->multiple && $this->value) {
            $values = $this->value->pluck('id')->toArray();
        }else{
            $values = $this->value;
        }


        return view('components.forms.select-genre', compact("values"));
    }
}
