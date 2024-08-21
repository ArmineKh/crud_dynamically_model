<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProductController extends Controller
{
    public function fetchAndSaveIphones()
    {
        $response = Http::get('https://dummyjson.com/products/search?q=iPhone');
        $products = $response->json()['products'];

        foreach ($products as $product) {
            Product::updateOrCreate(
                ['title' => $product['title']],
                [
                    'price' => $product['price'],
                    'description' => $product['description']
                ]
            );
        }

        return response()->json(['message' => 'iPhones saved successfully']);
    }

    public function index()
    {
        $iphones = Product::where('name', 'like', '%iPhone%')->get();
        return response()->json($iphones);
    }
}
