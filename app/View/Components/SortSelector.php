<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SortSelector extends Component
{
    public string $title;
    public string $route;
    public array $params;
    /**
     * Create a new component instance.
     */
    public function __construct(string $title, string $route, string $sort, array $params = []) {
        $this->title = $title;
        $this->route = $route;
        $this->params = [
            array_merge($params, [$sort => 'asc']),
            array_merge($params, [$sort => 'desc'])
        ];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.sort-selector');
    }
}
