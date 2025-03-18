<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserProfile;
use App\Models\Event;
use App\Models\Category;

class SearchController extends Controller
{
    /**
     * Effectuer une recherche sur plusieurs modèles.
     */
    public function search(Request $request)
    {
        $query = $request->input('query');

        // Vérifie si une requête est envoyée
        if (!$query) {
            return response()->json(['error' => 'Veuillez entrer un mot-clé.'], 400);
        }

        // Recherche dans UserProfile (nom, prénom, ville)
        $users = UserProfile::where('LastName', 'LIKE', "%{$query}%")
            ->orWhere('FistName', 'LIKE', "%{$query}%")
            ->orWhere('City', 'LIKE', "%{$query}%")
            ->get();

        // Recherche dans Event (titre, description)
        $events = Event::where('title', 'LIKE', "%{$query}%")
            ->orWhere('description', 'LIKE', "%{$query}%")
            ->get();

        // Recherche dans Category (nom)
        $categories = Category::where('name', 'LIKE', "%{$query}%")
            ->get();

        // Retourner les résultats sous forme de JSON
        return response()->json([
            'users' => $users,
            'events' => $events,
            'categories' => $categories,
        ]);
    }
}
