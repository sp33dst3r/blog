<?php

namespace App\Http\Middleware;
use Browser;
use Closure;
use App\Visitor;
class Visitors
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public $validator = [
        'ip' => 'required|regex:/[A-ZА-Яa-zа-я]+ [A-ZА-Яa-zа-я]+/',
        'content' => 'required',
    ];
    public function handle($request, Closure $next)
    {
        $browser = Browser::browserFamily();
        $ip = $_SERVER['REMOTE_ADDR'];
        $visitor = Visitor::where(["visitor"=>$ip])->first();
        if(!$visitor){
            $visitor = new Visitor();
            $visitor->visitor = $ip;
            $visitor->browser = $browser;
            $visitor->save();
        }



        return $next($request);
    }
}
