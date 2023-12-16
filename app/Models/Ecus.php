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
        'vin',
        'flash_size',
        'mac_models_id',
    ];

    static $rules = [
        'name' => 'required|unique:ecuses,name',
        'app' => 'required',
        'controller' => '',
        'software_version' => 'required',
        'manufactor_hw_number' => '',
        'serial' => 'required|unique:ecuses,serial',
        'vin' => 'unique:ecuses,vin',
        'flash_size' => 'required',
        'mac_models_id' => 'required',
    ];

    public function model()
    {
        return $this->belongsTo(MacModels::class);
    }
}
