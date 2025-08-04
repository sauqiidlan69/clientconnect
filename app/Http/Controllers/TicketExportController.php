<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TicketsExport;
use PDF;

class TicketExportController extends Controller
{
    public function exportCSV()
    {
        return Excel::download(new TicketsExport, 'tickets.csv');
    }

    public function exportPDF()
    {
        $tickets = Ticket::with('customer')->get();
        $pdf = PDF::loadView('exports.tickets_pdf', compact('tickets'));
        return $pdf->download('tickets.pdf');
    }
}
