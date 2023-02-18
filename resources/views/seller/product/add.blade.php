@extends('template.main')

@section('content')
    @include('template.snippets.seller-header')
    @include('template.snippets.errors')

    <div class="container">
        <form method="POST" action="{{ route('seller.product.add.store') }}">
            @csrf
            <div class="mb-3">
                <label for="product_title" class="form-label">Название продукта</label>
                <input type="text" name="title" class="form-control" required id="product_title" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="max_price" class="form-label">Цена</label>
                <input type="number" name="price" class="form-control" id="max_price" required>
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
            <button type="submit" class="btn btn-primary">Добавить товар</button>
        </form>
    </div>

@endsection
