<?php

namespace App\Http\Middleware;
use Closure;
use App;
class lang
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {   
        $lang='en';
        if(session('ngon_ngu')){
            $lang = session('ngon_ngu');
        }
        App::setlocale($lang);

        return $next($request);
    }
}
