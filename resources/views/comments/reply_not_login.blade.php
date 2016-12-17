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
            commentLocalMain: [],
        }
    })
</script>