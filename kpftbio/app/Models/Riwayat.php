<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Riwayat extends Model
{
    use HasFactory;

    public function alat()
    {
        return $this->belongsTo("App\Models\Alat", "alat_id");
    }

    public function alatWithTrashed()
    {
        return $this->belongsTo("App\Models\Alat", "alat_id")->withTrashed();
    }
}
