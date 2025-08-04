<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function store(Request $request, Ticket $ticket)
    {
        $request->validate([
            'rating' => 'nullable|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        Feedback::updateOrCreate(
            ['ticket_id' => $ticket->id, 'customer_id' => auth()->id()],
            ['rating' => $request->rating, 'comment' => $request->comment]
        );

        return redirect()->route('tickets.show', $ticket->id)
                        ->with('success', 'Thank you for your feedback!');
    }

}
