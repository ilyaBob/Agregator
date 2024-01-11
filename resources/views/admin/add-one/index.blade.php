@extends('layouts.admin')
@section('container')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Добавить книгу</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Главная</a></li>
                            <li class="breadcrumb-item active">Добавить книгу</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card card-success">
                            <div class="card-header">
                                <h3 class="card-title">Заполните форму</h3>
                            </div>
                            <form action="{{ route('add-one.store') }}" method="POST">
                                @csrf
                                <div class="card-body">

                                        <x-forms.input name="url" formClass="form-url" :multiple="true" label="Ссылка на оригинал" id="url" placeholder="https://fantworld.net/7463-kodeks-ohotnika-kniga-1-jurij-vinokurov-oleg-sapfir.html"/>

                                    <button id="add-url-book" class="btn btn-primary" type="button">Добавить поле для ссылки</button>

                                </div>


                                <div class="card-footer">
                                    <button type="submit" class="btn btn-success">Добавить</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card card-cyan">
                            <div class="card-header">
                                <h3 class="card-title">Заполнить все ссылки со страници</h3>
                            </div>
                            <form action="{{ route('add-one.store-all') }}" method="POST">
                                @csrf
                                <div class="card-body">
                                    <x-forms.input name="url" formClass="form-url" :multiple="true" label="Ссылка на страницу" id="url" placeholder="https://fantbook.org/page/3/"/>
                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-success">Добавить</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
