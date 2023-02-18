@extends('template.main')

@section('content')
    @include('template.snippets.seller-header')
    @include('template.snippets.errors')

    <div class="container">
        @if($products->isNotEmpty())

            <h2>Продукты </h2>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Название</th>
                    <th scope="col">Цена</th>
                    <th scope="col">Качество</th>
                    <th scope="col">Добавлено</th>
                </tr>
                </thead>
                <tbody>
                @foreach($products as $product)
                    <tr>
                        <th scope="row">
                            <a href="{{ route('seller.product.show', $product->id) }}">{{ $product->id }}</a>
                        </th>
                        <td>{{ $product->title }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->quality }}</td>
                        <td>{{ $product->created_at }}</td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        @else
            Нет товаров, добавьте пожалуйста.
        @endif

        <div>
            @if($products->isNotEmpty())
                {{ $products->links() }}
            @endif
        </div>

    </div>

@endsection
