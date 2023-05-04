<?php

namespace Modules\Branch\Entities;

use App\Helpers\FormattedUrlAttribute;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;

class BranchCredential extends Model
{

    use HasFactory;
    protected $fillable = [
        'branch_id',
        'device_serial_number',
        'client_id',
        'client_secret',
        'pos_os_version',
        'is_prod'
    ];
}