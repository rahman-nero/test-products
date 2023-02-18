@extends('template.main')

@section('content')
    @include('template.snippets.header')
    @include('template.snippets.errors')


    <div class="container">
        <form method="POST" action="{{ route('user.request.add.store') }}">
            @csrf
            <div class="mb-3">
                <label for="product_title" class="form-label">Название продукта</label>
                <input type="text" name="title" class="form-control" id="product_title" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="min_price" class="form-label">Минимальная цена</label>
                <input type="number" name="min_price" class="form-control" id="min_price">
            </div>
            <div class="mb-3">
                <label for="max_price" class="form-label">Максимальная цена</label>
                <input type="number" name="max_price" class="form-control" id="max_price">
            </div>
            <div class="mb-3">
                <label for="quality" class="form-label">Качество</label>
                <br>
                {{-- Можно потом доработать беря значения из Enum--}}
                <select name="quality" id="quality">
                    <option value="new" selected>Новый</option>
                    <option value="used">Использованный</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Добавить</button>
        </form>
    </div>

@endsection
