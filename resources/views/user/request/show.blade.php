@extends('template.main')

@section('content')
    @include('template.snippets.header')
    @include('template.snippets.errors')


    <div class="container">
        <form>
            @csrf
            <div class="mb-3">
                <label for="product_title" class="form-label">Название продукта</label>
                <input type="text" value="{{ $request->product_title }}" class="form-control" id="product_title"
                       aria-describedby="emailHelp">
            </div>

            <div class="mb-3">
                <label for="max_price" class="form-label">Мин. цена</label>
                <input type="number" value="{{ $request->min_price }}" class="form-control" id="max_price">
            </div>

            <div class="mb-3">
                <label for="max_price" class="form-label">Цена</label>
                <input type="number" value="{{ $request->max_price }}" class="form-control" id="max_price">
            </div>
            <div class="mb-3">
                <label for="quality" class="form-label">Качество</label>
                <br>
                {{-- Можно потом доработать беря значения из Enum--}}
                <select>
                    <option selected>{{ $request->product_quality }}</option>
                </select>
            </div>
        </form>
    </div>

    @if($products->isNotEmpty())
        <div class="container">
            <h2>Похожие товары</h2>
            <br>

            @foreach($products as $product)
                <div class="d-flex position-relative" style="border: 1px solid grey; padding: 5px;">
                    <div>
                        <h5 class="mt-0">{{ $product->title }} (Id-продавца: {{ $product->seller_id }})</h5>
                        <p>
                            Цена: {{ $product->price }}<br>
                            Качество: {{ $product->quality }}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endsection
