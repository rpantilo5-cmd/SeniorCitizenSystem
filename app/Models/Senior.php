<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Senior extends Model
{
    use HasFactory;

    protected $fillable = [
        'osca_id',
        'first_name',
        'last_name',
        'birthdate',
        'contact_number',
        'barangay',
    ];

    /**
     * Cast birthdate as Carbon date instance
     */
    protected $casts = [
        'birthdate' => 'date',
    ];

    /**
     * Custom Accessor: Formats birthdate into "October 26, 1960"
     */
    public function getFormattedBirthdateAttribute()
    {
        return $this->birthdate ? Carbon::parse($this->birthdate)->format('F d, Y') : 'N/A';
    }
}