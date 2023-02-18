@extends('template.main')

@section('content')
    @include('template.snippets.header')
    @include('template.snippets.errors')

    <div class="container">
        @if($requests->isNotEmpty())

            <table class="table">
                <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Название</th>
                    <th scope="col">Цена (от-до)</th>
                    <th scope="col">Добавлено</th>
                </tr>
                </thead>
                <tbody>
                @foreach($requests as $request)
                    <tr>
                        <th scope="row"><a href="{{ route('user.request.show', $request->id) }}">{{ $request->id }}</a></th>
                        <td>{{ $request->product_title }}</td>
                        <td>От: {{ $request->min_price }}, до {{ $request->max_price }} </td>
                        <td>{{ $request->create_at }}</td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        @else
            Нет запросов, добавьте пожалуйста.
        @endif

        <div>
            @if($requests->isNotEmpty())
                {{ $requests->links() }}
            @endif
        </div>

    </div>

@endsection
