<?php
use App\Models\Admin\Notification;
use App\Enums\NotificationEnum;

$countNotification = Notification::getCountNotification();
$countMessage = Notification::getCountMessage();
$countErrors = Notification::getCountErrors();
$countLogs = Notification::getCountLogs();
?>

<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{route('admin.index')}}" class="nav-link">Главная</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link">Contact</a>
        </li>
    </ul>

    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                <i class="fas fa-search"></i>
            </a>
            <div class="navbar-search-block">
                <form class="form-inline">
                    <div class="input-group input-group-sm">
                        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-navbar" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                            <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </li>

        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-bell"></i>
                @if($countNotification != 0)
                    <span class="badge badge-warning navbar-badge">{{ $countNotification }}</span>
                @endif
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <a href="{{ route('notification.index', ['type' => NotificationEnum::TYPE_MESSAGE]) }}" class="dropdown-item">
                    <i class="fas fa-envelope mr-2"></i>Новых сообщений
                    <span class="float-right text-muted text-sm">{{$countMessage}}</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="{{ route('notification.index', ['type' => NotificationEnum::TYPE_ERROR]) }}" class="dropdown-item">
                    <i class="fas fa-users mr-2"></i> Новые ошибки
                    <span class="float-right text-muted text-sm">{{$countErrors}}</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="{{ route('notification.index', ['type' => NotificationEnum::TYPE_LOGS]) }}" class="dropdown-item">
                    <i class="fas fa-file mr-2"></i> Новые логи
                    <span class="float-right text-muted text-sm">{{$countLogs}}</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="{{ route('notification.index') }}" class="dropdown-item dropdown-footer">Показать все уведомления</a>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
    </ul>
</nav>
