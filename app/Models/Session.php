<?php

namespace App\Models;


use App\Enums\SessionStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Session extends Model
{
    protected $table = "sessions";

    protected $fillable = [
        'status'
    ];

    protected $casts = [
        'status' => SessionStatus::class,
    ];

    static $rules = [
    ];
    
    /**
     * @return BelongsTo
     **/
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
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

    public function last_frame()
    {
        return $this->frames()->orderBy('id', 'desc')->first();
    
    }
    public function last_monitor()
    {
        return $this->monitors()->orderBy('id', 'desc')->first();
    }

    public function get_updated_frames()
    {
        // $troubles_exist = $this->troubles()->where('cleard', false)->count();
        // if(!$troubles_exist)
        // {
        //     return null;
        // }
        return json_decode($this->last_frame()?->data);
    }

}
