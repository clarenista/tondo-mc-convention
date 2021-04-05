<template>
<div class="background full">
    <div class="register">
        <div class="row col-10">
            <div class="col-md-6 register-left">
                <img src="/images/logo.png" alt=""/>
                <h3 class="lead text-white">Welcome</h3>
                <p class="lead text-white">Philippine Society of Pathologists, Inc. Virtual Event</p>
            </div>

            <div class="col-md-6 register-right">
                <div class="tab-content" id="myTabContent">
                    <div class="alert alert-success" role="alert" v-if="isLoginSuccess">
                        Login successs.
                    </div>
                    <div class="alert alert-danger" role="alert" v-if="isLoginSuccess == false">
                        Login failed. E-mail or password not found.
                    </div>

                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <h3 class="register-heading display-4 text-light">Sign In</h3>
                        <div class="row register-form justify-content-center align-items-center">
                            <div class="col-lg-10 col-sm-12">
                                <form method="POST" @submit.prevent="handleSubmit">
                                        <div class="form-group">
                                            <input 
                                                type="text" 
                                                class="form-control text-center" 
                                                placeholder="Username"
                                                v-model="text_email"
                                                required
                                            >
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <input 
                                                    :type="isSeePassword ? 'text' : 'password'" 
                                                    class="form-control text-center" style="padding-left: 70px;" 
                                                    placeholder="Password"
                                                    v-model="text_password"
                                                    required
                                                >
                                                <div class="input-group-append" @click="toggleSeePassword">
                                                    <span class="input-group-text" id="my-addon"><i :class="isSeePassword ? 'fa fa-eye' : 'fa fa-eye-slash'"></i></span>
                                                </div>
                                            </div>
                                        </div>             
                                        <div class="form-group align-middle">
                                            <button class="btn btn-light btn-lg btn-block text-success">
                                                <i class="fa fa-user"></i> Login</button>
                                        </div>
                                </form>
                            </div>                            
                        </div>
                    </div>
                    
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
                let {data} = await axios.post('/api/login', fd)
                if(data.status === 'ok'){
                    this.isLoginSuccess = true
                    this.$emit('isLoginSuccess', this.isLoginSuccess);
                    this.$store.commit('changeUser', data.user)
                    localStorage.setItem("access_token", data.access_token);
                    this.$router.push('/')
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

<style scoped>
div >>> .register{
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
}
div.background {
  height: 100%;
  top: 0;
  left: 0;
}

div.full{
  height: 100%;
}
.register{
    overflow: hidden;
    /* background: -webkit-linear-gradient(left, #18a01f, #12ff75); */
    padding: 3%;
    
}
.register-left{
    text-align: center;
    color: #fff;
    margin-top: 4%;
}
.register-left input{
    border: none;
    border-radius: 1.5rem;
    padding: 2%;
    width: 60%;
    background: #f8f9fa;
    font-weight: bold;
    color: #383d41;
    margin-top: 30%;
    margin-bottom: 3%;
    cursor: pointer;
}
.register-right{
    text-align: center;
    align-items: center;
    background-image: linear-gradient(180deg,  #d2ffe9, #d0dee7);
    background: rgba(210,255,233, 0.2);
    /* opacity: 0.7; */
}
.register-left img{
    margin-top: 15%;
    margin-bottom: 5%;
    width: 50%;
}
@-webkit-keyframes mover {
    0% { transform: translateY(0); }
    100% { transform: translateY(-20px); }
}
@keyframes mover {
    0% { transform: translateY(0); }
    100% { transform: translateY(-20px); }
}
.register-left p{
    font-weight: lighter;
    padding: 12%;
    margin-top: -9%;
}
.register .register-form{
    padding: 10%;
    margin-top: 10%;
}
.btnRegister{
    float: right;
    margin-top: 10%;
    border: none;
    border-radius: 1.5rem;
    padding: 2%;
    background: #0062cc;
    color: #fff;
    font-weight: 600;
    width: 50%;
    cursor: pointer;
}
.register .nav-tabs{
    margin-top: 3%;
    border: none;
    background: #0062cc;
    border-radius: 1.5rem;
    width: 28%;
    float: right;
}
.register .nav-tabs .nav-link{
    padding: 2%;
    height: 34px;
    font-weight: 600;
    color: #fff;
    border-top-right-radius: 1.5rem;
    border-bottom-right-radius: 1.5rem;
}
.register .nav-tabs .nav-link:hover{
    border: none;
}
.register .nav-tabs .nav-link.active{
    width: 100px;
    color: #0062cc;
    border: 2px solid #0062cc;
    border-top-left-radius: 1.5rem;
    border-bottom-left-radius: 1.5rem;
}
.register-heading{
    text-align: center;
    margin-top: 8%;
    margin-bottom: -15%;
    color: #495057;
}

.btn-light {
    border: 1px solid #cfcfcf;
}
.btn-light:hover {
    background: #4c748c;
}
.lead{
    text-shadow: 0 2px 3px #000;
}

</style>