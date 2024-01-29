<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lab extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function alat()
    {
        return $this->hasMany("App\Models\Alat", "jenis_alat_id");
    }
}
