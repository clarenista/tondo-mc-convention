<template >
<div>
    <div id="mySidenav" class="sidenav">
        <div class="text-center"><img src="images/PSP_LOGO.png" width="260px" alt="psp_logo" srcset=""></div>
    <a href="javascript:void(0)" class="closebtn" @click="closeNav"><i class="fa fa-times-circle-o" aria-hidden="true"></i></a>
    <a 
        href="javascript:void(0)" 
        v-if="item.type=='nav-item'" 
        v-for="(item, index) in navItems" 
        :key="index"
        @click="handleNavigateTo(item)"
    >
        <i class="fa" :class="item.icon"></i> {{item.name}}
    </a>
    <div class="nav-item dropdown " :class="showDropdown ? 'show' : ''" v-else>
        <a class="nav-link dropdown-toggle" @click="showDropdown = !showDropdown" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
            <i class="fa" :class="item.icon"></i> {{item.name}}</a>
        <div class="dropdown-menu" :class="showDropdown ? 'show' : ''" style="width:100%; background-color: #44948c; color: #f6f6f6;">
          <a class="dropdown-item" @click="handleNavigateTo(dropdown)" style="padding-left: 80px;" href="#" v-for="(dropdown, index) in item.dropdowns" :key="index">
              <i class="fa" :class="item.icon"></i> {{dropdown.name}}</a>
        </div>
    </div>
    <a href="javascript:void(0)" @click="handleLogout">
        <i class="fa fa-sign-out" ></i> Logout
    </a>
    </div>

    <button class="open-btn btn btn-dark shadow-lg rounded-0" @click="openNav">&#9776</button>
</div>
</template>
<script>
export default {
    data() {
        return {
            showDropdown: false,
            navItems: [
                {name: "Lobby", sceneId: 'lobby', icon: 'fa-home', type:'nav-item'},
                {name: "Meeting Hall", sceneId: 'meeting_hall', icon: 'fa-users', type:'nav-item'},
                {name: "Exhibit Hall", sceneId: '', icon: 'fa-dashboard', type:'dropdown', 
                    dropdowns:[
                        {name: "Exhibit Hall A", sceneId: 'exhibit_hall_a', icon: 'fa-user'},
                        {name: "Exhibit Hall B", sceneId: 'exhibit_hall_b', icon: 'fa-user'},
                        {name: "Exhibit Hall C", sceneId: 'exhibit_hall_c', icon: 'fa-user'},
                        {name: "Exhibit Hall D", sceneId: 'exhibit_hall_d', icon: 'fa-user'},
                    ]},
            ]
        }
    },
    methods:{
        openNav(){
            document.getElementById("mySidenav").style.width = "320px";
        },
        closeNav(){
            document.getElementById("mySidenav").style.width = "0";

        },
        handleNavigateTo(item){
            this.$emit('handleNavigateTo', item.sceneId);
            this.closeNav()
            this.showDropdown = false
        },
        handleLogout(){
            // remove user details in store
            this.$store.commit('changeUser', null)
            // clear localStorage
            localStorage.clear();

            // update isWelcomed
            this.$store.commit('updateIsWelcomed', true)

            this.$store.commit('updateBgmStart')

            // redirect to login
            this.$router.push('/login')
        }
    }
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
}

.sidenav {
  height: 100%;
  width: 0;
  position: fixed;
  z-index: 3;
  top: 0;
  left: 0;
  background-color: #4c748c;
  overflow-x: hidden;
  transition: 0.5s;
  padding-top: 60px;

  /* transparent css */
  background-image: linear-gradient(180deg, #4c748c, #9cf0c8);
  opacity: 96%;
}

.sidenav a {
  padding: 8px 8px 8px 42px;
  text-decoration: none;
  font-size: 24px;
  color: #f1f1f1;
  display: block;
  transition: 0.3s;
}

.sidenav a:hover {
  color: #416dff;
}

.sidenav .closebtn {
  position: absolute;
  top: 0;
  right: 25px;
  font-size: 36px;
  margin-left: 50px;
}

@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}    
</style>