<?php
    use \App\Models\Admin\Notification;
    use \App\Enums\NotificationEnum;

    /**
     * @var Notification $notification
    */
?>
@extends('layouts.admin')
@section('container')
    <div class="content-wrapper">
        <section class="content mt-3">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-12">
                        <div class="card @if($notification->type == NotificationEnum::TYPE_LOGS){{
                        'card-orange'
                    }}@elseif($notification->type == NotificationEnum::TYPE_MESSAGE){{
                        'card-success'
                    }}@elseif($notification->type == NotificationEnum::TYPE_ERROR){{
                        'card-danger'
                    }}@else{{
                        'card-primary'
                    }}@endif card-outline">
                            <div class="card-header">
                                <h3 class="card-title">
                                    {{NotificationEnum::getTypeList()[$notification->type]}}
                                </h3>
                                <div class="card-tools">
                                    <a href="#" class="btn btn-tool" title="Previous"><i class="fas fa-chevron-left"></i></a>
                                    <a href="#" class="btn btn-tool" title="Next"><i class="fas fa-chevron-right"></i></a>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="mailbox-read-info">
                                    <h5>{{$notification->title}}</h5>
                                        <span class="mailbox-read-time float-right">{{$notification->created_at}}</span></h6>
                                </div>
                                <div class="mailbox-controls with-border text-center">
                                    <div class="btn-group">

                                        <form action="{{route('notification.destroy', $notification->id)}}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-default btn-sm" data-container="body" title="Delete">
                                                <i class="far fa-trash-alt"></i>
                                            </button>
                                        </form>

                                        <button type="button" class="btn btn-default btn-sm" data-container="body" title="Reply">
                                            <i class="fas fa-reply"></i>
                                        </button>
                                        <button type="button" class="btn btn-default btn-sm" data-container="body" title="Forward">
                                            <i class="fas fa-share"></i>
                                        </button>
                                    </div>
                                    <button type="button" class="btn btn-default btn-sm" title="Print">
                                        <i class="fas fa-print"></i>
                                    </button>
                                </div>
                                <div class="mailbox-read-message">
                                    {!!  $notification->description !!}
                                </div>
                            </div>

                            <div class="card-footer">
                                <div class="float-right">
                                    <button type="button" class="btn btn-default"><i class="fas fa-reply"></i> Reply</button>
                                    <button type="button" class="btn btn-default"><i class="fas fa-share"></i> Forward</button>
                                </div>
                                <form action="{{route('notification.destroy', $notification->id)}}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-default"><i class="far fa-trash-alt"></i> Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
