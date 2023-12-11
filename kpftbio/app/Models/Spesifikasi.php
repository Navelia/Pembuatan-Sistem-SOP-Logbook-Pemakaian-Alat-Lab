<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spesifikasi extends Model
{
    use HasFactory;

    public function jenisAlat()
    {
        return $this->belongsTo("App\Models\JenisAlat", "jenis_alat_id");
    }

    public function jenisAlatWithTrashed()
    {
        return $this->belongsTo("App\Models\JenisAlat", "jenis_alat_id")->withTrashed();
    }
}
