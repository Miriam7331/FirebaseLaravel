<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Laravel\Firebase\Facades\Firebase;

class FirebaseAuthController extends Controller
{
    // Servicio de autenticación de Firebase
    protected $auth;

    public function __construct()
    {
        // Inicializamos el servicio de autenticación de Firebase
        $this->auth = Firebase::auth();
    }

    /**
     * Mostrar el formulario de registro
     */
    public function showRegisterForm()
    {
        return view('register'); // Vista del formulario de registro
    }

    /**
     * Registrar un nuevo usuario
     */
    public function register(Request $request)
    {
        // Validación de los datos del formulario
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        try {
            // Crear usuario en Firebase con el correo y la contraseña proporcionados
            $user = $this->auth->createUserWithEmailAndPassword($request->email, $request->password);

            // Redirigir al home con un mensaje de éxito
            return redirect()->route('home')->with('success', 'Usuario registrado exitosamente.');
        } catch (\Exception $e) {
            // Manejar cualquier error que ocurra durante el registro
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Mostrar el formulario de inicio de sesión
     */
    public function showLoginForm()
    {
        return view('login'); // Vista del formulario de login
    }

    /**
     * Iniciar sesión con Firebase
     */
    public function login(Request $request)
    {
        // Validación de los datos del formulario de login
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        try {
            // Intentar iniciar sesión con las credenciales proporcionadas
            $user = $this->auth->signInWithEmailAndPassword($request->email, $request->password);

            // Guardar la información del usuario en la sesión
            session(['firebase_user' => $user]);

            // Redirigir al home
            return redirect()->route('home');
        } catch (\Exception $e) {
            // Manejar errores de login, como credenciales incorrectas
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Mostrar la página de inicio (Home)
     */
    public function home()
    {
        // Obtener el usuario de la sesión
        $user = session('firebase_user');

        // Si no hay un usuario autenticado, redirigir al login
        if (!$user) {
            return redirect()->route('login');
        }

        // Mostrar la vista del home con los detalles del usuario
        return view('home', ['user' => $user]);
    }

    /**
     * Cerrar sesión
     */
    public function logout()
    {
        // Eliminar el usuario de la sesión
        session()->forget('firebase_user');

        // Redirigir al login
        return redirect()->route('login');
    }
}
