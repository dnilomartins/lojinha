<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Requests\StoreOrderRequest;

class OrderController extends Controller
{
    public function index()
    {
        return Order::all();
    }

    public function store(StoreOrderRequest $request)
    {
        $order = $request->validated();
        return Order::create($order);
    }

    public function show(Order $order)
    {
        return $order;
    }

    public function updated(Request $request, Order $order)
    {
        $order->updated($request->validated());
        return $order;
    }

    public function destroy(Order $order)
    {
        $response = $order->delete();

        return response()->json([
            'message' => $response ? 'Order deletada com sucesso!' : 'Erro ao deletar order!',
        ], $response ? 204 : 500);
    }
}