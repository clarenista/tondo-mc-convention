<template >
<div>

    <!-- <div id="mySidenav" class="sidenav">
        <div class="text-center"><img id="psp_logo" src="images/psp_sidebar_logo.png" width="240px" alt="psp_logo" srcset=""></div>
        
        <a href="javascript:void(0)" class="closebtn" @click="closeNav"><i class="fa fa-chevron-left" aria-hidden="true"></i></a>
        <a 
            href="javascript:void(0)" 
            v-if="item.type=='nav-item'" 
            v-for="(item, index) in navItems" 
            :key="index"
            @click="handleNavigateTo(item)"
        >
            <i class="fa" :class="item.icon"></i> {{item.name}}
        </a>

        <div class="nav-item dropdown" :class="showDropdown ? 'show' : ''" v-else>
            <a class="nav-link dropdown-toggle" @click="showDropdown = !showDropdown" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                <span><i class="fa" :class="item.icon"></i></span> {{item.name}}</a>
            <div class="dropdown-menu" :class="showDropdown ? 'show' : ''" >
                <a class="dropdown-item"  @click="handleNavigateTo(dropdown)" 
                    href="#" v-for="(dropdown, index) in item.dropdowns" :key="index">
                <i class="fa" :class="dropdown.icon"></i>&nbsp;{{dropdown.name}}</a>
            </div>
        </div>

        <a href="javascript:void(0)" @click="handleBgmPlayToggle" title="Play/Mute audio">
            <span><i class="fa fa-volume-up" ></i></span> 
        </a>
        <a href="javascript:void(0)" @click="handleLogout" title="Logout">
            <span><i class="fa fa-sign-out" ></i></span> 
        </a>
    </div> -->

    <div id="mySidenav" class="sidenav" :style="showDropdown ? 'width:300px;' : 'width:0;'">
        <div class="text-center"><img id="psp_logo" src="images/psp_sidebar_logo.png" width="240px" alt="psp_logo" srcset=""></div>
        <a href="javascript:void(0)" class="closebtn" @click="closeNav"><i class="fa fa-times" aria-hidden="true"></i></a>

        <a 
            href="javascript:void(0)" 
            v-if="item.type=='nav-item'" 
            v-for="(item, index) in navItems" 
            :key="index"
            @click="handleNavigateTo(item)"
            :title="item.title"
        >
            <span>{{item.name}}</span> 
        </a>
        
        <div class="nav-item dropdown" :class="showDropdown ? 'show' : ''" v-else>
            <a class="nav-link dropdown-toggle" @click="showDropdown = !showDropdown" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                <span></span>  {{item.name}}</a>
            <div class="dropdown-menu" :class="showDropdown ? 'show' : ''" style="">
                <a class="dropdown-item"  @click="handleNavigateTo(dropdown)" 
                    href="#" v-for="(dropdown, index) in item.dropdowns" :key="index">
                &nbsp;{{dropdown.name}}</a>
            </div>
        </div>
        <a href="javascript:void(0)" @click="handleBgmPlayToggle" title="Play/Mute audio">
            <span><i class="fa fa-volume-up" ></i></span> 
        </a>
        <a href="javascript:void(0)" @click="handleLogout" title="Logout">
            <span><i class="fa fa-sign-out" ></i></span> 
        </a>
    </div>

    <button id="openBtn" class="open-btn btn btn-dark shadow-lg rounded-0" @click="openNav">&#9776</button>
   
</div>
</template>
<script>
export default {
    data() {
        return {
            showDropdown: false,
            navItems: [
                // {name: "Landing Page", sceneId: 'landing', icon: 'fa-map-o', type:'nav-item', title: 'Beach'},
                {name: "LOBBY", sceneId: 'lobby', icon: 'fa-home', type:'nav-item', title: 'Lobby'},
                {name: "MEETING HALL", sceneId: 'meeting_hall', icon: 'fa-users', type:'nav-item' , title: 'Meeting Hall'},
                // {name: "Pool Area", sceneId: 'pool_area', icon: 'fa-tint fa-lg', type:'nav-item' , title: 'Pool Area'},
                {name: "EXHIBIT HALL", sceneId: '', icon: 'fa-street-view', type:'dropdown',  
                    dropdowns:[
                        // {name: "Exhibit Hall", sceneId: 'hall', icon: 'fa-map-marker'},
                        {name: "HALL A", sceneId: 'hall_a', icon: 'fa-map-marker'},
                        {name: "HALL B", sceneId: 'hall_b', icon: 'fa-map-marker'},
                        {name: "HALL C", sceneId: 'hall_c', icon: 'fa-map-marker'},
                        {name: "HALL D", sceneId: 'hall_d', icon: 'fa-map-marker'},
                    ], title: 'Exhibit Hall'},
            ]
        }
    },
    methods:{
        openNav(){
            document.getElementById("mySidenav").style.width = "300px";
            document.getElementById("openBtn").style.display = "none";
        },
        closeNav(){
            document.getElementById("mySidenav").style.width = "0";
            document.getElementById("openBtn").style.display = "block";
        },

        handleNavigateTo(item){
            this.$emit('handleNavigateTo', item.sceneId);
            this.showDropdown = false
        },
        handleBgmPlayToggle(){
            this.$emit('handleBgmPlayToggle');
        },
        handleLogout(){
            // remove user details in store
            this.$store.commit('changeUser', null)
            // clear localStorage
            localStorage.clear();

            // update isWelcomed
            this.$store.commit('updateIsWelcomed', true)

            this.$store.commit('updateBgmStart', false)

            // redirect to login
            this.$router.push('/login')
        },
        handleVote(){
             // redirect to vote
            this.$router.push('/vote')
        }
    },

    mounted() {
        document.getElementById("openBtn").style.display = "block";
    },
}
</script>
<style scoped>
button.open-btn{
    margin: 10px;
    position: fixed;
    left: 0;
    cursor: pointer;
    top: 0;
    z-index: 2;
    
    background-image: linear-gradient(90deg,  #cc00ff, #0073a8);
    border: #125f21;
    /* border-radius: 15%;
    -moz-border-radius: 15px;
    -webkit-border-radius: 15px; */
}

.sidenav {
  font-style: Arial !important;
  font-weight: 300;

  height: 100%;
  width: 0;
  position: fixed;
  z-index: 1;
  top: 0;
  left: 0;
  overflow-x: hidden;
  transition: 0.5s;
  padding-top: 60px;

  /* border: 1px solid red; */

  background-image: linear-gradient(180deg, #cc00ff, #0073a8);
  /* transparent css */
  opacity: 0.9;
  /* pattern */
}

.sidenav a {
  padding: 10px;
  text-decoration: none;
  font-size: 24px;
  color: #f1f1f1;
  display: block;
  transition: 0.3s;

  /* border: 1px solid blue; */
}

.sidenav a:hover {
  color: #fa7000;
}

.sidenav .closebtn {
  position: absolute;
  top: 0;
  right: 25px;
  font-size: 36px;
  margin-left: 50px;
}

/* @media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}   */

.closebtn {
    font-size: 1.2rem !important;
}

/* new css */
.dropdown-menu {
    background-color: #93b5f2; 
    color: #f6f6f6;
}
.dropdown-item {
   /* background-color: #ebcb17 !important;  */
   border: none; color: #610089;
}
.dropdown-item:hover {
    color: white !important;
    border-bottom: 1px solid white;
}

.lgbt {
    background-image: linear-gradient(#006595, #8241e4) !important;
    color: white;
}
</style>