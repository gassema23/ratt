<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AppTwoSectionLayout extends Component
{
    public string $title;
    public string $subtitle;
    public array $action;
    public function __construct(string $title = '', string $subtitle = '', $action = [])
    {
        $this->title = $title;
        $this->subtitle = $subtitle;
        $this->action = $action;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('twosection.app');
    }
}
