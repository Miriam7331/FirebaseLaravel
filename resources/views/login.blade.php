<!-- resources/views/login.blade.php -->
<form action="{{ route('login') }}" method="POST">
    @csrf
    <label for="email">Correo Electrónico</label>
    <input type="email" name="email" required>

    <label for="password">Contraseña</label>
    <input type="password" name="password" required>

    <button type="submit">Iniciar Sesión</button>

    @if ($errors->any())
        <div class="errors">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif
</form>
