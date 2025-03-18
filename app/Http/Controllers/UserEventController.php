<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\EventUser;
use App\Models\Event;
use Illuminate\Http\Request;

class UserEventController extends Controller
{
    public function store(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'User not authenticated'], 401);
        }

        $request->validate([
            'event_id' => 'required|exists:events,id',  
        ]);

        // Vérifier si l'utilisateur est déjà inscrit
        if (EventUser::where('user_id', Auth::id())->where('event_id', $request->event_id)->exists()) {
            return response()->json(['error' => 'User already registered for this event'], 400);
        }

        // Inscription
        EventUser::create([
            'user_id' => Auth::id(),
            'event_id' => $request->event_id,
        ]);

        $userevents = EventUser::where('user_id', Auth::id())->get();
        return redirect()->route('events.subscribe')->with('success', 'Inscription réussie ! A bientôt !');

    }

    public function destroy($id)
    {
        $eventUser = EventUser::where('id', $id)->where('user_id', Auth::id())->first();

        if (!$eventUser) {
            return response()->json(['error' => 'Unauthorized or not found'], 403);
        }

        $eventUser->delete();
        return response()->json(['message' => 'Désinscription réussie']);
    }

    public function showUserEvents()
    {
        $user = auth()->user();

        if (!$user) {
            return redirect()->route('login');
        }

        $userevents = $user->events()->paginate(10);

        return view('user.events', compact('userevents'));
    }

    public function eventParticipants($eventId)
    {
        return response()->json(EventUser::where('event_id', $eventId)->get());
    }
}
