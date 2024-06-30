<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Monitor extends Model
{
    protected $table = "monitors";

    protected $fillable = [
        'pid',
        'description',
        'value',
        'unit',
        'min',
        'max',
        'samples'
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
