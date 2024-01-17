<?php

namespace App\View\Components;

use App\Models\Admin\Book;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TopWeek extends Component
{
    public function render(): View|Closure|string
    {
        $topBook = Book::query()
            ->with('genres')
            ->join('top', 'books.id', '=', 'top.top_week_book_id')
            ->whereNotNull('top_week_book_id')
            ->limit(6)
            ->get();

        return view('components.top-week', compact('topBook'));
    }
}
