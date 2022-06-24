<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Admin Login</div>
                    <div class="card-body">
                        <form @submit.prevent="adminLogin">
                            <div class="form-group">
                                <label>E-mail</label>
                                <input type="text" class="form-control" v-model="user_info.username">
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" v-model="user_info.password">
                            </div>
                            <button type="submit" class="btn btn-primary">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
          mounted() {
            // if(localStorage.getItem('project_access_token')){
            //     this.$router.push({ name: 'dashboard' })
            // }
        },
        data() {
            return {
                user_info: {
                    username:"",
                    password:"",
                }
            }
        },
        methods: {
            adminLogin() {
                let {username,password} = this.user_info;
                let data = {
                    'username':username,
                    'password':password,
                    'client_id':22,
                    'client_secret':'nFj5cxnFztekOQFRYnlozRAIHPiQd4zUHZTdxYhM',
                    'grant_type':'password'
                }
                this.axios
                    .post(`${process.env.MIX_API_END_POINT}/oauth/token`, data)
                    .then(response => {
                            let {data:{access_token}} = response;
                            if(access_token){
                                localStorage.setItem('project_access_token',access_token)
                                this.$router.push({ name: 'dashboard' })
                            }
                    })
                    .catch(err => console.log(err))
                    .finally(() => this.loading = false)
            }
        }
    }
</script>