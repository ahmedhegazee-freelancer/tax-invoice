<?php

namespace Modules\Branch\Entities;

use App\Helpers\FormattedUrlAttribute;
use App\Models\BranchAddressSetting;
use App\Models\Invoice;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;

class Branch extends Model
{

    use HasFactory;
    protected $fillable = [
        'name',
        'branch_code',
        'activity_code',
    ];
    public function credentials()
    {
        return $this->hasMany(BranchCredential::class);
    }
    public function address()
    {
        return $this->hasMany(BranchAddressSetting::class);
    }
    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
}