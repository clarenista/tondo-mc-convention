<template>
    <div>
        <!-- <div id="mySidenav" class="sidenav" :style="showDropdown ? 'width:270px;' : 'width:0;'"> -->
        <div id="mySidenav" class="sidenav">
            <div class="text-center mb-5">
                <img
                    id="psp_logo"
                    src="images/71st_logo.png"
                    width="160px"
                    alt="psp_logo"
                    srcset=""
                />
            </div>
            <!-- <a href="javascript:void(0)" class="closebtn" @click="closeNav"><i class="fa fa-times" aria-hidden="true"></i></a> -->

            <a
                href="javascript:void(0)"
                v-if="item.type == 'nav-item'"
                v-for="(item, index) in navItems"
                :key="index"
                @click="handleNavigateTo(item)"
                :title="item.title"
            >
                <span>{{ item.name }}</span>
            </a>
            <a
                href="javascript:void(0)"
                title="Event Evaluation"
                @click="handleOpenEvalModal"
            >
                <span class="text-uppercase">Event Evaluation</span>
            </a>
            <a
                href="javascript:void(0)"
                title="Download Certificate"
                @click="handleDownload"
            >
                <span class="text-uppercase">Download Certificate</span>
            </a>
            <a
                href="javascript:void(0)"
                title="Download Certificate"
                @click="handleGoToTmcBooth"
            >
                <span class="text-uppercase">POST GRADUATE LECTURES</span>
            </a>
            <!--
        -->

            <div class="left_bot">
                <!-- <a href="javascript:void(0" @click="handleVote" title="Go to vote"><i class="fa fa-thumbs-up" aria-hidden="true"></i> </a> -->

                <a
                    href="javascript:void(0)"
                    @click="handleBgmPlayToggle"
                    title="Play/Mute audio"
                >
                    <span v-if="bgmStatus == 'true'"
                        ><i class="fa fa-volume-up small"></i> Mute</span
                    >
                    <span v-else
                        ><i class="fa fa-volume-off" aria-hidden="true"></i>
                        Play</span
                    >
                </a>
                <a
                    href="javascript:void(0)"
                    @click="handleLogout"
                    title="Logout"
                >
                    <span class="text-warning"
                        ><i class="fa fa-sign-out  small"></i> Logout</span
                    >
                </a>
            </div>
        </div>

        <!-- <button id="openBtn" class="open-btn btn btn-dark shadow-lg rounded-0" @click="openNav">&#9776</button> -->
    </div>
