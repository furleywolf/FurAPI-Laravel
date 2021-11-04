<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TestTokenController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @param $request
     * @return Response
     */
    public function index(Request $request)
    {
        //
        $status = $request->input('decrypted');
        switch ($status){
            case 'success':
                $data = array('status' => $status,'qq'=>$request->input('user_id'),'time'=>$request->input('timestamp'));
                return $this->jsonResponse($data);
                break;
            case 'fail':
                return $this->jsonResponse(['Token invalid'],'Access Denied',403);
            case 'empty':
                return $this->jsonResponse(['Token missing'],'Unauthorized',401);
        }
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
