<template>
    <div class="container">
        <div class="alert alert-success" role="alert" v-if="successRegistration">
            Registered successfully.
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-7">
                
                <div class="card border-primary mb-3" >
                    <div class="card-header">Registration</div>
                    <div class="card-body">
                        <form method="POST" @submit.prevent="handleSubmit">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <input 
                                            type="text" 
                                            class="form-control" 
                                            placeholder="Title *"
                                            v-model="text_title"
                                            required
                                        >
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <input 
                                            type="text" 
                                            class="form-control" 
                                            placeholder="Affiliation *"
                                            name="affiliation"
                                            v-model="text_affiliation"
                                            required
                                        >
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <input 
                                            type="text" 
                                            class="form-control" 
                                            placeholder="First Name *"
                                            v-model="text_fname"
                                            required
                                        >
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <input 
                                            type="text" 
                                            class="form-control" 
                                            placeholder="Last Name *"
                                            v-model="text_lname"
                                            required
                                        >
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <input 
                                            type="text" 
                                            class="form-control" 
                                            placeholder="Contact No. *"
                                            v-model="text_contactno"
                                            required
                                        >
                                    </div>
                                </div>
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
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label >Role</label>
                                            <select 
                                                class="custom-select" 
                                                v-model="select_role"
                                                required
                                                >
                                                <option 
                                                    v-for="(item, index) in $store.state.roles" 
                                                    :key="index"
                                                    :value="item.key"
                                                >
                                                    {{item.value}}
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <input 
                                                type="password" 
                                                class="form-control" 
                                                placeholder="Password *"
                                                v-model="text_password"
                                                required
                                            >
                                        </div>
                                        <div class="form-group">
                                            <input 
                                                type="password" 
                                                class="form-control" 
                                                placeholder="Confirm password *"
                                                v-model="text_cpassword"
                                                required
                                            >
                                            <small class="text-danger" v-if="errors != ''">Those password didn't match. Try again.</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    
                                    <div class="form-group">
                                        <p>
                                            <small class="text-muted">
                                                By clicking Register you agree to our Terms and that you have read out <a href="#">Data Use Policy</a>, including our <a href="#">Cookie Use</a>.                                        
                                            </small>
                                        </p>
                                        <button class="btn btn-primary">Register</button>
                                    </div>
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
            // console.log(this.$store.getters.user)
        },
        data(){
            
            return{
                text_title: "",
                text_affiliation: "",
                text_fname: "",
                text_lname: "",
                text_email: "",
                text_contactno: "",
                textarea_message: "",
                text_password: "",
                text_cpassword: "",
                select_role: 'admin',
                errors: [],
                successRegistration: false
            }
        } ,
        watch:{
            text_cpassword(e){
                
                if(this.text_password != e){
                    if(!this.errors.includes('cpassword')){
                        this.errors.push('cpassword')
                    }
                    
                }else{
                    const index = this.errors.indexOf('cpassword');
                    if (index > -1) {
                        this.errors.splice(index, 1);
                    }                    
                }
            }
        },

        methods:{
            async handleSubmit(){
                let api_token = this.$store.getters.api_token
                let url = '/api/v1/registration?api_token='+api_token
                // if(this.errors){
                //     return false
                // }
                let fd = new FormData()
                fd.append('title', this.text_title)
                fd.append('affiliation', this.text_affiliation)
                fd.append('first_name', this.text_fname)
                fd.append('last_name', this.text_lname)
                fd.append('contactno', this.text_contactno)
                fd.append('email', this.text_email)
                fd.append('role', this.select_role)
                fd.append('message', this.textarea_message)
                fd.append('password', this.text_password)
                fd.append('api_token', this.api_token)
                let {data} = await axios.post(url, fd)
                if(data.status === 'ok'){
                    this.successRegistration = true
                }
            }
        }

    }
</script>

<style>

</style>