</template>
<script>
import Modal from "./Modal";
export default {
    computed: {
        event() {
            return this.$store.getters.event;
        }
    },
    components: { Modal },
    props: ["bgmStatus"],

    data() {
        return {
            showDropdown: false,
            navItems: [
                // {name: "Landing Page", sceneId: 'landing', icon: 'fa-map-o', type:'nav-item', title: 'Beach'},
                {
                    name: "LOBBY",
                    sceneId: "lobby",
                    icon: "fa-home",
                    type: "nav-item",
                    title: "Lobby"
                },
                {
                    name: "MEETING HALL",
                    sceneId: "meeting_hall",
                    icon: "fa-users",
                    type: "nav-item",
                    title: "Meeting Hall"
                },
                {
                    name: "EXHIBIT HALL",
                    sceneId: "hall_a",
                    icon: "fa-map-marker",
                    type: "nav-item",
                    title: "Exhibit Hall"
                }

                // {name: "EXHIBIT HALL", sceneId: '', icon: 'fa-street-view', type:'dropdown',
                //     dropdowns:[
                //         // {name: "Exhibit Hall", sceneId: 'hall', icon: 'fa-map-marker'},
                //         {name: "HALL - A", sceneId: 'hall_a', icon: 'fa-map-marker'},
                //         {name: "HALL - B", sceneId: 'hall_b', icon: 'fa-map-marker'},
                //         {name: "HALL - C", sceneId: 'hall_c', icon: 'fa-map-marker'},
                //         {name: "HALL - D", sceneId: 'hall_d', icon: 'fa-map-marker'},
                //     ], title: 'Exhibit Hall'},
            ]
        };
    },
    methods: {
        handleGoToTmcBooth() {
            this.$router.push("/sponsors/45?view=videos");
        },
        handleDownload() {
            this.$emit("handleDownload");
        },
        handleOpenEvalModal() {
            this.$emit("handleOpenEvalModal");
        },
        // openNav(){
        //     document.getElementById("mySidenav").style.width = "270px";
        //     document.getElementById("openBtn").style.opacity = "0.1";
        // },
        // closeNav(){
        //     document.getElementById("mySidenav").style.width = "0";
        //     document.getElementById("openBtn").style.opacity = "1";
        //     this.showDropdown = false
        // },

        handleNavigateTo(item) {
            this.$emit("handleNavigateTo", item.sceneId);
            this.closeNav();
            this.showDropdown = false;
        },
        handleBgmPlayToggle() {
            this.$emit("handleBgmPlayToggle");
        },
        handleLogout() {
            this.$emit("handleLogout");
        },
        handleVote() {
            // redirect to vote
            this.$router.push("/vote");
        },
        async init() {
            const api = `api/v1/guests/evaluation/status?api_token=${localStorage.getItem(
                "access_token"
            )}`;
            try {
                const { data } = await axios.get(api);
                if (data.done.length > 0) this.hasEvaluation = true;
                else this.hasEvaluation = false;
            } catch ({ response }) {
                alert(response.statusText);
            }
        }
    },

    mounted() {
        this.$store.dispatch("getEvalStatus");
        this.$store.dispatch("getEvent");
        // console.log(this.showDropdown)
    }
};
</script>
<style scoped>
button.open-btn {
    margin: 10px;
    position: fixed;
    left: 0;
    cursor: pointer;
    top: 0;
    z-index: 2;

    background-image: linear-gradient(90deg, #750092, #005229);
    border: #cc00ff;
    /* border-radius: 15%;
    -moz-border-radius: 15px;
    -webkit-border-radius: 15px; */
}

.sidenav {
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

    background-image: linear-gradient(180deg, #750092, #005229);
    /* transparent css */
    opacity: 0.9;
    /* pattern */
}

.sidenav a {
    padding: 5px 10px;
    text-decoration: none;
    font-size: 1rem;
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
    /* font-size: 36px; */
    /* margin-left: 50px; */
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
    border: none;
    color: #610089;
    text-align: center;
}

.lgbt {
    background-image: linear-gradient(#006595, #8241e4) !important;
    color: white;
}

a.dropdown-item {
    width: 320px;
    color: #610089;
    display: block;
}

.sidenav .left_bot {
    position: absolute;
    bottom: 0;
    left: 5px;
    /* border: 1px solid blue; */
}

.sidenav {
    width: 270px;
}

/* iphone */
@media only screen and (-webkit-min-device-pixel-ratio: 2) {
    .sidenav {
        width: 150px;
    }

    .sidenav a {
        font-size: 0.65rem;
    }

    #psp_logo {
        width: 80px;
        height: auto;
    }
}

/* galaxy fold */
@media (max-width: 320px) {
    .sidenav {
        width: 100px;
    }

    .sidenav a {
        font-size: 0.45rem;
    }

    #psp_logo {
        width: 60px;
        height: auto;
    }
}

/* greater than 319 buy less then 768 */
/* @media screen and (min-width: 320px) and (max-width: 768px) {
    .sidenav a {
        font-size: 1rem;
    }
  
    #psp_logo {
      width: 120px;
      height: auto;
    }

    
  } */

/* greater than 766 buy less then 850 */
/* @media screen and (min-width: 767px) and (max-width: 820px) {
    .sidenav a {
        font-size: 2rem;
    }
  
    #psp_logo {
      width: 220px;
      height: auto;
    }
  } */

/* greater than 990*/
/* @media screen and (min-width: 990) {
    .sidenav {
        width: 320px !important;
    }

    #psp_logo {
      width: 90px;
      height: auto;
    }

    .sidenav a {
        font-size: 1rem;
    }
  } */

/* 280  375 360 */
/* @media screen and (min-width: 281px) and (max-width: 390px) {
    .sidenav {
        width: 270px;
    }
    
    .sidenav a {
        font-size: .8rem;
    }
  
    #psp_logo {
      width: 90px;
      height: auto;
    }

    a.dropdown-item {
        width: 270px;
    }
  }

    .sidenav a {
        font-size: .8rem;
    }

    #psp_logo {
      width: 120px;
      height: auto;
    }
   */
</style>
