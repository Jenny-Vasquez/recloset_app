@extends('layouts.app')

@section('content')
<div class="container my-5 d-flex justify-content-center">
    <div class="d-flex flex-column align-items-center w-65"> 

        <!-- Imagen del producto con opacidad si está vendido -->
        <div class="img-container position-relative w-100" style="height: 400px; overflow: hidden; margin-bottom: 2rem;">
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

        <!-- Descripción y detalles del producto -->
        <div class="card-body w-100">
            <!-- Mensajes de éxito o error -->
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Título y descripción del producto -->
            <h5 class="card-title text-center mt-4">{{ $sale->product }}</h5>
            <p class="card-text mt-4">{{ $sale->description }}</p>

            <!-- Información adicional -->
            <ul class="list-unstyled">
                <li><strong><i class="fa fa-money" aria-hidden="true"></i>
                         Precio:</strong> €{{ number_format($sale->price, 2) }}</li>
                <li><strong> <i class="fa fa-tag" aria-hidden="true"></i>
                         Categoría:</strong> {{ $sale->category->name }}</li>
                <li><strong><i class="fa fa-user" aria-hidden="true"></i>
                         Vendedor:</strong> {{ $sale->user->name }}</li>
            </ul>

            <!-- Botones de acción -->
            <div class="d-flex justify-content-between">
                <a href="{{ route('sales.index') }}" class="btn btn-secondary btn-sm btn-volver">Volver</a>

                @if(Auth::check())
                    @if(!$sale->isSold)
                        @if(Auth::id() !== $sale->user_id)
                            <form action="{{ route('sales.sell', [$sale->id, Auth::id()]) }}" method="POST" onsubmit="return confirm('¿Seguro que deseas comprarlo?');" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm btn-editar">Comprar</button>
                            </form>
                        @else
                            <a href="{{ route('sales.edit', $sale->id) }}" class="btn btn-warning btn-sm btn-editar">Editar</a>
                        @endif
                    @else
                        <!-- Botones deshabilitados si el producto está vendido -->
                        <button class="btn btn-secondary btn-sm" disabled>Comprar</button>
                        <button class="btn btn-secondary btn-sm" disabled>Editar</button>
                    @endif
                @endif

                <!-- Botón de eliminar solo para el dueño del producto -->
                @if(Auth::check() && Auth::id() === $sale->user_id)
                    <form action="{{ route('sales.destroy', $sale->id) }}" method="POST" onsubmit="return confirm('¿Seguro que deseas eliminar este anuncio?');" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm btn-borrar">Eliminar</button>
                    </form>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
