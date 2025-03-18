<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Inscription d'un utilisateur avec les informations de UserProfile.
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',

            // Validation des champs UserProfile
            'fist_name' => 'required|string|max:255',
            'postale_code' => 'required|string|max:10',
            'city' => 'required|string|max:255',
            'age' => 'required|integer|min:1',
            'sex' => 'required|in:male,female',
        ]);

        // Création de l'utilisateur
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Création du profil utilisateur lié à l'utilisateur
        UserProfile::create([
            'user_id' => $user->id,
            'fist_name' => $request->fist_name,
            'postale_code' => $request->postale_code,
            'city' => $request->city,
            'age' => $request->age,
            'sex' => $request->sex,
        ]);

        // Connexion automatique après inscription
        Auth::login($user);

        // 🔹 Générer un token Sanctum
        $token = $user->createToken('auth_token')->plainTextToken;


        return redirect()->route('login')->with('success', 'Inscription réussie !');
    }

    /**
     * Connexion d'un utilisateur.
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->withErrors([
                'email' => 'Les informations de connexion sont incorrectes.',
            ]);
        }

        // Connexion de l'utilisateur
        Auth::login($user);

         // 🔹 Générer un token Sanctum
         $token = $user->createToken('auth_token')->plainTextToken;

        return redirect()->route('events.index')->with('success', 'Connexion réussie !');
    }

    /**
     * Récupérer les informations de l'utilisateur connecté.
     */
    public function me(Request $request)
    {
        return response()->json([
            'user' => $request->user(),
        ]);
    }

    /**
     * Déconnexion d'un utilisateur.
     */
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        Auth::logout();
        return redirect()->route('login')->with('success', 'Déconnexion réussie !');
    }

    /**
     * Afficher le formulaire d'inscription.
     */
    public function showRegisterForm()
    {
        return view('login-logout-register.register');
    }

    /**
     * Afficher le formulaire de connexion.
     */
    public function showLoginForm()
    {
        return view('login-logout-register.login');
    }
}
