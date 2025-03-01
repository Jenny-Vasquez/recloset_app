<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\Category;
use App\Models\Setting;
use App\Models\Image;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Notifications\ProductPurchased;
use App\Notifications\HardcodedNotification;

class SaleController extends Controller
{
    public function index(Request $request)
    {
        $query = Sale::query();

        if ($request->has('category_id') && $request->category_id) {
            $query->where('category_id', $request->category_id);
        }

        $sales = $query->paginate(9);
        $categories = Category::all();

        return view('sales.index', compact('sales', 'categories'));
    }

    public function mine()
    {
        $sales = Sale::where('user_id', Auth::id())->with('category')->get();
        return view('sales.mine', compact('sales'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('sales.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $maxImages = 5;
        $request->validate([
            'product' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'images' => "array|max:$maxImages",
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Crear el anuncio de venta
        $sale = Sale::create([
            'product' => $request->product,
            'description' => $request->description,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'user_id' => Auth::id(),
            'isSold' => false,
        ]);

        // Subir las imágenes
        if ($request->hasFile('images')) {
            $images = $request->file('images');
            // Subir la primera imagen como imagen principal
            $firstImage = array_shift($images);
            $firstPath = $firstImage->store('images', 'public');

            // Guardar la primera imagen como imagen principal de la venta
            $sale->update(['img' => $firstPath]);

            // Crear las entradas para las imágenes restantes en la tabla 'images'
            Image::create([
                'sale_id' => $sale->id,
                'route' => $firstPath,
            ]);

            // Guardar las demás imágenes
            foreach ($images as $image) {
                $path = $image->store('images', 'public');
                Image::create([
                    'sale_id' => $sale->id,
                    'route' => $path,
                ]);
            }
        }

        return redirect()->route('sales.index')->with('success', 'Anuncio creado exitosamente.');
    }

    public function show($id)
    {
        $sale = Sale::with('images')->findOrFail($id);
        return view('sales.show', compact('sale'));
    }

    public function edit($id)
    {
        $sale = Sale::findOrFail($id);
        $categories = Category::all();
        return view('sales.edit', compact('sale', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $sale = Sale::findOrFail($id);
        $maxImages = Setting::where('name', 'maxImages')->value('maxImages');
        $request->validate([
            'product' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'images' => "array|max:$maxImages",
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $sale->update([
            'product' => $request->product,
            'description' => $request->description,
            'price' => $request->price,
            'category_id' => $request->category_id,
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('images', 'public');
                Image::create([
                    'sale_id' => $sale->id,
                    'route' => $path,
                ]);
            }
        }

        return redirect()->route('sales.index')->with('success', 'Anuncio actualizado exitosamente.');
    }

    public function destroy($id)
    {
        $sale = Sale::findOrFail($id);
        $sale->delete();
        return redirect()->route('sales.index')->with('success', 'Anuncio eliminado exitosamente.');
    }
}
