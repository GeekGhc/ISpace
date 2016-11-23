@extends('app')
@section('title','社区')
@section('content')
    <div class="hero-header">
        <div class="container">
            <div class="col-md-6 col-md-offset-3 hero-header-title">
                <p>Become a Part of  ISpace Community</p>
                <h3></h3>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="main col-md-9 col-xs-12">

                <div class="stream-list">
                    <dt>
                        <a><img class="user-header" src="/images/avatar/default.png" class="img-circle"></a>
                        <a class="nickname">jellybean</a>
                    </dt>
                    <dd>
                        <h3 class="discussion-list_title">
                            <a>实现Android5.0过渡动画兼容库</a>
                        </h3>
                        <div class="discussion-list_content">
                            Android5.0之后为我们提供了许多炫酷的界面过渡效果，
                            其中共享元素过渡也是很有亮点的一个效果，但这个效果只能在Android5.0之后使用，
                            那今天我们就来将共享元素过渡效果兼容到Android4...
                        </div>
                        <div class="discussion-list_footer">
                            <div class="tagsLabel">
                                <ul>
                                    <li class="tagLabel php"><span class="taglabel-text">php</span></li>
                                    <li class="tagLabel php"><span class="taglabel-text">laravel</span></li>
                                    <li class="tagLabel php"><span class="taglabel-text">mysql</span></li>
                                </ul>
                            </div>
                            <div class="others-info fr">
                                <div class="discussion_published_at"><label>6分钟前</label></div>
                                <div class="discussion_view_count"><i class="fa fa-eye"></i><em>89</em></div>
                                <div class="discussion_comment_count"><i class="fa fa-comment"></i><em>234324</em></div>
                            </div>
                        </div>
                    </dd>
                </div>

            </div>
            <div class="col-md-3 col-xs-12">
                <div class="weight-messages">
                    <a class="weight-messages_item">我的主页</a>
                    <a class="weight-messages_item">我的文章</a>
                    <a class="weight-messages_item">我的笔记</a>
                    <a class="weight-messages_item">我的提问</a>
                    <a class="weight-messages_item">我的回答</a>
                </div>
            </div>
        </div>
    </div>
   {{-- <script>
        $('#flash-overlay-modal').modal();
        $('div.alert').not('.alert-important').delay(3000).fadeOut(350);
    </script>--}}
@endsection