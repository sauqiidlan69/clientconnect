<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id', 
        'title', 
        'description', 
        'status', 
        'priority', 
        'assigned_to',
        'rejection_reason',
        'status_note'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function assignedUser()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function feedback()
    {
        return $this->hasOne(Feedback::class);
    }
}
