<?php

namespace App\Http\Controllers\Api;

use App\Enums\MassageEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAuthorRequest;
use App\Http\Requests\UpdateAuthorRequest;
use App\Http\Resources\AuthorResource;
use App\Models\Admin\Author;
use App\Services\TransliterationService;

class BaseApiController extends Controller
{
    public $perPage = null;
    public $page = null;

    public function __construct()
    {
        $this->perPage = request()->perPage ?? 10;
        $this->page = request()->page ?? 1;
    }
}
