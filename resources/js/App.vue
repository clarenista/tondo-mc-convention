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

        <div class="collapse navbar-collapse" :class="showCollapse ? 'show' : ''" id="navbarColor02">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home
                    <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item">
                    <router-link class="nav-link" :to="'/registration'">Registration</router-link>
                </li>
                <li class="nav-item">
                    <router-link class="nav-link" :to="'/boothman'">Booth Manager</router-link>
                </li>
            </ul>
            <div class="my-2 my-lg-0">
                <button class="btn btn-primary my-2 my-sm-0" @click="handleLogInUser" v-if="$store.getters.user == []">Login</button>
                <button class="btn btn-danger my-2 my-sm-0" @click="handleLogoutUser" v-else>Logout</button>
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
        data(){
            return{
                showCollapse: false
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
                this.$store.commit('changeUser', '')
                this.$router.push('/')
            }
        }

    }
</script>