<template>
    <div>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <router-link class="navbar-brand" :to="'/'">AC</router-link>
        <button 
            class="navbar-toggler" 
            type="button" data-toggle="collapse" 
            data-target="#navbarColor02" 
            aria-controls="navbarColor02" 
            aria-expanded="false" 
            aria-label="Toggle navigation"
            @click="toggleShow"
        >
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" :class="showCollapse ? 'show' : ''" id="navbarColor02" v-if="$store.getters.user">

            
            <!-- admin nav -->
            <ul class="navbar-nav mr-auto" v-if="$store.getters.user.roles[0].name === 'admin'">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home
                    <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item" v-if="$store.getters.permissions.includes('create user')">
                    <router-link class="nav-link" :to="'/registration'">Registration</router-link>
                </li>
            </ul>

            <!-- sponsor nav -->
            <ul class="navbar-nav mr-auto" v-if="$store.getters.user.roles[0].name ==='sponsor'">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home
                    <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item">
                    <router-link class="nav-link" :to="'/boothman'">Booth Manager</router-link>
                </li>
            </ul>

            <ul class="navbar-nav mr-auto" v-else></ul>            


            <div class="my-2 my-lg-0">
                <button class="btn btn-primary my-2 my-sm-0" @click="handleLogInUser" v-if="(this.$store.getters.api_token).length  <= 0">Login</button>
                <button class="btn btn-danger my-2 my-sm-0" @click="handleLogoutUser" v-else>Logout</button>
            </div>
        </div>
        <div class="collapse navbar-collapse" :class="showCollapse ? 'show' : ''" id="navbarColor02" v-else>

            

            <ul class="navbar-nav mr-auto"></ul>            


            <div class="my-2 my-lg-0">
                <button class="btn btn-primary my-2 my-sm-0" @click="handleLogInUser">Login</button>
            </div>
        </div>
        </nav>
        <div class="container mt-3">
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            this.api_token = this.$store.getters.api_token ? this.$store.getters.api_token : null
        },
        data(){
            return{
                showCollapse: false,
                api_token: []
            }
        },
        methods:{
            toggleShow(){
                this.showCollapse = !this.showCollapse
            },

            handleLogInUser(){

                this.$router.push('/login')
            },
            handleLogoutUser(){
                this.$store.commit('updateApiToken', null)
                this.$store.commit('changeUser', null)
                this.$router.push('/login')
            }
        },

    }
</script>