<?php

namespace App\Http\Controllers;



use Illuminate\Http\Response;

class BaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected function jsonResponse($data, $msg = '' ,$code = 200) :Response{
        $result = [
            'code' => $code,
            'msg' => $msg,
            'data' => $data
        ];
        return response($result,$code);

    }
    protected function urlResponse($data){
        return $data;

    }
    protected function redirectResponse($url) {
        return response()->redirectTo($url);
    }
}
