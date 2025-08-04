<?php

namespace App\Http\Controllers;

use App\Models\Interaction;
use Illuminate\Http\Request;

class InteractionController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'ticket_id' => 'required|exists:tickets,id',
            'type' => 'required',
            'notes' => 'required',
        ]);

        Interaction::create($request->all());
        return redirect()->back()->with('success', 'Interaction logged.');
    }
}
