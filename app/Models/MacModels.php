<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MacModels extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'mac_id',
        'name',
        'serial',
    ];

    static $rules = [
        'name' => 'required|unique:mac_models,name',
        'serial' => 'required|unique:mac_models,serial',
        'mac_id' => 'required',
    ];

    public function mac()
    {
        return $this->belongsTo(MacTypes::class);
    }

    public function ecus()
    {
        return $this->hasMany(Ecus::class);
    }
}
