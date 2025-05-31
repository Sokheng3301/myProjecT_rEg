<?php

namespace App\Http\Middleware;

use App\Models\Year;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AutoAppMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // dd("hi");
        // Increa years 
        $max_year = Year::max('year');

        if ($max_year === null) {
            // Upgrade for 4 years once
            for ($y = now()->year; $y < now()->year + 4; $y++) {
                Year::create(['year' => $y]);
            }
        } else {
            if (now()->year > $max_year) {
                for ($y = now()->year; $y < now()->year + 4; $y++) {
                    Year::create(['year' => $y]);
                } 
            }
        }
        // dd($max_year);


        return $next($request);
    }
}
