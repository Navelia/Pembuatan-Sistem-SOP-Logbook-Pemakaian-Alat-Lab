<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JenisAlat extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function spesifikasi()
    {
        return $this->hasMany("App\Models\Spesifikasi", "jenis_alat_id");
    }

    public function sop()
    {
        return $this->hasMany("App\Models\Sop", "jenis_alat_id");
    }

    public function alat()
    {
        return $this->hasMany("App\Models\Alat", "jenis_alat_id");
    }
}
