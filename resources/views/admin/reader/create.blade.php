@extends('layouts.admin')
@section('container')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Создать чтеца</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Главная</a></li>
                            <li class="breadcrumb-item"><a href="{{route('reader.index')}}">Чтецы</a></li>
                            <li class="breadcrumb-item active">Создание чтеца</li>
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
                                <form action="{{ route('reader.store') }}" method="POST">
                                    @csrf
                                    <div class="card-body">
                                        <x-forms.input id="reader-name" placeholder="Имя чтеца" name="name" label="Имя чтеца"/>
                                        <x-forms.checkbox label="Актитивный" id="is-active-author" name="is_active"/>
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">Добавить</button>
                                    </div>
                                </form>
                            </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
