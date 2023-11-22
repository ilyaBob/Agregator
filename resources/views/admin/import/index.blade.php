@extends('layouts.admin')
@section('container')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Импорт/Экспорт</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Главная</a></li>
                            <li class="breadcrumb-item active">(Импорт/Экспорт)</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <section class="content row">
            <div class="container-fluid col-6">
                <div class="row">
                    <div class="col-12">
                        <div class="card card-success">
                            <div class="card-header">
                                <h3 class="card-title">Импортировать файл</h3>
                            </div>
                            <form action="{{ route('import.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="card-body">
                                    <x-forms.image name="file_import" label="Файл" id="file_import" />
                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-success">Импорт</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid col-6">
                <div class="row">
                    <div class="col-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Экспорт файла</h3>
                            </div>
                            <form action="{{ route('import.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="card-body">
                                    <x-forms.input name="file_ext" label="Расширение файла" id="file_ext" placeholder="Пока только в экселе😊 поле для красоты. Тык на кнопку..." />
                                </div>

                                <div class="card-footer">
                                    <a href="{{route('import.export')}}" class="btn btn-primary">Добавить</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection
