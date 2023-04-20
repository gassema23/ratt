<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class AppLayout extends Component
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
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        return view('layouts.app');
    }
}
