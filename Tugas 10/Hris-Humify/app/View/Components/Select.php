<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Select extends Component
{
    /**
     * Create a new component instance.
     *
     * @param  array<string, string>  $options
     */
    public function __construct(
        public string $label = '',
        public string $name = '',
        public string $value = '',
        public string $placeholder = '',
        public array $options = [],
    ) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.select');
    }
}
