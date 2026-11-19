<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Table extends Component
{
    /**
     * Create a new component instance.
     *
     * @param  list<string>  $columns
     */
    public function __construct(
        public string $title = '',
        public string $subtitle = '',
        public string $link = '',
        public string $linkLabel = '',
        public array $columns = [],
    ) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.table');
    }
}
