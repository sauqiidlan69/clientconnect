<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CustomersExport;
use App\Exports\TicketsExport;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index()
    {
        return view('admin.reports.index');
    }

    public function generateCustomerReport(Request $request)
    {
        $request->validate([
            'format' => 'required|in:csv,pdf',
            'date_from' => 'nullable|date',
            'date_to' => 'nullable|date|after_or_equal:date_from'
        ]);

        $query = Customer::query();

        // Apply date filters
        if ($request->date_from) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->date_to) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $customers = $query->get();

        $filename = 'customers_report_' . now()->format('Y-m-d_H-i-s');

        if ($request->format === 'csv') {
            return Excel::download(new CustomersExport($customers), $filename . '.xlsx');
        } else {
            $pdf = PDF::loadView('admin.reports.customers_pdf', compact('customers'));
            return $pdf->download($filename . '.pdf');
        }
    }

    public function generateTicketReport(Request $request)
    {
        $request->validate([
            'format' => 'required|in:csv,pdf',
            'date_from' => 'nullable|date',
            'date_to' => 'nullable|date|after_or_equal:date_from',
            'status' => 'nullable|in:open,in_progress,closed,on_hold',
            'priority' => 'nullable|in:low,medium,high,critical'
        ]);

        $query = Ticket::with(['customer', 'assignedUser']);

        // Apply date filters
        if ($request->date_from) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->date_to) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        // Apply status filter
        if ($request->status) {
            $query->where('status', $request->status);
        }

        // Apply priority filter
        if ($request->priority) {
            $query->where('priority', $request->priority);
        }

        $tickets = $query->get();

        $filename = 'tickets_report_' . now()->format('Y-m-d_H-i-s');

        if ($request->format === 'csv') {
            return Excel::download(new TicketsExport($tickets), $filename . '.xlsx');
        } else {
            $pdf = PDF::loadView('admin.reports.tickets_pdf', compact('tickets'));
            return $pdf->download($filename . '.pdf');
        }
    }
}
