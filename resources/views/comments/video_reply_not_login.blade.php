<script>
    //点击回复
    function clickReply(obj) {
    }
    $(function () {
        $('.comment-reply').attr('href', '/user/login');
    })
    Vue.component('reply-form', {
        template: '#reply-template',
        props: ['comments', 'comment'],
        data: function () {
            return {
                is_reply: false,
                commentLocal: [],
            }
        },
        methods: {
            onreply: function () {
            },
        }
    })
    new Vue({
        el: '#app',
        data: {
            ifPrev:'',
            ifNext:'',
            videoIndex:'{{$video_index}}',
            commentLocalMain: [],
        },
        computed:{
            ifPrev:function(){
                if(this.videoIndex==="1"){
                    return 'ifPrev';
                }
            },
            ifNext:function(){
                if(this.videoIndex==="{{$video_count}}"){
                    return 'ifNext';
                }
            }
        },
    })
</script>