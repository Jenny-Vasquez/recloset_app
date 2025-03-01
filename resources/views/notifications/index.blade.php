@extends('layouts.app')

@section('title', 'Notificaciones')

@section('content')
<div class="container my-5">
    <h3 class="text-center mb-4">Notificaciones</h3>

    @if(auth()->user()->notifications->isEmpty())
        <div class="alert alert-info text-center">No tienes notificaciones.</div>
    @else
        <ul class="list-group">
            @foreach(auth()->user()->notifications as $notification)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        {{ $notification->data['message'] }}
                        <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                    </div>
                    <form action="{{ route('notifications.read', $notification->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Marcar como leído</button>
                    </form>
                </li>
            @endforeach
        </ul>
    @endif
</div>
@endsection