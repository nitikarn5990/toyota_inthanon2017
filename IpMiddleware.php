<?php

namespace App\Http\Middleware;

use Closure;
use Request;
Use App\Services\View;

class IpMiddleware
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


        if (Request::ip() == '127.0.0.1'
            || Request::ip() == 'localhost'
            || Request::ip() == '180.183.157.86' //พี่เหมี่ยว
            || Request::ip() == '180.183.249.79' //ตัวเอง
            || Request::ip() == '49.230.233.250' //พี่เหมี่ยว
            || Request::ip() == '27.55.219.251' //ตัวเอง
            || Request::ip() == '10.0.28.121' //ตัวเอง


        ){

            return $next($request);
        }else{
            //dd(Request::ip());

            return redirect('soon');
//            return view('web.web_master_default');

        }

    }
}
