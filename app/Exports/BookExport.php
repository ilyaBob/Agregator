<?php

namespace App\Exports;

use App\Models\Admin\Book;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BookExport implements FromArray, WithHeadings
{

    public function headings(): array
    {
        return [
            'title',
            'image',
            'description',
            'is_active',
            'age',
            'time',
            'cycle_number',
            'link_to_original',
            'authors',
            'readers',
            'genres',
            'files',
            'cycle'
        ];
    }

    public function array(): array
    {
        $books = Book::with('authors', 'readers', 'genres', 'files')->get();

        $data = [];

        /** @var Book $book */
        foreach ($books as $book) {
            $data[] = [
                'title' => $book->title,
                'image' => $book->image,
                'description' => $book->description,
                'is_active' => $book->is_active,
                'age' => $book->age,
                'time' => $book->time,
                'cycle_number' => $book->cycle_number,
                'link_to_original' => $book->link_to_original,
                'authors' => $book->authors->pluck('name')->implode(', '),
                'readers' => $book->readers->pluck('name')->implode(', '),
                'genres' => $book->genres->pluck('name')->implode(', '),
                'files' => $book->files->pluck('file')->implode(', '),
                'cycle' => $book->cycle->name,
            ];
        }

        return $data;
    }

}
