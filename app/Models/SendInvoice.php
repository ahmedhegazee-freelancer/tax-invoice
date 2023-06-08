<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SendInvoice extends Model
{
    use HasFactory;
    protected $fillable = [
        'ticket_id',
        'branch_id',
        'branch_name',
        'is_sent',
        'is_prod',
        'data',
        'date',
    ];
}
