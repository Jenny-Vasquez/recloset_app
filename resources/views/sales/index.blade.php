@extends('layouts.app')

@section('title', 'Recomendado para ti')

@section('content')
<div class="container my-5">
    <h1 class="text-center mb-4">Recomendado para ti</h1>

    <form method="GET" action="{{ route('sales.index') }}" class="mb-4">
        <div class="row">
            <div class="col-md-4 offset-md-4">
                <select name="category_id" class="form-select" onchange="this.form.submit()">
                    <option value="">Todas las Categorías</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    </form>

    @if($sales->isEmpty())
        <div class="alert alert-info text-center">No hay publicaciones disponibles en este momento.</div>
    @else
        <div class="row justify-content-center">
            @foreach($sales as $sale)
                <div class="col-md-4 my-3">
                    <div class="card">
                        <!-- Imagen del producto con cartel de "Vendido" si está vendido -->
                        <div class="position-relative">
                            @if($sale->img)
                                <img src="{{ url('storage/' . $sale->img) }}" class="card-img-top" alt="{{ $sale->product }}">
                            @else
                                <img src="{{ asset('images/default-thumbnail.jpg') }}" class="card-img-top" alt="Sin imagen">
                            @endif
                            
                            @if($sale->isSold)
                                <div class="position-absolute top-50 start-50 translate-middle bg-danger text-white px-3 py-1 fw-bold" style="font-size: 1.5rem; border-radius: 5px;">
                                    Vendido
                                </div>
                            @endif
                        </div>

                        <div class="card-body">
                            <h5 class="card-title">{{ $sale->product }}</h5>
                            <p class="card-text">{{ $sale->description }}</p>
                            <p class="card-text">
                                <strong>Precio:</strong> €{{ number_format($sale->price, 2) }} <br>
                                <strong>Categoría:</strong> {{ $sale->category->name }} <br>
                                <strong>Vendedor:</strong> {{ $sale->user->name }} <br>
                            </p>
                            <div class="d-flex justify-content-end">
                                <a href="{{ route('sales.show', $sale->id) }}" class="btn btn-ver-mas">Ver más</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="d-flex justify-content-center pt-3">
            {{ $sales->links('pagination::bootstrap-4') }}
        </div>
    @endif
</div>
@endsection
