<?php

namespace App\Http\Controllers\Support;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InteractionController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'ticket_id' => 'required|exists:tickets,id',
            'type' => 'required|in:email,phone_call,meeting',
            'notes' => 'required|string',
            'interaction_date' => 'required|date',
        ]);

        Interaction::create([
            'ticket_id' => $request->ticket_id,
            'support_id' => auth()->id(),
            'type' => $request->type,
            'notes' => $request->notes,
            'interaction_date' => $request->interaction_date,
        ]);

        return back()->with('success', 'Interaction logged successfully.');
    }

}
