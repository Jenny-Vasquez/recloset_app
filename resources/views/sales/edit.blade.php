@extends('layouts.app')

@section('title', 'Editar Publicación')

@section('content')
<div class="container my-5">
    <h3 class="text-center mb-4">Editar Publicación</h3>
    <form method="POST" action="{{ route('sales.update', $sale->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="product" class="form-label">Producto</label>
            <input type="text" name="product" id="product" class="form-control" value="{{ $sale->product }}" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Descripción</label>
            <textarea name="description" id="description" class="form-control" rows="3" required>{{ $sale->description }}</textarea>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Precio</label>
            <input type="number" name="price" id="price" class="form-control" step="0.01" value="{{ $sale->price }}" required>
        </div>
        <div class="mb-3">
            <label for="category_id" class="form-label">Categoría</label>
            <select name="category_id" id="category_id" class="form-select" required>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $sale->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="images" class="form-label">Imágenes</label>
            <input type="file" name="images[]" id="images" class="form-control" multiple>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar Publicación</button>
    </form>
</div>
@endsection