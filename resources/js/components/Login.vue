<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                
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
                                    <input 
                                        type="password" 
                                        class="form-control" 
                                        placeholder="Password *"
                                        v-model="text_password"
                                        required
                                    >
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
            }
        } ,
        watch:{
            
        },

        methods:{
            async handleSubmit(){
                if(this.errors){
                    return false
                }
                let fd = new FormData()
                fd.append('email', this.text_email)
                fd.append('password', this.text_password)
                let {data} = await axios.post('/api/login', fd)
                console.log(data)
            }
        }

    }
</script>

<style>

</style>