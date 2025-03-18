<?php

namespace App\Http\Controllers;

use App\Models\EventUser;
use App\Models\UserEvent;
use Illuminate\Http\Request;

class UserEventController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'event_id' => 'required|exists:events,id',
        ]);

        $eventUser = EventUser::create($request->all());
        return response()->json($eventUser, 201);
    }

    public function destroy($id)
    {
        EventUser::destroy($id);
        return response()->json(['message' => 'Désinscription réussie']);
    }

    public function userEvents($userId)
    {
          // Récupère les événements auxquels l'utilisateur est inscrit via la relation EventUser
        $events = EventUser::paginate(5);  // On suppose qu'il y a une relation 'events' dans ton modèle User
        return view('events.User-listEvent', compact('userevents'));
    }

    public function eventParticipants($eventId)
    {
        return response()->json(EventUser::where('event_id', $eventId)->get());
    }
}
