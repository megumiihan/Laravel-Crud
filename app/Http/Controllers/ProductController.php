<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $products = Product::latest()->get();
        return view('products.index', compact('products'));
    }

    public function show(Product $product) {
        return view('products.show', ['product' =>  $product]);
    }
    
    public function create() {
        return view('products.create');
    }

    public function edit(Product $product) {
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product) {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'description' => 'required'
        ]);
        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->save();
        return redirect()->route('products.index');
    }

    public function store(Request $request) {
        $data = $request->validate([
            'name' => 'required',
            'price' => 'required',
            'description' => 'required'
        ]);

        Product::create($data);

        return redirect()->route('products.index')->with('success', 'Product has been added!');
    }

    public function destroy(Product $product) {
        $product->delete();
        return back();
    }
}
