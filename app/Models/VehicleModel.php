<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class VehicleModel extends Model
{
    protected $table = "vehicle_models";

    protected $fillable = [
        'name',
        'serial',
    ];

    /**
     * @return HasMany
     **/
    public function vehicles()
    {
        return $this->hasMany(Vehicle::class, 'model');
    }
    public function firmwares()
    {
        return $this->hasMany(Firmware::class);
    }
}
