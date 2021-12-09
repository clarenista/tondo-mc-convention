<template lang="">

    <div class="container mt-3">
        <div class="row d-flex justify-content-center align-items-center">
            <div class="alert alert-success" role="alert" v-if="isSuccess">
                Email sent. Please check you email to see the link to reset you password. 
                <router-link :to="'/'">Back to login.</router-link>
            </div>
            <div class="col-md-6">
                
                <div class="card">
                    <div class="card-body">
                        <div class="forgot">
                            <h2>Forgot your password?</h2>
                            <p>Change your password in three easy steps. This will help you to secure your password!</p>
                            <ol class="list-unstyled">
                                <li><span class="text-primary text-medium">1. </span>Enter your email address below.</li>
                                <li><span class="text-primary text-medium">2. </span>Our system will send you a temporary link</li>
                                <li><span class="text-primary text-medium">3. </span>Use the link to reset your password</li>
                            </ol>
                        </div>
                        <form class="card mt-4" @submit.prevent="handleSubmitEmail">
                            <div class="card-body">
                                <div class="form-group"> <label for="email-for-pass">Enter your email address</label> <input class="form-control" type="text" id="email-for-pass" v-model="text_email" required=""><small class="form-text text-muted">Enter the email address you used during the registration on PSP Events. Then we'll email a link to this address.</small> </div>
                            </div>
                            <div class="card-footer"> <button class="btn btn-success" type="submit" :disabled="submitting">Get New Password</button> <router-link :to="'/login'" class="btn btn-danger">Back to Login</router-link> </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
             
    </div>
</template>
<script>
export default {
    data() {
        return {
            text_email: null,
            isSuccess: null,
            submitting: false
        }
    },
    methods: {
        async handleSubmitEmail(){
            this.submitting = true
            let fd = new FormData()
            fd.append('email', this.text_email)
            try{
              let {data} = await axios.post('/api/password-remind', fd)
              if(data.status ==='ok'){
                this.isSuccess = true
                this.text_email = '',
                this.submitting = false
                }
            }catch({response}){
                console.log(response)
            }
        }
    },
}
</script>
<style>
 body {
     background-position: center;
     background-color: #eee;
     background-repeat: no-repeat;
     background-size: cover;
     color: #505050;
     font-family: "Rubik", Helvetica, Arial, sans-serif;
     font-size: 14px;
     font-weight: normal;
     line-height: 1.5;
     text-transform: none
 }

 .forgot {
     background-color: #fff;
     padding: 12px;
     border: 1px solid #dfdfdf
 }

 .padding-bottom-3x {
     padding-bottom: 72px !important
 }

 .card-footer {
     background-color: #fff
 }

 .btn {
     font-size: 13px
 }

 .form-control:focus {
     color: #495057;
     background-color: #fff;
     border-color: #76b7e9;
     outline: 0;
     box-shadow: 0 0 0 0px #28a745
 }    
</style>