@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center my-4">Mis Publicaciones</h1>

    @if($sales->isEmpty())
        <div class="alert alert-info text-center">
            Aun no has realizado publicaciones.
        </div>
    @else
        <div class="row">
            @foreach($sales as $sale)
                <div class="col-md-4 my-3">
                    <div class="card">
                        <!-- Imagen del producto con cartel de "Vendido" si está vendido -->
                        <div class="position-relative">
                            @if($sale->img)
                                <img src="{{ asset('storage/' . $sale->img) }}" class="card-img-top" alt="{{ $sale->product }}">
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
                            <p class="card-text">
                                <strong>Precio:</strong> €{{ number_format($sale->price, 2) }} <br>
                                <strong>Categoría:</strong> {{ $sale->category->name }}
                            </p>
                            <a href="{{ route('sales.show', $sale->id) }}" class="btn btn-primary btn-block">Ver más</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
