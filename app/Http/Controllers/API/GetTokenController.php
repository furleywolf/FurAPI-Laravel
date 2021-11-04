<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use Crypt;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class GetTokenController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @param $qq
     * @return Response
     */
    public function index($qq)
    {
        //
//        config(['app.cipher' => 'AES-128-CBC']);
//        config(['app.key'=>'base64:QUNqWnZNS1o4YnlvVEVEUQ==']);
        $value = config('database.redis.options.prefix');
        $time = time();
        $return = json_encode([$qq,$time]);
        $returns[]=['token'=>Crypt::encryptString($return)];
        $returns[]=['cipher'=>$value];
        return $this->jsonResponse($returns);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
