<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    
    /**
 * Inscription d'un utilisateur avec création automatique de son profil.
 */
public function register(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
        'LastName' => 'required|string',
        'FirstName' => 'required|string',
        'CP' => 'nullable|string',
        'City' => 'nullable|string',
        'Age' => 'nullable|integer',
        'Sex' => 'nullable|string|in:male,female',
    ]);

    // Création de l'utilisateur
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    // Création du profil utilisateur lié
    $profile = UserProfile::create([
        'user_id' => $user->id,
        'LastName' => $request->LastName,
        'FirstName' => $request->FirstName,
        'CP' => $request->CP,
        'City' => $request->City,
        'Age' => $request->Age,
        'Sex' => $request->Sex,
    ]);

    // Générer un token Sanctum
    $token = $user->createToken('auth_token')->plainTextToken;

    return response()->json([
        'message' => 'Utilisateur et profil créés avec succès',
        'user' => $user,
        'profile' => $profile,
        'token' => $token,
    ], 201);
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

        // Générer un token Sanctum
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Connexion réussie',
            'user' => $user,
            'token' => $token,
        ]);
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

        return response()->json([
            'message' => 'Déconnexion réussie',
        ]);
    }
}
