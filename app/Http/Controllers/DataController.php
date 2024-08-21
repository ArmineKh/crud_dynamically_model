<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class DataController extends Controller
{
    protected $models = [
        'products' => 'Product',
        'recipes' => 'Recipe',
        'posts' => 'Post',
        'users' => 'User',
    ];

    public function fetchAndSave(string $type)
    {
        if (!isset($this->models[$type])) {
            return response()->json(['message' => 'Invalid type'], 400);
        }

        $modelClass = 'App\\Models\\' . $this->models[$type];
        if ($type == 'products'){
            $response = Http::get("https://dummyjson.com/{$type}/search?q=iPhone");
        }else{
            $response = Http::get("https://dummyjson.com/{$type}");
        }

        $items = $response->json()[$type];

        foreach ($items as $item) {
            $modelClass::updateOrCreate(
                ['id' => $item['id']],
                $item
            );
        }

        return response()->json(['message' => ucfirst($type) . ' saved successfully']);
    }

    public function index(string $type)
    {
        if (!isset($this->models[$type])) {
            return response()->json(['message' => 'Invalid type'], 400);
        }

        $modelClass = 'App\\Models\\' . $this->models[$type];
        $items = $modelClass::all();

        return response()->json($items);
    }
}
