@php
    use App\Models\Admin\Reader;
    use \App\Enums\MassageEnum;

    /**
    * @var Reader $reader
    */
@endphp


@extends('layouts.admin')
@section('container')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Чтецы</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Главная</a></li>
                            <li class="breadcrumb-item active">Чтецы</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <a class="btn btn-success" href="{{route('reader.create')}}">Добавить</a>
                            </div>
                            <div class="card-body">
                                <x-message key={{MassageEnum::TYPE_ERROR}} />
                                <table class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Имя</th>
                                        <th>Активность</th>
                                        <th>Дата добавления</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($readers as $reader)
                                            <tr>
                                                <td>{{$reader->id}}</td>
                                                <td><a href="{{ route('reader.edit', $reader->id) }}">{{$reader->name}}</a></td>
                                                <td>{{$reader->is_active}}</td>
                                                <td>{{$reader->created_at}}</td>
                                                <td>
                                                    <form action="{{route('reader.delete', $reader->id)}}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger"><i class="fas fa-trash nav-icon"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{$readers->links('includes.backend.paginate-notification')}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
