<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssistanceRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'senior_id',
        'request_type',
        'details',
        'status',
    ];

    /**
     * Relationship with Senior Model
     */
    public function senior()
    {
        return $this->belongsTo(Senior::class);
    }
}