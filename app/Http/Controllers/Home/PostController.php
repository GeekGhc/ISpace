<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use YuanChao\Editor\EndaEditor;

use App\Http\Requests;

class PostController extends Controller
{
    public function upload()
    {
        //设置上传图片存放的路径
        $data = EndaEditor::uploadImgFile('uploads');

        return json_encode($data);
    }
}
