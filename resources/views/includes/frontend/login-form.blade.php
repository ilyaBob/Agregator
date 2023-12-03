@if( !auth()->user() )
    <div class="overlay" style="display: none;"></div>
    <div class="login login--not-logged d-none" style="display: none;">
        <div class="login__header d-flex jc-space-between ai-center">
            <div class="login__title stretch-free-width ws-nowrap">Войти <a href="{{ route('register') }}">Регистрация</a></div>
            <div class="login__close"><span class="fal fa-times"></span></div>
        </div>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="login__content">
                <div class="login__row">
                    <div class="login__caption">Логин:</div>
                    <div class="login__input">
                        <input type="text" name="email" id="login_name" placeholder="Ваш логин">
                    </div>
                    <span class="fal fa-user"></span>
                </div>
                <div class="login__row">
                    <div class="login__caption">Пароль: <a href="https://fantbook.org/index.php?do=lostpassword">Забыли пароль?</a></div>
                    <div class="login__input"><input type="password" name="password" id="login_password" placeholder="Ваш пароль"></div>
                    <span class="fal fa-lock"></span>
                </div>
                @error('password')
                <span class="invalid-feedback" role="alert">  <strong>{{ $message }}</strong> </span>
                @enderror
                <div class="login__row">
                    <button onclick="submit();" type="submit" title="Вход">Войти на сайт</button>
                    <input name="login" type="hidden" id="login" value="submit">
                </div>
            </div>
        </form>
    </div>
@endif
