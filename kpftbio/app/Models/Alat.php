<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Alat extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function spesifikasi()
    {
        return $this->hasMany("App\Models\Spesifikasi", "alat_id");
    }

    public function sop()
    {
        return $this->hasMany("App\Models\Sop", "alat_id");
    }

    public function riwayat()
    {
        return $this->hasMany("App\Models\Riwayat", "alat_id");
    }
}
