<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ecus extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'app',
        'controller',
        'software_version',
        'manufactor_hw_number',
        'serial',
        'VIN',
        'flash_size',
    ];

    public function model()
    {
        return $this->belongsTo(MacModels::class);
    }
}
