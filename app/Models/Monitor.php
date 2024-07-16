<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Monitor extends Model
{
    protected $table = "monitors";

    protected $fillable = [
        'data'
        // 'pid',
        // 'description',
        // 'value',
        // 'unit',
        // 'avg',
        // 'min',
        // 'max',
        // 'samples'
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

    public function count_sensors()
    {
        return count(json_decode($this->data));
    }
}
