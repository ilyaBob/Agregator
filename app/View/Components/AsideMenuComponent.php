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
        $data = [];
        $genres = Genre::getGenres();

        /** @var Genre $genre */
        foreach ($genres as $genre) {
            $parentId = $genre->parent_id ?? $genre->id;
            $data[$parentId][] = [
                'name' => $genre->name,
                'slug' => $genre->slug,
                'parent_id' => $genre->parent_id,
            ];
        }

        return view('components.aside-menu-component', compact('data'));
    }
}
