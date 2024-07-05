<?php

namespace App\Models;


use App\Enums\TroubleTypes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Trouble extends Model
{
    protected $table = "troubles";

    protected $fillable = [
        'dtc',
        'type',
        'cleard'
    ];

    static $rules = [
    ];

    protected $casts = [
        'type' => TroubleTypes::class,
    ];
    
    /**
     * @return BelongsTo
     **/
    public function session()
    {
        return $this->belongsTo(Session::class);
    }

    /**
     * @return BelongsTo
     **/
    public function dtcs()
    {
        return $this->belongsTo(DTCs::class, 'dtc');
    }
}
