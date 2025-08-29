<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController
{
    public function index(Request $request)
    {

        $query = Product::query();

        if ($request->has('category')) {
            $query->where('category', $request->input('category'));
        }

        if ($request->has('price_min')) {
            $query->where('price', '>=', $request->input('price_min'));
        }
        if ($request->has('price_max')) {
            $query->where('price', '<=', $request->input('price_max'));
        }


        $products = $query->get();

        return response()->json($products);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'category' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $product = Product::create($request->all());
        return response()->json($product);
    }

    public function show(Product $product)
    {
        $product->load('comments.user');
        return response()->json($product);
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'category' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $product->update($request->all());
        return response()->json($product);
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json(null, 204);
    }
}
