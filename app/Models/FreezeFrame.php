<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FreezeFrame extends Model
{
    protected $table = "freeze_frames";

    protected $fillable = [
        'session_id',
        'data'
    ];

    static $rules = [
    ];
    
    /**
     * @return BelongsTo
     **/
    public function session()
    {
        return $this->belongsTo(Session::class);
    }

    public function count_frames()
    {
        return count(json_decode($this->data));
    }
}
