<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;

class ImageController extends Controller
{
    public function show($filename)
    {
        // Obtener la imagen desde el storage y devolverla
        $path = storage_path('app/public/' . $filename);
        if (!file_exists($path)) {
            abort(404);
        }

        return response()->file($path);
    }
    public function destroy($id)
    {
        $image = Image::findOrFail($id);
        $image->delete();
        return back()->with('success', 'Imagen eliminada exitosamente.');
    }
}