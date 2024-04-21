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
    ];
    
    /**
     * @return BelongsTo
     **/
    public function models()
    {
        return $this->belongsTo(VehicleModel::class, 'model');
    }


    /**
     * @return HasMany
     **/
    public function firmwares()
    {
        return $this->hasMany(Firmware::class);
    }
}
