<script type="text/x-template" id="follow_user_button">
    <a class="btn btn-success"
       {{--v-bind:class="{'btn-success':followed}"--}}
       v-text="text"
       v-on:click="follow"
       style="margin-right: 10px"
           @if(!\Auth::check())
               href="/user/login"
            @endif
    >
    </a>
</script>

<script>
    Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#token').getAttribute('value');
    Vue.component('follow-user-button', {
        template: '#follow_user_button',
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
                return this.followed ? '已关注' : '关注他';
            }
        }
    })
    new Vue({
        el: "#app",
        data: {}
    })

</script>