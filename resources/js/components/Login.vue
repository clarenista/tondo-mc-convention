<template>
<div class="background full">
    <div class="register">

            <div class="register-right col-md-4" v-if="start_at">
                <Timer class="register-form" :endTime="start_at" @handleTimerEnd="handleTimerEnd" v-if="!isOpen"></Timer>
                <div v-else  class="tab-content" id="myTabContent">
                    <div class="alert alert-success" role="alert" v-if="isLoginSuccess">
                        Login successs.
                    </div>
                    <div class="alert alert-danger" role="alert" v-if="isLoginSuccess == false">
                        {{ loginMessage }}
                    </div>

                 <img src="images/70_logo.png" alt="center-image" width="50%" height="50%">

                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="row register-form justify-content-center align-items-center">
                            <div class="col-lg-12 col-sm-12">
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

                    <div class="d-flex justify-content-center">
                        <div class="data_use_clause">
                            <p class="check_agree text-light">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1" v-model="agree">
                                <label class="form-check-label" for="exampleCheck1">{{agreement}}</label>
                            </p>
                        </div>
                    </div>
                                
                                        <br>
                                        <div class="form-group align-middle mt-2">
                                            <button :class="agree ? 'rounded-0 btn btn-lg btn-block' : 'rounded-0 btn btn-lg btn-block'" :disabled="agree == false" style="font-weight: bold; background-color: #b0d94d; color: #FFF;">
                                            LOGIN</button>

                                        <div class="form-group float-right">
                                            <a href="https://eventsv2.psp.com.ph/password-remind" target="_blank" class=" text-light" style="font-style: italic; opacity: 0.4;">Forgot Password?</a>
                                        </div>
                                        </div>
                                </form>
                            </div>
                        </div>

                    <div class="d-flex justify-content-center">
                        <div class="data_use_clause">
                            <p class="clause text-light" v-html="privacy_clause"></p>                       
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
                loginMessage: null,
                text_email: "",
                text_password: "",
                isLoginSuccess: null,
                isSeePassword: false,
                isOpen: false,
                start_at: null,

                privacy_clause: "Note: You will be entitled to join the PSP raffle draw if you are able to visit all the booths. However, please refrain from visiting the booths or any particular booth if you do not wish to share your contact details to them.  Virtual booth visit happens when you click <banner class=' text-success'><i class=\"fa fa-sign-in\" aria-hidden=\"true\"></i></banner> icon on the booth.",
                agreement: "I am aware that when I visit the booths inside the virtual venue, my contact details will be accessible to the event sponsors and that I may be reached for promotion of their products.",
                agree: false,
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
                    this.$store.commit('updateAudioSource', '/bgm/landing.mp3')
                    localStorage.setItem("access_token", data.access_token);
                    ;
                    this.$router.push('/')
                }else{
                    this.isLoginSuccess = false;
                    this.loginMessage = data.message;
                }
            },
            toggleSeePassword(){
                this.isSeePassword = !this.isSeePassword
            },
            handleTimerEnd(e){
                this.isOpen = e
            },
            handleToggleBgMusic(){
                this.$store.commit('updateAudioSource', '/bgm/landing.mp3')
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
    padding: 5% 0 3%;

}
.register-left{
    text-align: center;
    color: #fff;
    /* margin-top: 3%; */

    /* border: 1px solid red; */
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
    background: rgba(27, 27, 27, 0.3);
    margin-bottom: 3%;
    border: 3px solid #1a361b;
    border-radius: .8em;
    padding: 1% 2%;
    /* border: 1px solid blue; */
}
.register-left img{
    /* margin-top: 5%; */
    /* margin-bottom: 5%; */
    width: 85%;
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
    padding: 1% 1% 1% 1%;
    margin-top: 1%;

    /* border: 1px solid green; */
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
    margin-top: 5%;
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

.register-form input[type=text] {
    font-size: medium;
}
.register-form input[type=password]{
    font-size: medium;
}
.register-form button {
    font-size: medium;
}

@media screen and (max-height: 900px) {
    .register-heading{
        text-align: center;
        margin-top: 3%;
        margin-bottom: -15%;
        color: #495057;
        font-size: 2.7rem;
    }

    .data_use_clause .clause {
        font-size: 11px !important;
    }

    .data_use_clause .check_agree {
        font-size: 11px !important;
    }

    .register {
        padding: 5% 1% 3%;
    }

     .register-left img {
        margin-top: 3%;
        margin-bottom: 1%;
        width: 55%;
    }
    .register-left p {
        font-size: small;
    }

    .register-form input[type=text] {
        font-size: small;
    }
    .register-form input[type=password]{
        font-size: small;
    }
    .register-form button {
        font-size: small;
    }
}

@media screen and (max-height: 800px) {
    .register-heading{
        text-align: center;
        margin-top: 3%;
        margin-bottom: -15%;
        color: #495057;
        font-size: 2.5rem;
    }

    .data_use_clause .clause {
        font-size: 10px !important;
    }

    .data_use_clause .check_agree {
        font-size: 10px !important;
    }

    .register {
        padding: 3% 1% 3%;
    }

     .register-left img {
        margin-top: 3%;
        margin-bottom: 1%;
        width: 50%;
    }
    .register-left p {
        font-size: small;
    }

     .register-form input[type=text] {
        font-size: small;
    }
    .register-form input[type=password]{
        font-size: small;
    }
    .register-form button {
        font-size: small;
    }
}



@media screen and (max-height: 500px) {
    .register-heading{
        text-align: center;
        margin-top: 3%;
        margin-bottom: -15%;
        color: #495057;
        font-size: 2rem;
    }

    .data_use_clause .clause {
        font-size: 9px !important;
    }

    .data_use_clause .check_agree {
        font-size: 9px !important;
    }

    .register {
        padding: 3% 1% 3%;
    }

     .register-left img {
        margin-top: 3%;
        margin-bottom: 1%;
        width: 50%;
    }
    .register-left p {
        font-size: small;
    }

    .register-form input[type=text] {
        font-size: small;
    }
    .register-form input[type=password]{
        font-size: small;
    }
    .register-form button {
        font-size: small;
    }
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

    .clause {
        font-size: 11px;
    }

}

@media screen and (max-width: 280px) {
    .register-left {
        position: absolute;
        top: 99%;
    }
    .register-left img {
        /* margin-top: 5%; */
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

    .clause {
        font-size: 9px !important;
    }

}

/* data use clause */
.data_use_clause {

    width: 90%;
    align-items: center;
}

.btn_holder {
    /* border: 1px solid red; */
    width: 50%;

}

.clause {
    font-size: 17px !important;
    text-align: justify;
}


.check_agree {
    font-size: 17px !important;
    text-align: justify;
}

@media screen and (max-width: 750px) {
    .data_use_clause .clause {
        font-size: 11px !important;
    }

    .data_use_clause .check_agree {
        font-size: 11px !important;
    }

    .register-left img{
        /* margin-top: 5%; */
        /* margin-bottom: 5%; */
        width:39%;
    }

    .register-left p {
        font-size: 0.5rem;
    }

  }

  @media screen and (max-width: 320px) {

    .register-left img{
        /* margin-top: 5%; */
        /* margin-bottom: 5%; */
        width: 0;
    }
    .register-left p {
        display: none;
    }

    .data_use_clause .clause {
        font-size: 9px !important;
    }

    .data_use_clause .check_agree {
        font-size: 9px !important;
    }

  }

  @media screen and (max-width: 360px) {
    .data_use_clause .clause {
        font-size: 9px !important;
    }

    .data_use_clause .check_agree {
        font-size: 9px !important;
    }

  }

@media screen and (max-width: 280px) {
  .register-left img{
        /* margin-top: 5%; */
        /* margin-bottom: 5%; */
        width:59%;
    }
}



</style>
