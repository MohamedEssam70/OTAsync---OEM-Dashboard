<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FreezeFrame extends Model
{
    protected $table = "freeze_frames";

    protected $fillable = [
        'pid',
        'description',
        'value',
        'unit'
    ];

    static $rules = [
    ];
    
    /**
     * @return BelongsTo
     **/
    public function session()
    {
        return $this->belongsTo(Session::class, 'session');
    }
}
