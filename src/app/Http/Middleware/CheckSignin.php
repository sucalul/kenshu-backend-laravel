<?php

namespace App\Http\Middleware;

use Closure;
use App\Exceptions\ForbiddenException;

class CheckSignin
{
    /**
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (is_null($request->user())) {
            throw new ForbiddenException('ログインが必要です');
        }

        return $next($request);
    }
}
