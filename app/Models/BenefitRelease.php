<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BenefitRelease extends Model
{
    use HasFactory;

    protected $fillable = [
        'senior_id',
        'benefit_type',
        'amount',
        'release_date',
    ];

    /**
     * Relationship with Senior Model
     */
    public function senior()
    {
        return $this->belongsTo(Senior::class);
    }
}