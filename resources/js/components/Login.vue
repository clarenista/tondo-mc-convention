<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="alert alert-success" role="alert" v-if="isLoginSuccess">
                    Login success.
                </div>
                <div class="alert alert-danger" role="alert" v-if="isLoginSuccess == false">
                    Login failed. E-mail or password not found.
                </div>
                
                <div class="card border-primary mb-3" >
                    <div class="card-header">User Login</div>
                    <div class="card-body">
                        <form method="POST" @submit.prevent="handleSubmit">
                            <div class="col">
                                <div class="form-group">
                                    <input 
                                        type="email" 
                                        class="form-control" 
                                        placeholder="Email Address *"
                                        v-model="text_email"
                                        required
                                    >
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <input 
                                            :type="isSeePassword ? 'text' : 'password'" 
                                            class="form-control" 
                                            placeholder="Password *"
                                            v-model="text_password"
                                            required
                                        >
                                        <div class="input-group-append" @click="toggleSeePassword">
                                            <span class="input-group-text" id="my-addon"><i :class="isSeePassword ? 'fa fa-eye' : 'fa fa-eye-slash'"></i></span>
                                        </div>
                                    </div>
                                </div>             
                                <div class="form-group">
                                    <button class="btn btn-primary">Login</button>
                                </div>
                            </div>                            
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
            // console.log(this.$store.getters.pois)
        },
        data(){
            
            return{
                text_email: "",
                text_password: "",
                isLoginSuccess: null,
                isSeePassword: false
            }
        } ,
        watch:{
            
        },

        methods:{
            async handleSubmit(){
                this.isLoginSuccess = null
                // if(this.errors){
                //     return false
                // }
                let fd = new FormData()
                fd.append('email', this.text_email)
                fd.append('password', this.text_password)
                let {data} = await axios.post('/api/v1/login', fd)
                if(data.status === 'ok'){
                    this.isLoginSuccess = true
                    this.$store.commit('changeUser', data.user)
                    if(data.user.role == 1){
                        this.$router.push('/registration')
                    }else if(data.user.role == 2)
                        this.$router.push('/boothman')
                }else{
                    this.isLoginSuccess = false
                }
            },
            toggleSeePassword(){
                this.isSeePassword = !this.isSeePassword
            }
        }

    }
</script>

<style>

</style>