<!-- resources/views/home.blade.php -->
<h1>Bienvenido, {{ session('firebase_user_email') }}</h1>
<p>Tu ID de Usuario es: {{ session('firebase_user_id') }}</p>



<form action="{{ route('logout') }}" method="POST">
    @csrf
    <button type="submit">Cerrar Sesión</button>
</form>
