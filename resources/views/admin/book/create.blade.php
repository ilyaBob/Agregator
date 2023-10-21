@extends('layouts.admin')
@section('container')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Создать книгу</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Главная</a></li>
                            <li class="breadcrumb-item"><a href="{{route('book.index')}}">Книги</a></li>
                            <li class="breadcrumb-item active">Создание книги</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card card-success">
                            <div class="card-header">
                                <h3 class="card-title">Заполните форму</h3>
                            </div>
                            <form action="{{ route('book.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">

                                    <x-forms.input name="title" label="Название книги" id="book-name" placeholder="Название книги" />
                                    <x-forms.input name="link_to_original" label="Ссылка на оригинал" id="link_to_original" placeholder="Ссылка на оригинал" />
                                    <x-forms.checkbox name="is_active" label="Актитивный" id="is-active-book"/>
                                    <x-forms.textarea name="description" id="description" label="Описание"/>

                                    <x-forms.image name="image" id="image-file" label="Картинка" />

                                    <x-forms.input name="age" label="Год написания" id="book-age" placeholder="Год написания" />
                                    <x-forms.input name="cycle_number" label="Номер в цикле" id="book-cycle_number" placeholder="Номер в цикле" />
                                    <x-forms.input name="time" label="Время проигрывания" id="book-time" placeholder="Время проигрывания" />

                                    <x-forms.select name="cycle_id" label="Циклы" :dataArray="$cycles" />
                                    <x-forms.select-genre name="genre_slug" label="Выберите основной жанр(изменить будет нельзя)" :dataArray="$genres" />

                                    <x-forms.select name="authors" label="Авторы" :multiple="true" :dataArray="$authors" />
                                    <x-forms.select name="readers" label="Чтецы" :multiple="true" :dataArray="$readers" />
                                    <x-forms.select name="genres" label="Жанры" :multiple="true" :dataArray="$genres" />


                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Добавить</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
