<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Session extends Model
{
    protected $table = "sessions";

    protected $fillable = [
    ];

    static $rules = [
    ];
    
    /**
     * @return BelongsTo
     **/
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle');
    }

    /**
     * @return HasMany
     **/
    public function troubles()
    {
        return $this->hasMany(Trouble::class);
    }

    /**
     * @return HasMany
     **/
    public function frames()
    {
        return $this->hasMany(FreezeFrame::class);
    }

    /**
     * @return HasMany
     **/
    public function monitors()
    {
        return $this->hasMany(Monitor::class);
    }
}
