<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function history()
    {

        $user = Auth::user();

        $orders = $user->orders()->with('items.product')->get();

        return response()->json($orders);
    }
}
