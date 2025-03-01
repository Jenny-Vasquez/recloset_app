@extends('layouts.app')

@section('title', 'Iniciar Sesión')

@section('content')
<div class="container my-5">
    <h3 class="text-center mb-4">Iniciar Sesión</h3>
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label">Correo Electrónico</label>
            <input type="email" name="email" id="email" class="form-control" required autofocus>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Contraseña</label>
            <div class="input-group">
                <input type="password" name="password" id="password" class="form-control" required>
                <button type="button" class="btn btn-outline-secondary" id="togglePassword">
                    <i class="fas fa-eye-slash"></i>
                </button>
            </div>
        </div>
        <div class="d-flex justify-content-end mb-3">
            <div class="form-check form-check-highlight">
                <input type="checkbox" name="remember" id="remember" class="form-check-input">
                <label class="form-check-label" for="remember">Recordarme</label>
            </div>
        </div>
        <div class="text-end">
            <button type="submit" class="btn btn-primary">Entrar</button>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
    document.getElementById('togglePassword').addEventListener('click', function () {
        const passwordField = document.getElementById('password');
        const passwordFieldType = passwordField.getAttribute('type');
        if (passwordFieldType === 'password') {
            passwordField.setAttribute('type', 'text');
            this.innerHTML = '<i class="fas fa-eye"></i>';
        } else {
            passwordField.setAttribute('type', 'password');
            this.innerHTML = '<i class="fas fa-eye-slash"></i>';
        }
    });
</script>
@endsection