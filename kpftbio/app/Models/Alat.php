<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Alat extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function riwayat()
    {
        return $this->hasMany("App\Models\Riwayat", "alat_id");
    }

    public function jenisAlat()
    {
        return $this->belongsTo("App\Models\JenisAlat", "jenis_alat_id");
    }

    public function jenisAlatWithTrashed()
    {
        return $this->belongsTo("App\Models\JenisAlat", "jenis_alat_id")->withTrashed();
    }
}
