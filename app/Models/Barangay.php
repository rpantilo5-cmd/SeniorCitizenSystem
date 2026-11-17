<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barangay extends Model
{
    protected $guarded = [];

    // Usa ka barangay adunay daghang seniors
    public function seniors()
    {
        return $this->hasMany(Senior::class);
    }
}