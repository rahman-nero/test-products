@extends('template.main')


@section('content')

    @include('template.snippets.seller-header')
    @include('template.snippets.errors')

    <div class="container">
        <form method="POST" action="{{ route('seller.register.store') }}">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Имя</label>
                <input type="text" name="name" class="form-control" id="name" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Почта (Email)</label>
                <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Пароль</label>
                <input type="password" name="password" class="form-control" id="password">
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Подтвердите пароль</label>
                <input type="password" name="password_confirmation" class="form-control" id="password">
            </div>
            <button type="submit" class="btn btn-primary">Войти</button>
        </form>
    </div>

@endsection
