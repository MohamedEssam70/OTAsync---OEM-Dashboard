<?php

namespace App\Jobs;

use App\Enums\SessionStatus;
use App\Models\Session;
use App\Models\Vehicle;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CheckVehicleAvailability implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Session::whereIn('vehicle_id', Vehicle::whereNull('keepalive')->orWhere('keepalive', '<', Carbon::now()->subMinutes(2))->pluck('id'))
                ->where('status', SessionStatus::Active)->update(["status" => SessionStatus::Closed]);
    }
}
