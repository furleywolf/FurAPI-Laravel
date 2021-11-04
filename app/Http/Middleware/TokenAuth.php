<?php

namespace App\Http\Middleware;

use Closure;
use Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Redis;
use Illuminate\Http\Request;
use function Doctrine\Common\Cache\Psr6\get;

class TokenAuth
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

        $token = $request->route('token');
        if(!empty($token)) {
            config(['database.redis.options.prefix' => 'Auth_']);
            $qq = Redis::get('token');
            if(empty($qq)){
                $decrypt='fail';
            }else{
                $decrypt='success';
                $mid_params['user_id']=$qq;
                $mid_params['timestamp']=time();
            }
        }else{
            $decrypt='empty';
        }
        $mid_params['decrypted'] = $decrypt;
        $request->merge($mid_params);
        return $next($request);
    }
}
