<?php

namespace App\Http\Controllers;

use App\Models\EventUser;
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
        return response()->json(EventUser::where('user_id', $userId)->get());
    }

    public function eventParticipants($eventId)
    {
        return response()->json(EventUser::where('event_id', $eventId)->get());
    }
}
