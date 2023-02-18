<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Http\Requests\Seller\Product\CreateRequest;
use App\Models\Product;
use App\Models\Request;
use Illuminate\Support\Facades\Auth;

final class ProductsController extends Controller
{

    public function index()
    {
        $id = Auth::id();

        $products = Product::query()
            ->where('seller_id', '=', $id)
            ->paginate(20);

        return view('seller.main', compact('products'));
    }

    public function show(int $id)
    {
        $userId = Auth::id();

        $product = Product::query()
            ->where('seller_id', '=', $userId)
            ->findOrFail($id);


        $requests = Request::query()
            ->where('product_title', 'LIKE', '%' . $product->title . '%')
            ->where('product_quality', '=', $product->quality)
            ->where('max_price', '>=', $product->price)
            ->where('min_price', '<=', $product->price)
            ->get();

        return view('seller.product.show', compact('product', 'requests'));
    }

    public function create()
    {
        return view('seller.product.add');
    }

    public function store(CreateRequest $request)
    {
        $title = $request->input('title');
        $price = $request->input('price');
        $quality = $request->input('quality');

        $userId = Auth::id();

        try {
            Product::query()
                ->create([
                    'seller_id' => $userId,
                    'title' => $title,
                    'price' => $price,
                    'quality' => $quality,
                ]);
        } catch (\Exception $exception) {
            return back()
                ->withErrors(['Не удалось добавить товар, произошла ошибка, пожалуйста повторите попытку позднее']);
        }

        return redirect()
            ->route('seller.main');
    }
}

