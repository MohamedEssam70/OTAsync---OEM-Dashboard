<?php

namespace App\Http\Controllers\Core;
use App\Enums\SessionStatus;
use App\Enums\TroubleTypes;
use App\Http\Controllers\Controller;
use App\Models\FreezeFrame;
use App\Models\Monitor;
use App\Models\Session;
use App\Models\Trouble;
use Yajra\DataTables\Facades\DataTables;

class LiveDataController extends Controller
{
    public function index($id){
        return[
            "isActive" => $this->isActive($id),
            "counter" => $this->counter($id),
            "frames" => $this->getLatestFrames($id),
            "sensors" => $this->getSensorData($id),
            "confirmed" => $this->confirmedQuery($id),
            "pending" => $this->pendingQuery($id),
            "logs" => $this->logsQuery($id),
        ];
    }

    public function isActive($id)
    {
        return Session::find($id)->status == SessionStatus::Active;
    }

    public function counter($id)
    {
        $session = Session::find($id);
        $confirmed = $session->troubles->where('cleard', false)->where('type', TroubleTypes::Confirmed)->count();
        $dtcs = $session->troubles->count();
        $monitors = $session->last_monitor()?->count_sensors();
        $frames = $session->last_frame()?->count_frames();
        return[
            'confirmed' => $confirmed,
            'dtcs' => $dtcs,
            'monitors' => $monitors,
            'frames' => $frames,
        ];
    }

    public function getLatestFrames($id)
    {
        $frames = Session::find($id)->get_updated_frames();
        if(!empty($frames)){
            return $frames;
        }
        return [];
    }

    public function countConfirmedDTC($id)
    {
        return Session::find($id)->troubles->where('cleard', false)->where('type', TroubleTypes::Confirmed)->count();
    }

    public function confirmedQuery($id)
    {
        return Trouble::where('session_id', $id)
                ->where('cleard', false)
                ->where('type', TroubleTypes::Confirmed)
                ->with('dtcs')
                ->get();
    }

    public function pendingQuery($id)
    {
        return Trouble::where('session_id', $id)
                ->where('cleard', false)
                ->where('type', TroubleTypes::Pending)
                ->with('dtcs')
                ->get();
    }

    public function logsQuery($id)
    {
        return Trouble::where('session_id', $id)
                ->with('session')
                ->with('dtcs')
                ->get();
    }
    
    public function getSensorData($id)
    {
        $monitor = Session::find($id)->last_monitor()?->data;
        $result = [
            'table' => [],
            'graph' => []
        ];
        if(!empty($monitor))
        {
            $data = json_decode($monitor, true);
            foreach ($data as $sensor) {
                $values = $sensor['values'];
                $processedData = [
                    'pid' => $sensor['pid'],
                    'description' => $sensor['discription'],
                    'val' => $values[0],
                    'min' => min($values),
                    'max' => max($values),
                    'avg' => round(array_sum($values) / count($values), 2),
                    'unit' => $sensor['unit']
                ];
    
                $result['table'][] = $processedData;
                $result['graph'][] = ['name' => $sensor['name'], 'values' => $values];
            }
        }

        return $result;
    }
}