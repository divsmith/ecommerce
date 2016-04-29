<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

use App\Http\Requests;

class CartController extends Controller
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;

        // Force the user to be authenticated for any of these methods,
        // otherwise redirect them to the login page.
        $this->middleware('auth');
    }

    /**
     * Show all the products available for purchase.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $products = false;
        $total = 0;

        // Check whether the session contains a cart.
        if ($this->request->session()->has('cart')) {

            // If so, iterate each product and calculate
            // the total price of the cart.
            $products = $this->request->session()->get('cart');
            foreach ($products as $product) {
                $total += $product['count'] * $product['price'];
            }
        }

        // Pass the $products array and the $total cart value to the view at
        // /resources/views/cart/index.blade.php and render it.
        return view('cart.index', compact('products', 'total'));
    }

    /**
     * Add a product to the cart session.
     *
     * @param Product $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Product $product)
    {
        $cart = [];

        // Retrieve the cart if it already exists.
        if ($this->request->session()->has('cart')) {
            $cart = $this->request->session()->pull('cart');
        }

        // If the $cart already has the indicated product, add 1 to the count.
        // Otherwise add the product as a new index in the $cart array.
        if (array_key_exists($product->id, $cart)) {
            $cart[$product->id]['count']++;
        } else {
            $cart[$product->id] = [
                'id' => $product->id,
                'name' => $product->name,
                'count' => 1,
                'price' => $product->price,
                'image' => $product->image
            ];
        }

        // Add the $cart back onto the session.
        $this->request->session()->put('cart', $cart);

        // Render the view at /resources/views/cart/index.blade.php
        return redirect()->route('cart.index');
    }

    /**
     * Remove a product from the cart.
     *
     * @param Product $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove(Product $product)
    {
        $cart = [];

        // Get the $cart array from the session.
        if ($this->request->session()->has('cart')) {
            $cart = $this->request->session()->pull('cart');
        }

        // Remove the given product from the $cart if it exists.
        if (array_key_exists($product->id, $cart)) {
            unset($cart[$product->id]);
        }

        // Place the modified $cart back onto the session.
        $this->request->session()->put('cart', $cart);

        // Render the view at /resources/views/cart/index.blade.php
        return redirect()->route('cart.index');
    }

    /**
     * Empty the cart.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy()
    {
        // Remove the $cart array from the session if it exists.
        if ($this->request->session()->has('cart')) {
            $this->request->session()->pull('cart');
        }

        // Render the view at /resources/views/cart/index.blade.php
        return redirect()->route('cart.index');
    }
}
