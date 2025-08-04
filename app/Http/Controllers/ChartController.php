<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;

class ChartController extends Controller
{
    public function ticketStats()
    {
        $data = [
            'labels' => ['Open', 'Assigned', 'Resolved', 'Rejected'],
            'datasets' => [[
                'label' => 'Tickets by Status',
                'data' => [
                    Ticket::where('status', 'open')->count(),
                    Ticket::where('status', 'assigned')->count(),
                    Ticket::where('status', 'resolved')->count(),
                    Ticket::where('status', 'rejected')->count(),
                ],
                'backgroundColor' => ['#f39c12', '#3498db', '#2ecc71', '#e74c3c']
            ]]
        ];
        return response()->json($data);
    }
}
