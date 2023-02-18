<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\Request\CreateRequest;
use App\Models\Product;
use App\Models\Request;
use Illuminate\Support\Facades\Auth;

final class RequestController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $requests = Request::query()
            ->where('consumer_id', '=', $userId)
            ->paginate(20);

        return view('user.main', compact('requests'));
    }

    public function show($id)
    {
        $userId = Auth::id();

        $request = Request::query()
            ->where('consumer_id', '=', $userId)
            ->findOrFail($id);


        $products = Product::query()
            ->where('title', 'LIKE', '%' . $request->product_title . '%')
            ->where('quality', '=', $request->product_quality)
            ->where('price', '>=', $request->min_price)
            ->where('price', '<=', $request->max_price)
            ->get();

        return view('user.request.show', compact('products', 'request'));
    }


    public function create()
    {
        return view('user.request.add');
    }


    public function store(CreateRequest $request)
    {
        $title = $request->input('title');
        $minPrice = $request->input('min_price');
        $maxPrice = $request->input('max_price');
        $quality = $request->input('quality');

        $userId = Auth::id();

        try {
            Request::query()
                ->create([
                    'consumer_id' => $userId,
                    'product_title' => $title,
                    'min_price' => $minPrice,
                    'max_price' => $maxPrice,
                    'product_quality' => $quality,
                ]);
        } catch (\Exception $exception) {
            return back()
                ->withErrors(['Не удалось добавить, произошла ошибка, пожалуйста повторите попытку позднее']);
        }

        return redirect()
            ->route('user.main');
    }
}
