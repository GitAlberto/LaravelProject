<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EventController extends Controller
{
        public function index()
    {
        // Récupère tous les événements et les pagine avec 5 événements par page
        $events = Event::paginate(5);

        // Retourne la vue avec les événements paginés
        return view('event-gestion.listEvent', compact('events'));
    }

    public function show($id)
    {
        $event = Event::findOrFail($id);
         // Retourner la vue avec l'événement
        return view('event-gestion.OneEvent', compact('event'));
    }

    public function create()
    {
        return view('event-gestion.createEvent'); 
    }
    public function store(Request $request)
    {
        $slug = Str::slug($request->input('title'));
        $request->validate([
            'title' => 'required|string|unique:events,title',
            'description' => 'required|string',
            'location' => 'required|string',
            'date' => 'required|date',
            'category' => 'required|string',
            'max_participants' => 'required|integer',
        ]);
    
        Event::create([
            'title' => $request->title,
            'slug' => $slug,
            'description' => $request->description,
            'location' => $request->location,
            'date' => $request->date,
            'category' => $request->category,
            'max_participants' => $request->max_participants,
            
        ]);
    
        return redirect()->route('events.index')->with('success', 'Événement créé avec succès.');
    }

        public function edit($id)
    {
        $event = Event::findOrFail($id); // Trouve l'événement ou retourne une erreur 404
        return view('event-gestion.event-edit', compact('event'));
    }


    public function update(Request $request, $id)
    {
        // Validation des données
        $validatedData = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'location' => 'required|string',
            'date' => 'required|date',
            'category' => 'required|string',
            'max_participants' => 'required|integer',
        ]);
    
        // Trouver l'événement ou retourner une erreur 404
        $event = Event::findOrFail($id);
    
        //redefinition du slug
        $slug = Str::slug($request->input('title'));
        // Mettre à jour uniquement les champs nécessaires
        $event->update([
            'title' => $validatedData['title'],
            'slug' => $slug,
            'description' => $validatedData['description'],
            'location' => $validatedData['location'],
            'date' => $validatedData['date'],
            'category' => $validatedData['category'],
            'max_participants' => $validatedData['max_participants'],
        ]);
    
        // Redirection avec un message de succès
        return redirect()->route('events.index')->with('success', 'Événement mis à jour avec succès.');
    }
    

    public function destroy($id)
    {
        Event::destroy($id);
        return redirect()->route('events.index')->with('success', 'Suppression réussie !');
    }
}
