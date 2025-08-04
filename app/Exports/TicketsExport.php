<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Support\Collection;

class TicketsExport implements FromCollection, WithHeadings, WithMapping
{
    protected $tickets;

    public function __construct(Collection $tickets)
    {
        $this->tickets = $tickets;
    }

    public function collection()
    {
        return $this->tickets;
    }

    public function headings(): array
    {
        return [
            'ID',
            'Customer',
            'Title',
            'Description',
            'Status',
            'Priority',
            'Assigned To',
            'Created At',
            'Updated At',
        ];
    }

    public function map($ticket): array
    {
        return [
            $ticket->id,
            $ticket->customer->name ?? 'N/A',
            $ticket->title,
            $ticket->description,
            ucfirst(str_replace('_', ' ', $ticket->status)),
            ucfirst($ticket->priority),
            $ticket->assignedUser->name ?? 'Unassigned',
            $ticket->created_at->format('Y-m-d H:i:s'),
            $ticket->updated_at->format('Y-m-d H:i:s'),
        ];
    }
}

