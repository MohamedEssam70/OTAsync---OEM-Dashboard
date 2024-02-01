<?php

namespace App\Models;

use App\Enums\FirmwareStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Firmware extends Model
{
    protected $table = "firmwares";

    protected $fillable = [
        'vehicle_model_id',
        'name',
        'status',
        'version',
        'valid_untill',
    ];

    protected $casts = [
        'status' => FirmwareStatus::class,
    ];


    /**
     * @return BelongsTo
     **/
    public function VehicleModel()
    {
        return $this->belongsTo(VehicleModel::class);
    }
}
