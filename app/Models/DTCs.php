<?php

namespace App\Models;


use App\Enums\DTCsTypes;
use App\Enums\Manufactors;
use App\Enums\SystemsTypes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DTCs extends Model
{
    protected $table = "dtcs";

    protected $fillable = [
        'type',
        'code',
        'system',
        'manufactor',
        'description',
    ];

    protected $casts = [
        'system' => SystemsTypes::class,
        'type' => DTCsTypes::class,
        'manufactor' => Manufactors::class,
    ];

    static $rules = [
        'type'=> 'required|unique:dtcs,type,NULL,NULL,code',
        'code'=> 'required|min:4|unique:dtcs,code,NULL,NULL,type',
        'system'=> 'required',
        'manufactor'=> 'required',
        'description'=> 'nullable|string',
    ];

    /**
     * @return HasMany
     **/
    public function troubles()
    {
        return $this->hasMany(Trouble::class);
    }
}
