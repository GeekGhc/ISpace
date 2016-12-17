<?php

namespace App\Http\Controllers\Home;

//require  'path_to_sdk/vendor/autoload.php';

use App\Comment;
use Qiniu\Auth;
use App\VideoSerie;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SeriesController extends Controller
{
    public function videoSeriesList($series_name)
    {
        $video_serie = VideoSerie::where('name', $series_name)->first();
        $videos = $video_serie->videos;
        return view('video.index', compact('video_serie', 'videos'));
    }

    public function videoPlay($series_name, $video_index)
    {
        $video_series = VideoSerie::where('name', $series_name)->first();
        $video_count = $video_series->videos->count();
        $video = $video_series->videos->get($video_index-1);

        $favorite = Favorite::where('favoriteable_type','App\Discussion')->where('favoriteable_id',$video->id)->first();
        if(\Auth::check()){
            if($favorite){
                $isFavorite = \Auth::user()->id==$favorite->user_id;
                if(!$isFavorite){$isFavorite = 0;}
            }else{
                $isFavorite = 0;//未收藏
            }
        }else{
            $isFavorite = 2;//游客状态
        }

        $comments = Comment::with('user')->with('to_user')->where('commentable_type','App\Video')->where('commentable_id',$id)->get();
        return view('video.play',compact('video','video_index','video_count','video_series','isFavorite','comments'));
    }

    public function videoDownload()
    {
        ob_start();
//        $filename='http://gehuachun.com/css/style.css?e=1481607652&token=mYCTBTi0IazyX3UvKIy0j4mTkSn9-GNSHDFyg8Fg:X3D_NGE64GtBVu8kydajwS23dvE=';
//        $filename='http://gehuachun.com/images/page/work.jpg?e=1481616312&token=mYCTBTi0IazyX3UvKIy0j4mTkSn9-GNSHDFyg8Fg:IQIxatTV_7VF5EuNUp-NRZNU15M=';
        $filename='http://gehuachun.com/1554.mp4?e=1481626596&token=mYCTBTi0IazyX3UvKIy0j4mTkSn9-GNSHDFyg8Fg:iJeXZrFuPwgb9vYaK4WQbxADuKU=';
        $date=date("Ymd-H:i:m");
        header( "Content-type:   application/octet-stream ");
        header( "Accept-Ranges:   bytes ");
        header( "Content-Disposition:   attachment;   filename= {$date}.mp4");
        $size=readfile($filename);
        header( "Accept-Length: " .$size);


        // 需要填写你的 Access Key 和 Secret Key
       /* $accessKey = 'mYCTBTi0IazyX3UvKIy0j4mTkSn9-GNSHDFyg8Fg';
        $secretKey = 'PDsiO4d-BBqTs1v6rsqlmwP9a0vg1SX4wSDR8inM';

        // 构建鉴权对象
        $auth = new Auth($accessKey, $secretKey);

        //baseUrl构造成私有空间的域名/key的形式
        $baseUrl = 'http://gehuachun.com/1554.mp4';
        $authUrl = $auth->privateDownloadUrl($baseUrl);
        echo $authUrl;*/
    }
}
