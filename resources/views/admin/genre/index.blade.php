<?php

use \App\Enums\MassageEnum;

?>

@extends('layouts.admin')
@section('container')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Жанры</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Главная</a></li>
                            <li class="breadcrumb-item active">Жанры</li>
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
                                <a class="btn btn-success" href="{{route('genre.create')}}">Добавить</a>
                            </div>
                            <div class="card-body">
                                <x-message key={{MassageEnum::TYPE_ERROR}} />
                                <table id="example1" class="table table-bordered table-striped">
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
                                    @foreach($genres as $genre)
                                        <tr>
                                            <td>{{$genre->id}}</td>
                                            <td><a href="{{ route('genre.edit', $genre->id) }}">{{$genre->name}}</a>
                                            </td>
                                            <td>{{$genre->is_active}}</td>
                                            <td>{{$genre->created_at}}</td>
                                            <td>
                                                <form action="{{route('genre.delete', $genre->id)}}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger"><i
                                                            class="fas fa-trash nav-icon"></i></button>
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
