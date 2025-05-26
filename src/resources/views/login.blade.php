@extends('layouts/app')
@section('css')
<link rel="stylesheet" href="{{asset('css/login.css')}}">
@endsection

@section('button')
<div class="header__register">
    <a class="header__button" href="/register">register</a>
</div>
@endsection

@section('content')
<div class="login-form">
    <div class="login-form__heading">
        <h2>Login</h2>
    </div>
    <div class="login-form__content">
        <div class="login-form__inner">
            <form class="form" action="/admin" method="post">
                @csrf
                <div class="form__group">
                    <div class="form__group-title">
                        <span class="form__label--item">メールアドレス</span>
                    </div>
                    <div class="form__group-content">
                        <div class="form__input--text">
                            <input type="email" name="email" placeholder="例: test@example.com" value="{{old('email')}}" />
                        </div>
                        <div class="form__error">
                            @error('email')
                            {{$message}}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form__group">
                    <div class="form__group-title">
                        <span class="form__label--item">パスワード</span>
                    </div>
                    <div class="form__group-content">
                        <div class="form__input--text">
                            <input type="password" name="password" placeholder="例: coachtech1106" value="" />
                        </div>
                        <div class="form__error">
                            @error('password')
                            {{$message}}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form__group-button">
                    <button class="form__button">ログイン</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection