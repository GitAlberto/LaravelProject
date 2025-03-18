<?php

namespace App\Http\Controllers;

use App\Models\UserProfile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
          // Récupère tous les événements et les pagine avec 5 événements par page
          $profiles = UserProfile::paginate(10);

          // Retourne la vue avec les événements paginés
          return view('profile-gestion.listProfile', compact('profiles'));
    }

    public function show($id)
    {
        $profile = UserProfile::findOrFail($id);
        // Retourner la vue du détails du profile
        return view('profile-gestion.OneProfile', compact('profile'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'LastName' => 'required|string',
            'FirstName' => 'required|string',
            'CP' => 'nullable|string',
            'City' => 'nullable|string',
            'Age' => 'nullable|integer',
            'Sex' => 'nullable|string',
        ]);

        $profile = UserProfile::create($request->all());
        return response()->json($profile, 201);
    }

    public function update(Request $request, $id)
    {
        $profile = UserProfile::findOrFail($id);
        $profile->update($request->all());
        return response()->json($profile);
    }

    public function destroy($id)
    {
        UserProfile::destroy($id);
        return response()->json(['message' => 'Profil supprimé']);
    }
}
