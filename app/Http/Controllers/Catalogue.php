<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

use App\Http\Requests;

class Catalogue extends Controller
{
    public function __construct()
    {
        // Force the user to be authenticated for any of these methods,
        // otherwise redirect them to the login page.
        $this->middleware('auth');
    }

    public function index()
    {
        // Get all products from the database as an array.
        $products = Product::all();

        // Pass the array of products into the view at /resources/views/catalogue/index.blade.php
        // and render it with the products.
        return view('catalogue.index', compact('products'));
    }

    public function show(Product $product)
    {
        // $product is injected in automatically by the router, so we pass it to the view
        // at /resources/views/catalogue/show.blade.php and render it with the $product.
        return view('catalogue.show', compact('product'));
    }
}
