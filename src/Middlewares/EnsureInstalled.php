<?php

namespace Azuriom\Plugin\Dofus129\Middlewares;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Event;

class EnsureInstalled
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (setting('dofus129_installed')) {
            return $next($request); // Already installed
        }

        if ($request->routeIs('dofus129.install.*') || $request->is('_debugbar/*')) {
            return $next($request);
        }

        return redirect()->route('dofus129.install.index');
    }
}
