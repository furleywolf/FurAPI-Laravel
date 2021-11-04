<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use GuzzleHttp;

class RemoteAuth
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     * @throws GuzzleHttp\Exception\GuzzleException
     */
    public function handle(Request $request, Closure $next)
    {
        $token = $request->route('token');
        if(!empty($token)) {
            $authServer = config('app.authServer');
            $http = new GuzzleHttp\Client;
            try {
                $authResponse = $http->get($authServer.$token);
            }catch (GuzzleHttp\Exception\ClientException $e){
                $authResponse =  $e->getResponse();
            }

            $res = json_decode( $authResponse->getBody(), true);

            if($res['code'] == 200) {
                $qq = $res['data']['qq'];
            };

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
