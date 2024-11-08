<!-- resources/views/home.blade.php -->
<h1>Bienvenido, {{ $user->email }}</h1>
<p>Tu ID de Usuario es: {{ $user->uid }}</p>

<form action="{{ route('logout') }}" method="POST">
    @csrf
    <button type="submit">Cerrar Sesión</button>
</form>
