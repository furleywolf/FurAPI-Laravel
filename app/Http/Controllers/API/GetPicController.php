<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

use App\Http\Controllers\BaseController;
use DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\Console\Input\Input;


class GetPicController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     *
     * @param string $type
     * @param string $class
     * @return Response
     */

    public function index($type = 'redirect',$class = 'random')
    {
        $valid_type=array(['url','json','redirect']);
        $valid_class=array(['m','pc','fursuit']);
        $acg_class=array(['m','pc']);
        //用于重定向返回图片地址
        if($class == 'random')$class=$valid_class[0][array_rand($valid_class[0])];
        if($class == 'acg')$class=$acg_class[0][array_rand($acg_class[0])];
//        if($class == 'random')$class='pc';
        if(in_array($type,$valid_type))return $this->jsonResponse(['error'],"不支持的返回类型",415);
        if(in_array($class,$valid_class))return $this->jsonResponse(['error'],"不支持的图片种类",400);
        $image = $this->getData($class);
        switch ($type){
            case 'redirect':
                return $this->redirectResponse($image->url);
                break;
            case 'json':
                return $this->json($image);
                break;
            case 'url':
                return $this->urlResponse($image->url);
                break;
            default:
                return $this->jsonResponse(['error'],"不支持的返回类型",415);
                break;
        }
    }

    private function url($image)
    {
        //用于直接返回图片地址

        return $this->urlResponse($image->url);
    }
    private function json($image)
    {
        //用于以json方式返回图片数据

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
    private function getData($class)
    {
        //用于获取数据（后期需要优化随即查询SQL）
        $table='furpic_'.$class;
        $query = DB::table($table);
        $return=$query->join(
            DB::raw("(SELECT ROUND(RAND() * ((SELECT MAX(id) FROM `$table`)-(SELECT MIN(id) FROM `$table`))+(SELECT MIN(id) FROM `$table`)) AS xid) as t2"),
            $table.'.id', '>=', 't2.xid'
        )->limit(1)->get();
return $return->first();
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
