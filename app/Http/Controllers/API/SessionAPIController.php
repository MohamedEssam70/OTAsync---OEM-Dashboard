<?php

namespace App\Http\Controllers\API;
use App\Enums\SessionStatus;
use App\Enums\TroubleTypes;
use App\Http\Controllers\Controller;
use App\Models\DTCs;
use App\Models\FreezeFrame;
use App\Models\Monitor;
use App\Models\Session;
use App\Models\Trouble;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SessionAPIController extends Controller{
    public function newSession(Request $request)
    {
        $vehicle = Vehicle::where('pin', $request->get('pin'))->first();
        if (!$vehicle) {
            return response()->json(['error' => 'Vehicle not found'], 404);
        }
        $session = new Session();
        $session->vehicle_id = $vehicle->id;
        $session->status = SessionStatus::Active;
        $session->save();

        $troubles = $request->get('troubles');
        // Parse the troubles
        if(!empty($troubles))
        {
            foreach($troubles as $troubleData)
            {
                $trouble = new Trouble();
                $trouble->session_id = $session->id;
                $trouble->dtc = DTCs::where('code', $troubleData['dtc'])->first()?->id;
                switch ($troubleData['type']) {
                    case 0:
                        $trouble->type = TroubleTypes::Confirmed;
                        break;
                    case 1:
                        $trouble->type = TroubleTypes::Pending;
                        break;
                    case 2:
                        $trouble->type = TroubleTypes::Permanent;
                        break;
                    default:
                        $trouble->type = TroubleTypes::Confirmed;
                        break;
                }
                $trouble->cleard = false;
                $trouble->save();
            }
        }

        $frames = $request->get('frames');
        // Parse the frames
        if(!empty($frames))
        {
            $freezeFrame = new FreezeFrame();
            $freezeFrame->session_id = $session->id;
            $freezeFrame->data = json_encode($frames);
            $freezeFrame->save();
        }

        $monitors = $request->get('monitors');
        // Parse the monitors
        if(!empty($monitors))
        {
            $sensorMonitor = new Monitor();
            $sensorMonitor->session_id = $session->id;
            $sensorMonitor->data = json_encode($monitors);
            $sensorMonitor->save();
        }


        return response()->json(['message' => 'New online diagnostic session stablished', 'session_id' => $session->id], 201);
    }

    public function clearDTC(Request $request)
    {
        $session = $request->get('session');
        $target = $request->get('target');
        if($target == 0)
        {
            $target_DTCs = Trouble::where('session_id', $session)->where('cleard', false)->get();
            foreach ($target_DTCs as $dtc) {
                $dtc->cleard = true;
                $dtc->save();
            }
        }
        else
        {
            // Clear a specific trouble by its id
            $trouble = Trouble::find($target);
            if ($trouble) {
                $trouble->cleard = true;
                $trouble->save();
            } else {
                return response()->json(['error' => 'Trouble not found'], 404);
            }
        }

        return response()->json(['message' => 'DTC(s) cleared successfully'], 200);
    }

    public function refreshDTCs(Request $request)
    {
        $session = Session::find($request->get('session'));
        if (!$session) {
            return response()->json(['error' => 'Session not found'], 404);
        }

        $troubles = $request->get('troubles');
        if (!empty($troubles)) {
            foreach ($troubles as $troubleData) {
                $DTC_id = DTCs::where('code', $troubleData['dtc'])->first()?->id;
                $exist = Trouble::where('session_id', $session->id)
                                ->where('dtc', $DTC_id)
                                ->where('cleard', false)
                                ->exists();
                if (!$exist) {
                    $trouble = new Trouble();
                    $trouble->session_id = $session->id;
                    $trouble->dtc = $DTC_id;
                    switch ($troubleData['type']) {
                        case 0:
                            $trouble->type = TroubleTypes::Confirmed;
                            break;
                        case 1:
                            $trouble->type = TroubleTypes::Pending;
                            break;
                        case 2:
                            $trouble->type = TroubleTypes::Permanent;
                            break;
                        default:
                            $trouble->type = TroubleTypes::Confirmed;
                            break;
                    }
                    $trouble->cleard = false;
                    $trouble->save();
                }
            }
        }

        $frames = $request->get('frames');
        if (!empty($frames)) {
            $freezeFrame = new FreezeFrame();
            $freezeFrame->session_id = $session->id;
            $freezeFrame->data = json_encode($frames);
            $freezeFrame->save();
        }

        return response()->json(['message' => 'DTCs and freezed frames refreshed successfully'], 200);
    }

    public function refreshMonitors(Request $request)
    {
        $session = Session::find($request->get('session'));
        if (!$session) {
            return response()->json(['error' => 'Session not found'], 404);
        }

        $monitors = $request->get('monitors');
        if(!empty($monitors))
        {
            $sensorMonitor = new Monitor();
            $sensorMonitor->session_id = $session->id;
            $sensorMonitor->data = json_encode($monitors);
            $sensorMonitor->save();
        }

        return response()->json(['message' => 'Monitor data refreshed successfully'], 200);
    }

    public function closeSession(Request $request)
    {
        $session = Session::find($request->get('session'));
        if (!$session) {
            return response()->json(['error' => 'Session not found'], 404);
        }
        $session->status = SessionStatus::Closed;
        $session->save();
        return response()->json(['message' => 'Session closed successfully'], 200);
    }

}