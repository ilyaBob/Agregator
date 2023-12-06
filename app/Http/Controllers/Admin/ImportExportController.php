<?php

namespace App\Http\Controllers\Admin;

use App\Exports\BookExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\ImportRequest;
use App\Imports\BookImport;
use Maatwebsite\Excel\Facades\Excel;

class ImportExportController extends Controller
{
    public function index()
    {
        return view('admin.import.index');
    }

    public function store(ImportRequest $request)
    {
        Excel::import(new BookImport, $request->file('file_import'));

        return redirect()->route('import.index');
    }

    public function export()
    {
        return Excel::download(new BookExport(), 'books.xlsx');
    }

}
