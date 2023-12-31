<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{route('admin.index')}}" class="brand-link">
        <img src="{{asset('dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="info">
                <a href="#" class="d-block">{{auth()->user()->email}}</a>
            </div>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-header">Книги</li>
                <li class="nav-item">
                    <a href="{{route('book.index')}}" class="nav-link">
                        <i class="nav-icon far fa-image"></i>
                        <p>Книги</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('author.index')}}" class="nav-link">
                        <i class="nav-icon far fa-image"></i>
                        <p>Автор</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('reader.index')}}" class="nav-link">
                        <i class="nav-icon far fa-image"></i>
                        <p>Чтец</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('genre.index')}}" class="nav-link">
                        <i class="nav-icon far fa-image"></i>
                        <p>Жанры</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('cycle.index')}}" class="nav-link">
                        <i class="nav-icon far fa-image"></i>
                        <p>Циклы книг</p>
                    </a>
                </li>
                <li class="nav-header">Авто добавление</li>
                <li class="nav-item">
                    <a href="{{route('add-one.index')}}" class="nav-link">
                        <i class="nav-icon far fa-image"></i>
                        <p>Добавить</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('import.index')}}" class="nav-link">
                        <i class="nav-icon far fa-image"></i>
                        <p>Импорт/Экспорт</p>
                    </a>
                </li>

                <li class="nav-header">Уведомления</li>
                <li class="nav-item">
                    <a href="{{route('notification.index')}}" class="nav-link">
                        <i class="nav-icon far fa-image"></i>
                        <p>Уведомления</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
