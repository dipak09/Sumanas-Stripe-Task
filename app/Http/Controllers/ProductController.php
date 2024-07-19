<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;


class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }
}
