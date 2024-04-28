<?php

namespace App\Models;

use App\Enums\FirmwareStatus;
use App\Enums\UpdateTypes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Firmware extends Model
{
    protected $table = "firmwares";

    protected $fillable = [
        'vehicle_model_id',
        'vehicle_id',
        'type',
        'name',
        'status',
        'version',
        'valid_untill',
        'firmwareFile',
        'upgradeDate',
        'schedule',
        'priority',
        'description'
    ];

    protected $casts = [
        'status' => FirmwareStatus::class,
        'type' => UpdateTypes::class,
    ];

    static $rules = [
        'vehicle_model_id'=> 'required',
        'vehicle_id'=> 'required',
        'type'=> 'required',
        'name'=> 'required',
        'status'=> 'required',
        'version'=> 'required|unique:firmwares,name',
        'valid_untill'=> '',
        'firmwareFile'=> 'required',
        'upgradeDate'=> '',
        'schedule'=> '',
        'priority'=> '',
        'description'=> ''
    ];

    /**
     * @return BelongsTo
     **/
    public function VehicleModel()
    {
        return $this->belongsTo(VehicleModel::class);
    }
    public function Vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle');
    }
}
