<template>
    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="alert alert-success" role="alert" v-if="isSuccess">
                    Change password success. Please wait while we redirect you to the virtual event login. 
                </div>
                <div class="card">
                    <div class="card-header">
                        <h3>Reset Password</h3>
                    </div>


                    <div class="card-body">
                        <form @submit.prevent="handleSubmitButtonClicked">
                            <div class="form-group row">
                                <label class="col-sm-3 form-control-label">New Password</label>
                                <div class="col-sm-9">
                                    <input 
                                        type="password" 
                                        class="form-control" 
                                        placeholder="Enter new password"
                                        v-model="text_newPassword"
                                    >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 form-control-label">Confirm Password</label>
                                <div class="col-sm-9">
                                    <input 
                                        type="password" 
                                        class="form-control" 
                                        placeholder="Confirm password"
                                        v-model="text_confirmPassword"
                                    >
                                </div>
                            </div>                            

                            <div class="form-group row" v-if="isMatched">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button class="btn btn-primary" :disabled="submitting">Submit</button>
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
            this.reset_password_key = this.key
        },
        props:['key'],
        data(){
            return{
                text_newPassword: '',
                text_confirmPassword: '',
                isMatched: null,
                reset_password_key: '',
                isSuccess: false,
                submitting: false
            }
        },
        watch:{
            text_newPassword(e){
                if(e === this.text_confirmPassword){
                    this.isMatched = true
                }else{
                    this.isMatched = false

                }
            },
            text_confirmPassword(e){
                if(e === this.text_newPassword){
                    this.isMatched = true
                }else{
                    this.isMatched = false

                }
            }
        },
        methods:{
            async handleSubmitButtonClicked(){
                this.submitting = true
                let fd = new FormData();
                fd.append('password', this.text_newPassword);
                fd.append('reset_password_key', this.reset_password_key);
                try{

                    let {data} = await axios.post('/api/reset-password/'+this.reset_password_key, fd);
                    if(data.status ==='ok'){
                        this.isSuccess = true
                        this.submitting = false
                        setTimeout(()=>{
                            this.$router.push('/')
                        }, 2000)
                    }
                }catch({response}){
                    alert(response.statusText)
                }
            }
        }
    }
</script>
