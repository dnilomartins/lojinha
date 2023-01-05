<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    public function index()
    {
        return Product::all();
    }

    public function show(Product $product)
    {
        return $product;
    }

    public function store(StoreProductRequest $request)
    {
        $product = $request->validated();
        return Product::create($product);
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->update($request->validated());
        return $product;
    }

    public function destroy(Product $product)
    {
        $response = $product->delete();
        return response()->json([
            'message' =>$response ? 'Produto deletado com sucesso!' : 'Erro ao deletar produto!'
        ], $response ? 204: 500);
    }
}