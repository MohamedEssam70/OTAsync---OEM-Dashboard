<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AESKey extends Model
{
    protected $table = "aes_keys";

    protected $fillable = [
        'key',
        'firmware_id',
    ];


    static $rules = [
        'key'=> 'required',
        'firmware_id'=> 'required|exists:firmwares,id',
    ];


    /**
     * @return BelongsTo
     **/
    public function Firmware()
    {
        return $this->belongsTo(Firmware::class);
    }
}
