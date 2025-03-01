@extends('layouts.app')

@section('title', 'Registrarse')

@section('content')
<div class="container">
    <h3 class="text-center mb-4">Registrarse</h3>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nombre Completo</label>
            <input type="text" name="name" id="name" class="form-control" required autofocus>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Correo Electrónico</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Contraseña</label>
            <div class="input-group">
                <input type="password" name="password" id="password" class="form-control" required>
                <button type="button" class="btn btn-outline-secondary" id="togglePassword">
                    <i class="fas fa-eye"></i>
                </button>
            </div>
        </div>
        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
            <div class="input-group">
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                <button type="button" class="btn btn-outline-secondary" id="togglePasswordConfirmation">
                    <i class="fas fa-eye"></i>
                </button>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Registrarse</button>
    </form>
    <p class="mt-3 text-center">¿Ya tienes cuenta? <a href="{{ route('login') }}">Inicia Sesión aquí</a></p>
</div>
@endsection

@section('scripts')
<script>
    document.getElementById('togglePassword').addEventListener('click', function () {
        const passwordField = document.getElementById('password');
        const passwordFieldType = passwordField.getAttribute('type');
        if (passwordFieldType === 'password') {
            passwordField.setAttribute('type', 'text');
            this.innerHTML = '<i class="fas fa-eye-slash"></i>';
        } else {
            passwordField.setAttribute('type', 'password');
            this.innerHTML = '<i class="fas fa-eye"></i>';
        }
    });

    document.getElementById('togglePasswordConfirmation').addEventListener('click', function () {
        const passwordField = document.getElementById('password_confirmation');
        const passwordFieldType = passwordField.getAttribute('type');
        if (passwordFieldType === 'password') {
            passwordField.setAttribute('type', 'text');
            this.innerHTML = '<i class="fas fa-eye-slash"></i>';
        } else {
            passwordField.setAttribute('type', 'password');
            this.innerHTML = '<i class="fas fa-eye"></i>';
        }
    });
</script>
@endsection