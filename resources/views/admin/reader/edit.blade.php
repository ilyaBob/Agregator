@extends('layouts.admin')
@section('container')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Измененить чтеца</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Главная</a></li>
                            <li class="breadcrumb-item"><a href="{{route('reader.index')}}">Чтецы</a></li>
                            <li class="breadcrumb-item active">Изменение чтеца</li>
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
                        <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Заполните форму</h3>
                                </div>
                                <form action="{{ route('reader.update', $reader->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="reader-name">Имя чтеца</label>
                                            <input type="text" name="name" class="form-control" id="reader-name" placeholder="Имя чтеца" value="{{ $reader->name }}">

                                        </div>
                                        <div class="form-check">
                                            <input name="is_active" type="checkbox" class="form-check-input" id="is-active-reader"
                                                    value="1" {{$reader->is_active? 'checked': false}} >
                                            <label class="form-check-label" for="is-active-reader">Актитивный</label>
                                        </div>
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