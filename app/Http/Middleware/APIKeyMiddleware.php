<?php

namespace App\Http\Middleware;

use App\Models\Vehicle;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class APIKeyMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $apiKeyIsValid = false;

        $vehicle_vin = $request->header('x-vehicle-vin');
        if(!empty($vehicle_vin))
        {
            $apiKey = Vehicle::where('vin', $vehicle_vin)->first()?->apiKeys()?->pluck('key')?->toArray() ?? [];

            $apiKeyIsValid = (
                ! empty($apiKey)
                && in_array($request->header('x-api-key'), $apiKey)
            );
        }

        abort_if (! $apiKeyIsValid, 403, 'Access denied');

        return $next($request);
    }
}
