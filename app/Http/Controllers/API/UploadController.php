<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use Facade\FlareClient\Stacktrace\File;
use Illuminate\Http\Request;
use DB;
use Storage;

class UploadController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $status = $request->input('decrypted');
        switch ($status){
            case 'success':
                break;
            case 'fail':
                return $this->jsonResponse(['Token invalid'],'Access Denied',403);
                break;
            case 'empty':
                return $this->jsonResponse(['Token missing'],'Unauthorized',401);
                break;
            default :
                return $this->jsonResponse(['Authenticate failed'],'Access Denied',403);
                break;
        }
        $validator = \Validator::make($request->all(), [
            'file' => 'required|max:5096|image'
        ]);
        if ($validator->fails()) {
            return $this->jsonResponse(['Image incorrect'],'Access Denied',403);
        }
        $path = $request->file('file')->store(date('Ym'),'public');
        $this->putSQL($path,$request->input('user_id'));
        return $this->jsonResponse(['url'=>config('app.url')."/FurPic/".$path,"time"=>time()],"操作成功");

    }

    private function putSQL($file,$qq){
        $table=DB::table('file');
        $table->insert([
            'file' =>$file,
            'qq' => $qq
        ]);
        return true;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
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
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
