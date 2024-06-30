<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Trouble extends Model
{
    protected $table = "troubles";

    protected $fillable = [
        'dtc',
        'type'
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
