<?php
/**
* @var $book \App\Models\Admin\Book
*/
?>

@extends('layouts.admin')
@section('container')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Книги</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Главная</a></li>
                            <li class="breadcrumb-item active">Книги</li>
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
                                <a class="btn btn-success" href="{{route('book.create')}}">Добавить</a>
                            </div>
                            <div class="card-body">
                                <table id="" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Имя</th>
                                        <th>Цикл</th>
                                        <th>Активность</th>
                                        <th>Дата добавления</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($books as $book)
                                            <tr>
                                                <td>{{$book->id}}</td>
                                                <td><a href="{{ route('book.edit', $book->id) }}">{{$book->title}}</a></td>
                                                <td>
                                                    @if($book->cycle)
                                                        {{$book->cycle->name}}
                                                    @else
                                                        Без цикла
                                                    @endif
                                                </td>
                                                <td>{{$book->is_active}}</td>
                                                <td>{{$book->created_at}}</td>
                                                <td>
                                                    <form action="{{route('book.delete', $book->id)}}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger"><i class="fas fa-trash nav-icon"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
