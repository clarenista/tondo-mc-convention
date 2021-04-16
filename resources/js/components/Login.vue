<template>
<div class="background full">
    <div class="register">

        <button class="btn btn-primary btn-sm" @click="handleToggleBgMusic" type="button" style="position: fixed; top: 0; left: 0; margin:1em;">
            <i class="fa fa-volume-up" v-if="!$store.getters.bgmStart"></i>
            <i class="fa fa-volume-off" v-else></i>
        </button>

        <div class="row col-10">
            <div class="register-left col-md-6 ">

                <img src="/images/logo.png" alt=""/>
                <!-- <h3 class="lead text-white">Welcome</h3> -->
                <p class="text-white">PHILIPPINE SOCIETY OF PATHOLOGIST, INC. <br>VIRTUAL EVENT</p>
            </div>

            <div class="register-right col-md-6" v-if="start_at">
                <Timer class="register-form" :endTime="start_at" @handleTimerEnd="handleTimerEnd" v-if="!isOpen"></Timer>
                <div v-else  class="tab-content" id="myTabContent">
                    <div class="alert alert-success" role="alert" v-if="isLoginSuccess">
                        Login successs.
                    </div>
                    <div class="alert alert-danger" role="alert" v-if="isLoginSuccess == false">
                        Login failed. E-mail or password not found.
                    </div>

                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <h3 class="register-heading display-3 text-light">Sign In</h3>
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
                                                    class="form-control text-center" id="txtpassword"
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
    import Timer from './Timer.vue'
    export default {
        components:{
            Timer
        },
        created() {
            this.init()
            // console.log(this.$store.getters.pois)
        },
        data(){

            return{
                text_email: "",
                text_password: "",
                isLoginSuccess: null,
                isSeePassword: false,
                isOpen: false,
                start_at: null,
            }
        } ,
        watch:{

        },

        methods:{
            async init(){
                let {data} = await axios.get('/api/v1/event')
                let now = new Date()
                let start_at_ = data.start_at_
                if(now > start_at_){
                    this.isOpen = true
                }
                this.start_at = data.start_at_
            },

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
                    this.$store.commit('updateBgmStart', true)
                    localStorage.setItem("access_token", data.access_token);
                    localStorage.setItem("bgmStart", true);
                    this.$router.push('/')
                }else{
                    this.isLoginSuccess = false
                }
            },
            toggleSeePassword(){
                this.isSeePassword = !this.isSeePassword
            },
            handleTimerEnd(e){
                this.isOpen = e
            },
            handleToggleBgMusic(){
                this.$store.commit('updateBgmStart')
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
    overflow: visble;
    /* background: -webkit-linear-gradient(left, #18a01f, #12ff75); */
    padding: 10% 1% 3%;


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
    background: rgba(230, 230, 230, 0.2);
    margin-bottom: 3%;
}
.register-left img{
    /* margin-top: 5%; */
    /* margin-bottom: 5%; */
    width: 90%;
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
    font-size: x-large;
    padding: 12% 4% 9%;
    margin-top: -9%;
    text-shadow: 0 0 2px #000;
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
    margin-top: 25%;
    margin-bottom: -15%;
    color: #495057;
}

.btn-light {
    border: 1px solid #cfcfcf;
}
.btn-light:hover {
    background: #4c748c;
}

#txtpassword {
    padding-left: 70px;
}

@media screen and (max-width: 767px) {
    .register-left {
        position: absolute;
        top: 99%;
    }
    .register-left img {
        margin-top: 3%;
        margin-bottom: 1%;
        width: 60%;
    }
    .register-left p {
        font-size: medium;
    }
    .register-right h3 {
        font-size: xx-large;
    }

    .register-right p {
        font-weight:normal;
    }

}

@media screen and (max-width: 280px) {
    .register-left {
        position: absolute;
        top: 99%;
    }
    .register-left img {
        margin-top: 5%;
        margin-bottom: 1%;
        width: 80%;
    }
    .register-left p {
        font-size: medium;
    }
    .register-right h3 {
        font-size: x-large;
    }
    #txtpassword {
        padding-left: 62px;
    }

}

</style>
