<?php

namespace App\View\Components;

use Illuminate\View\Component;

class TagInput extends Component
{

    private $value;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($value = "")
    {
        $this->value = $value;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.tag-input', ['value' => $this->value]);
    }
}
