@extends('template.main')

@section('content')
    @include('template.snippets.seller-header')
    @include('template.snippets.errors')


    <div class="container">
        <form>
            @csrf
            <div class="mb-3">
                <label for="product_title" class="form-label">Название продукта</label>
                <input type="text" value="{{ $product->title }}" class="form-control" id="product_title"
                       aria-describedby="emailHelp">
            </div>

            <div class="mb-3">
                <label for="max_price" class="form-label">Цена</label>
                <input type="number" value="{{ $product->price }}" class="form-control" id="max_price">
            </div>
            <div class="mb-3">
                <label for="quality" class="form-label">Качество</label>
                <br>
                {{-- Можно потом доработать беря значения из Enum--}}
                <select>
                    <option selected>{{ $product->quality }}</option>
                </select>
            </div>
        </form>
    </div>

    @if($requests->isNotEmpty())
        <div class="container">
            <h2>Запросы пользователей</h2>
            <br>

            @foreach($requests as $request)
                <div class="d-flex position-relative" style="border: 1px solid grey; padding: 5px;">
                    <div>
                        <h5 class="mt-0">{{ $request->product_title }} (Id-пользователя: {{ $request->consumer_id }})</h5>
                        <p>
                            Мин. цена: {{ $request->min_price }}<br>
                            Макс.: {{ $request->max_price }} <br>
                            Качество: {{ $request->product_quality }}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endsection
