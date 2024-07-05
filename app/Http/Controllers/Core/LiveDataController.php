<?php

namespace App\Http\Controllers\Core;
use App\Enums\TroubleTypes;
use App\Http\Controllers\Controller;
use App\Models\FreezeFrame;
use App\Models\Monitor;
use App\Models\Session;
use Yajra\DataTables\Facades\DataTables;

class LiveDataController extends Controller
{
    public function index($id){
        return[
            "frames" => $this->getLatestFrames($id),
            "sensors" => $this->getSensorData($id),
            "confirmed_count" => $this->countConfirmedDTC($id),
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