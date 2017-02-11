@extends("app")

@section('title','ISpace Community 音乐电台')
@section('header-css')
    <link rel="stylesheet" href="/css/broadcasts.css">
@endsection

@section("content")
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2 donate-body">
                <div class="donate-header">
                    <h1>打赏</h1>
                    <p>如果你觉得本站会对你有所帮助 请在物质上给予本站一定的帮助 这样我也会更有动力去更好的提供更好的服务 在此谢过了~</p>
                </div>
                <div>
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#5yuan" aria-controls="5yuan" role="tab" data-toggle="tab">￥5</a></li>
                        <li role="presentation"><a href="#10yuan" aria-controls="10yuan" role="tab" data-toggle="tab">￥10</a></li>
                        <li role="presentation"><a href="#20yuan" aria-controls="20yuan" role="tab" data-toggle="tab">￥20</a></li>
                        <li role="presentation"><a href="#30yuan" aria-controls="50yuan" role="tab" data-toggle="tab">￥50</a></li>
                        <li role="presentation"><a href="#otherYuan" aria-controls="otherYuan" role="tab" data-toggle="tab">其他金额</a></li>
                    </ul>
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active donate-panel" id="5yuan">
                            <div class="ui grid">
                                <div class="eight wide column">
                                    <img src="/images/donate/alipay-5.jpg">
                                </div>
                                <div class="eight wide column">
                                    <img src="/images/donate/wechat-5.jpg">
                                </div>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane donate-panel" id="10yuan">
                            <div class="ui grid">
                                <div class="eight wide column">
                                    <img src="/images/donate/alipay-10.jpg">
                                </div>
                                <div class="eight wide column">
                                    <img src="/images/donate/wechat-10.jpg">
                                </div>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane donate-panel" id="20yuan">
                            <div class="ui grid">
                                <div class="eight wide column">
                                    <img src="/images/donate/alipay-20.jpg">
                                </div>
                                <div class="eight wide column">
                                    <img src="/images/donate/wechat-20.jpg">
                                </div>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane donate-panel" id="50yuan">
                            <div class="ui grid">
                                <div class="eight wide column">
                                    <img src="/images/donate/alipay-50.jpg">
                                </div>
                                <div class="eight wide column">
                                    <img src="/images/donate/wechat-50.jpg">
                                </div>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane donate-panel" id="otherYuan">
                            <div class="ui grid">
                                <div class="eight wide column">
                                    <img src="/images/donate/alipay.jpg">
                                </div>
                                <div class="eight wide column">
                                    <img src="/images/donate/wechat.jpg">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection