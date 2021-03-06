<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;

class PutPicController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @param $class
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request ,$token ,$class)
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
        if($this->putData($class,
            $request->input('url'),
            $request->input('title'),
            $request->input('description'),
            $request->input('from'),
            $request->input('fromurl'),
            $request->input('tag'),
            $request->input('imgtype'),
            $request->input('user_id')
        ))return $this->jsonResponse(['操作成功']);

    }
    private function putData($class,$url,$title = null,$description= null,$from = null,$fromurl=null,$tag=null,$imgtype='acg',$uploader=null){
        $table=DB::table('furpic_'.$class);
        $table->insert([
            'class' =>$class,
            'title'=>$title,
            'url' => $url,
            'description'=>$description,
            'from'=>$from,
            'fromurl'=>$fromurl,
            'tag'=>json_encode($tag),
            'imgtype'=>$imgtype,
            'uploader'=>$uploader
        ]);
        return true;
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
