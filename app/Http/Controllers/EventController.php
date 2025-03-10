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

    public function update(Request $request, $id)
    {
        $event = Event::findOrFail($id);
        $event->update($request->all());
        return response()->json($event);
    }

    public function destroy($id)
    {
        Event::destroy($id);
        return response()->json(['message' => 'Événement supprimé']);
    }
}
