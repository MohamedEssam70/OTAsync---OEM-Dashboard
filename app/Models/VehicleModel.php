<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class VehicleModel extends Model
{
    protected $table = "vehicle_models";

    protected $fillable = [
        'name',
        'serial',
        'image',
    ];

    static $rules = [
        'name'=> 'required|unique:vehicle_models',
        'serial'=> 'required|unique:vehicle_models',
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



    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn (string|null $value) => !empty($value) ? url("storage/vehicles/{$value}") : url('storage/vehicles/defult.jpg'),
            // set: fn (string $value) => strtolower($value),
        );
    }
}
