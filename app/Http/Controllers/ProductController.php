<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ProductController extends Controller
{
    public function index() {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    public function create() {
        return view('products.create');
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
            'tags' => 'required|array',
            'publish_date' => 'required',
            'stock_count' => 'required|integer|min:0',
        ]);
        $date=date('d-m-Y H:i:s', strtotime($request->publish_date));
        Product::create([
            'name' => $request->name,
            'tags' => $request->tags,
            'publish_date' => Carbon::createFromFormat('d-m-Y H:i:s', $date),
            'stock_count' => $request->stock_count,
        ]);

        return redirect()->route('products.index')->with('success', 'Product added successfully.');
    }

    public function edit(Product $product) {
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product) {
        $request->validate([
            'name' => 'required',
            'tags' => 'required|array',
            'publish_date' => 'required',
            'stock_count' => 'required|integer|min:0',
        ]);
        $date=date('d-m-Y H:i:s', strtotime($request->publish_date));
        $product->update([
            'name' => $request->name,
            'tags' => $request->tags,
            'publish_date' => Carbon::createFromFormat('d-m-Y H:i:s', $date),
            'stock_count' => $request->stock_count,
        ]);

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product) {
        $product->delete();
        return response()->json(['success' => true]);
    }

    public function lowStock() {
        $products = Product::where('stock_count', '<', 10)->get();
        return view('products.low-stock', compact('products'));
    }
}