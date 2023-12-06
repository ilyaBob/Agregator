@php
    use \App\Models\Admin\Notification;
    use \App\Enums\NotificationEnum;

    /**
     * @var Notification $notification
     */
@endphp
@extends('layouts.admin')
@section('container')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Уведомления</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Главная</a></li>
                            <li class="breadcrumb-item active">Уведомления</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Вкладки</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <ul class="nav nav-pills flex-column">
                                <li class="nav-item">
                                    <a href="{{route('notification.index')}}" class="nav-link">
                                        <i class="far fa-envelope"></i> Все уведомления
                                    </a>
                                </li>
                                @foreach(NotificationEnum::getTypeList() as $key => $type)
                                    <li class="nav-item">
                                        <a href="{{route('notification.index')."?type=$key"}}" class="nav-link">
                                            <i class="far fa-envelope"></i> {{$type}}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-md-9">
                    <div class="card  @if(request()->type == NotificationEnum::TYPE_LOGS){{
                        'card-orange'
                    }}@elseif(request()->type == NotificationEnum::TYPE_MESSAGE){{
                        'card-success'
                    }}@elseif(request()->type == NotificationEnum::TYPE_ERROR){{
                        'card-danger'
                    }}@else{{
                        'card-primary'
                    }}@endif card-outline">
                        <div class="card-header">
                            <h3 class="card-title">{{request()->type?NotificationEnum::getTypeList()[request()->type]: "Все уведомления"}}</h3>
                        </div>
                        <div class="card-body p-0">

                            <div class="table-responsive mailbox-messages">
                                <table class="table table-hover table-striped">
                                    <tbody>
                                    @foreach($notifications as $notification)
                                        <tr>
                                            <td>
                                                <div class="icheck-primary">
                                                    <input type="checkbox" value="" id="check_{{$notification->id}}">
                                                    <label for="check_{{$notification->id}}"></label>
                                                </div>
                                            </td>
                                            <td class="mailbox-star"><a href="#"><i
                                                        class="@if($notification->is_new) fas fa-star @endif  text-warning"></i></a>
                                            </td>
                                            <td class="mailbox-name"><a
                                                    href="{{ route('notification.show', $notification->id) }}">{{ mb_strimwidth($notification->title, 0, 30,'...')}}</a>
                                            </td>
                                            <td class="mailbox-subject">{{ mb_strimwidth($notification->description, 0, 50,'...')}}</td>
                                            <td class="mailbox-date">{{$notification->created_at}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer p-0">
                            <div class="mailbox-controls">
                                <button type="button" class="btn btn-default btn-sm checkbox-toggle">
                                    <i class="far fa-square"></i>
                                </button>
                                <div class="btn-group ">
                                    <button type="button" class="btn btn-default btn-sm">
                                        <i class="far fa-trash-alt"></i>
                                    </button>
                                </div>

                                <div class="float-right">
                                    {{$notifications->withQueryString()->links('includes.backend.paginate-notification')}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
