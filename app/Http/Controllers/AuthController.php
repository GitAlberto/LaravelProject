<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //affichage du formulaire d'insctiption au site
    public function showRegisterForm()
    {
        return view('login-logout-register.register');
    }

    //affichage du formulaire de connexion
    public function showlogin()
    {
        return view('login-logout-register.login');
    }

    /**
 * Inscription d'un utilisateur avec création automatique de son profil.
 */
public function register(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'fist_name' => 'required|string',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
        'password_confirmation' => 'required|string|min:8',
        'postale_code' => 'nullable|string',
        'city' => 'nullable|string',
        'age' => 'nullable|integer',
        'sex' => 'nullable|string|in:male,female',
    ]);
    

    // Création de l'utilisateur
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    
    // Création du profil utilisateur lié à l'utilisateur
    $profile = UserProfile::create([
        'user_id' => $user->id,
        'fist_name' => $request->fist_name,
        'postale_code' => $request->postale_code,
        'city' => $request->city,
        'age' => $request->age,
        'sex' => $request->sex,
    ]);


    // Générer un token Sanctum
    $token = $user->createToken('auth_token')->plainTextToken;

    return redirect()->route('form.login')->with('success', 'Inscription réussie ! Connectez-vous.');
}

  
public function login(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    $user = User::where('email', $request->email)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
        throw ValidationException::withMessages([
            'email' => ['Les informations de connexion sont incorrectes.'],
        ]);
    }

    // Authentifier l'utilisateur dans la session Laravel
    Auth::login($user);

    // Générer un token Sanctum (si tu fais une API)
    $token = $user->createToken('auth_token')->plainTextToken;

    return redirect()->route('events.index')->with('success', 'Connexion réussie');
}

    /**
     * Récupérer les informations de l'utilisateur connecté.
     */
    public function me(Request $request)
    {
        if (Auth::check()) {
            return response()->json([
                'name' => Auth::user()->name,
                'role' => Auth::user()->role
            ]);
        } else {
            return response()->json(['message' => 'Aucun utilisateur connecté.'], 401);
        }
    }

    /**
     * Déconnexion d'un utilisateur.
     */
    public function logout(Request $request)
    {
        // Déconnecter l'utilisateur
        Auth::logout();

        // Invalider la session
        $request->session()->invalidate();

        // Régénérer le token CSRF (sécurité)
        $request->session()->regenerateToken();

        // Rediriger vers la page d'accueil (ou une autre route publique)
        return redirect()->route('events.index')->with('success', 'Déconnexion réussie');
    }
}
