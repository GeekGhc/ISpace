$(function(){
    Vue.http.headers.common['X-CSRF-TOKEN'] =   document.querySelector('#token').getAttribute('value');
    new Vue({
        el: '#comment-post',
        data: {
            comments: [],
            newComment: {
                'name':'{{Auth::user()->name}}',
                'avatar':'{{Auth::user()->avatar}}',
                'toUserId':'',
                'create_time':'',
                'comment_id':'',
                'body':''
            },
            newPost:{
                'discussion_id':'{{$discussion->id}}',
                'toUserId':'',
                'create_time':'',
                'comment_id':'',
                'body':''
            },

        },
        methods:{
            onDiscussionForm:function(e){
                e.preventDefault();//点击发表评论后不会跳转到路由中
                var comment = this.newComment;
                var post = this.newPost;
                post.body = comment.body;
                this.$http.post('/comment',post).then(function(){
                    this.comments.push(comment)
                });
                this.newComment =  {
                    'name':'{{Auth::user()->name}}',
                    'avatar':'{{Auth::user()->avatar}}',
                    'toUserId':'',
                    'create_time':'',
                    'comment_id':'',
                    'body':''
                };
            },
            onCommentForm:function(e){
                e.preventDefault();//点击发表评论后不会跳转到路由中
                var comment = this.newComment;
                var post = this.newPost;
                post.body = comment.body;
                this.$http.post('/comment',post).then(function(){
                    this.comments.push(comment)
                });
                this.newComment =  {
                    'name':'{{Auth::user()->name}}',
                    'avatar':'{{Auth::user()->avatar}}',
                    'toUserId':'',
                    'create_time':'',
                    'comment_id':'',
                    'body':''
                };
            }
        }
    });
});