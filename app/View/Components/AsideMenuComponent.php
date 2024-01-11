<?php

namespace App\View\Components;

use App\Models\Admin\Genre;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AsideMenuComponent extends Component
{
    public function render(): View|Closure|string
    {
        $genres = Genre::getGenres();

        return view('components.aside-menu-component', compact('genres'));
    }
}
