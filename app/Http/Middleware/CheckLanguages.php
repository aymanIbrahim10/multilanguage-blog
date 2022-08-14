<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckLanguages
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $languages = array_keys(config('app.avaiable_lang'));
        if($request->hasHeader('lang') && in_array($request->header('lang'), $languages)){
            app()->setlocale($request->header('lang'));
        }
        return $next($request);
    }
}
