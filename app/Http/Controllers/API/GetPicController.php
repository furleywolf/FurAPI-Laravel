<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

use App\Http\Controllers\BaseController;
use DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class GetPicController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     *
     * @return Response
     */

    public function index()
    {
        //用于重定向返回图片地址
        $image = $this->getData();
        return $this->redirectResponse($image->url);
    }
    public function url()
    {
        //用于直接返回图片地址
        $image = $this->getData();
        return $this->urlResponse($image->url);
    }
    public function json()
    {
        //用于以json方式返回图片数据
        $image = $this->getData();
        return $this->jsonResponse([
            'id'=>$image->id,
            'title'=>$image->title,
            'description'=>$image->description,
            'from'=>$image->from,
            'fromurl'=>$image->fromurl,
            'tag'=>$image->tag,
            'url'=>$image->url,
            'addtime'=>$image->addtime,
            'r18'=>$image->r18,
            'class'=>$image->class,
            'imgtype'=>$image->imgtype,
        ]);
        return $this->jsonResponse(['test']);
    }
    private function getData()
    {
        //用于获取数据（后期需要优化随即查询SQL）
        $image = DB::table('furpic')
            ->select('*')
            ->from('furpic')
            ->orderByRaw('rand()')
            ->limit(1)
            ->first();
        return $image;
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
