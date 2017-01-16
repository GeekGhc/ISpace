<script type="text/x-template" id="article_follow_user_button">
    <button class="button ui  follow"
            v-bind:class="{'linkedin':followed}"
            v-html="text"
            v-on:click="follow"
    >
    </button>

   {{-- <div class="button ui green follow">
            <i class="fa fa-heart"></i><span>关注作者</span>
    </div>--}}
</script>

<script>
    Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#token').getAttribute('value');
    Vue.component('article-follow-user-button', {
        template: '#article_follow_user_button',
        props: ['user_id'],
        mounted() {
            this.$http.get('/api/user/followers/' + this.user_id).then(response => {
                console.log('followed =  ' + response.data.followed);
                this.followed = response.data.followed;
            })
        },
        data(){
            return {
                followed: false,
            }
        },
        methods: {
            follow(){
                this.$http.post('/api/user/follow', {'user': this.user_id}).then(response => {
                    this.followed = response.data.followed;
                    console.log(response.data);
                })
            }
        },
        computed: {
            text(){
                return this.followed ? '<i class="fa fa-plus"></i><span>已关注</span>' : '<i class="fa fa-plus"></i><span>关注作者</span>';
            }
        }
    })
</script>