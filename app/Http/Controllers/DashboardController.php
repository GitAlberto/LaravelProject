<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Event;
use App\Models\UserProfile;

class DashboardController extends Controller
{
    public function index()
    {
        // Récupérer la répartition des sexes
        $sexes = UserProfile::selectRaw('sex, COUNT(*) as count')
                     ->groupBy('sex')
                     ->get();

        // Récupérer la répartition des tranches d'âges
        $ageGroups = UserProfile::selectRaw("
            CASE 
                WHEN age BETWEEN 0 AND 17 THEN '0-17'
                WHEN age BETWEEN 18 AND 25 THEN '18-25'
                WHEN age BETWEEN 26 AND 35 THEN '26-35'
                WHEN age BETWEEN 36 AND 50 THEN '36-50'
                ELSE '50+' 
            END as age_group, COUNT(*) as count"
        )
        ->groupBy('age_group')
        ->get();

        // Récupérer la répartition des événements par catégorie
        $eventCategories = Event::selectRaw('category, COUNT(*) as count')
                                ->groupBy('category')
                                ->get();

        // Retourner la vue avec les données
        return view('dashboard.dashboard-index', compact('sexes', 'ageGroups', 'eventCategories'));

    }
}
