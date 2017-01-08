{{--reply 模板--}}
<script type="text/x-template" id="reply-template">
    <div class="comment">
        <div class="parent-comment">
            <div class="meta-top">
                <a class="comment-avatar"><img :src="[comment.user.avatar]"></a>
                <p class="comment-user-name">
                    <a :href="nameUrl(comment.user.name)">@{{comment.user.name}}</a></p>
                <span class="reply-time">
                        <time>@{{comment.created_at}}</time>
                </span>
            </div>
            <p class="reply-content" v-html="comment.html_body">
            </p>
            <div class="comment-footer">
                    <span class="share-reply">
                    <a style="margin-right: 5px">分享</a> <i>|</i>
                        <i :data-userid="[comment.user_id]"
                           :data-username="[comment.user.name]"
                           :data-commentid="[comment.id]">
                        </i>
                    <a class="comment-reply" style="margin-left: 5px" onclick="clickReply(this)" @click="onreply()">回复</a>
                    </span>
            </div>
        </div>
        {{--@if(\App\Comment::where('to_comment_id',$comment->id)->first()?0:1)--}}
        <div class="child-comment-list">
            <div class="child-comment" v-for="commentChild in comments"
                 v-if="commentChild.to_comment_id==comment.id">
                <p>
                    <a class="main-user" :href="nameUrl(commentChild.user.name)">@{{commentChild.user.name}}</a>&nbsp;&nbsp;回复
                    <a class="commented-user" :href="nameUrl(commentChild.to_user.name)">@{{ commentChild.to_user.name }}</a>:
                    <p v-html="commentChild.html_body"></p>
                </p>
                <div class="child-comment-footer">
                        <span class="reply-time pull-left">
                            <time>@{{ commentChild.created_at }}</time>
                        </span>
                    <i
                            :data-userid="[commentChild.user_id]"
                            :data-username="[commentChild.user.name]"
                            :data-commentid="[comment.id]"></i>
                    <a class="child-comment-reply comment-reply"
                       onclick="clickReply(this)" @click="onreply()">回复</a>
                </div>
            </div>

            <div class="child-comment" v-for="newComment in commentLocal">
                <p>
                    <a class="main-user">@{{newComment.name}}</a>&nbsp;&nbsp;回复
                    <a class="commented-user">@{{newComment.to_user_name}}</a>:
                <p v-html="newComment.html_body"></p>
                </p>
                <div class="child-comment-footer">
                            <span class="reply-time pull-left">
                                <time>@{{newComment.created_at}}</time>
                            </span>
                    <i   :data-userid="[newComment.user_id]"
                         :data-username="[newComment.name]"
                         :data-commentid="[newComment.comment_id]">
                    </i>
                    <a class="child-comment-reply comment-reply"
                       onclick="clickReply(this)" @click="onreply()">回复</a>
                </div>
            </div>
        </div>
        {{--@endif--}}

        <div class="reply-form-container" v-if="is_reply">
            <div class="reply-form">
                {!! Form::open(['url'=>'/comment','v-on:submit'=>'onSubmitForm']) !!}
                <div class="reply-field">
                    {!! Form::textarea('body',null,['class' => 'form-control reply-info',':placeholder'=>'placeholder','v-model'=>'newComment.body']) !!}
                </div>
                <div class="btn btn-default reply-button cancel-reply" @click="cancelReply">
                取消回复
            </div>
            <button type="submit" class="btn btn-primary reply-button">发表回复</button>
            {!! Form::close() !!}
        </div>

    </div>
</script>