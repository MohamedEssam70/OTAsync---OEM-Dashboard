<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Vehicle extends Model
{
    protected $table = "vehicles";

    protected $fillable = [
        'serial',
        'pin',
        'vin',
        'available',
        'model',
        'firmware'
    ];

    static $rules = [
        'pin'=> 'required|unique:vehicles',
        'vin'=> 'required|unique:vehicles',
    ];
    
    /**
     * @return BelongsTo
     **/
    public function models()
    {
        return $this->belongsTo(VehicleModel::class, 'model');
    }

    /**
     * @return BelongsTo
     **/
    public function currentFirmware()
    {
        return $this->belongsTo(Firmware::class, 'firmware');
    }


    /**
     * @return HasMany
     **/
    public function firmwares()
    {
        return $this->hasMany(Firmware::class);
    }
}
