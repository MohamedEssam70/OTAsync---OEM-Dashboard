<?php

namespace App\Models;

use App\Enums\KeysTypes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class APIKey extends Model
{
    protected $table = "api_keys";

    protected $fillable = [
        'name',
        'type',
        'key',
        'vehicle_id',
    ];

    protected $casts = [
        'type' => KeysTypes::class,
    ];

    static $rules = [
        'name'=> 'required|string|max:50',
        'type'=> 'required|string|max:50',
        'vehicle_id'=> 'required|exists:vehicles,id',
    ];

    protected static function booted()
    {
        static::creating(function ($api_key) {
            $api_key->key = (String) Str::random(64);
        });
    }

    /**
     * @return BelongsTo
     **/
    public function Vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}
