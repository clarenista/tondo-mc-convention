<template >
    <div class="background full">
      <!-- BOOTH TRACKER -->
      <div class="booth_tracker">
        <h1><i class="fa fa-address-card text-dark" type="button" @click="handleBoothTracker" title="View My Activity" aria-hidden="true" ></i></h1>
      </div>

      <div id="booth_visits" class="bg-light text-dark table-responsive">
        <h3 class="display-4">Booth Tracker</h3>
        <hr>
        <div>
          <table class="table table-light table-striped table-bordered">
            <thead>
              <th>Booth Name</th>
              <th>Visited</th>
              <!-- <th>Action</th> -->
            </thead>
            <tbody>
              <tr v-for="(i, index) in visited_booths" :key="index">
                <td>{{i.name}}</td>
                <td>
                  <i v-if="i.visited != true" class="fa fa-times text-danger"></i>
                  <i v-else class="fa fa-check text-success"></i>
                </td>
                <!-- <td><a href="http://"></a></td> -->
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <!-- BOOTH TRACKER -->

      <!-- ZOOM TIMER -->
      <div id="zoom_countdown" v-if="isOpen">
        <div class="col-12">
          <div  class="row">
            <div class="col p-1" id="box">
                <div class="card card-primary bg-dark text-light">
                    <div class="card-body text-center">
                        <p class="display-4 m-0">{{zeroPad(days)}}</p>
                        <p class="lead m-0 text-light text-uppercase">days</p>
                    </div>
                </div>
            </div>

            <div class="col p-1" id="box">
                <div class="card card-primary bg-dark text-light">
                    <div class="card-body text-center">
                        <p class="display-4 m-0">{{zeroPad(hours)}}</p>
                        <p class="lead m-0 text-light text-uppercase">hrs</p>
                    </div>
                </div>
            </div>

            <div class="col p-1" id="box">
                <div class="card card-primary bg-dark text-light">
                    <div class="card-body text-center">
                        <p class="display-4 m-0">{{zeroPad(minutes)}}</p>
                        <p class="lead m-0 text-light text-uppercase">mins</p>
                    </div>
                </div>
            </div>
            
            <div class="col p-1" id="box">
                <div class="card card-primary bg-dark text-light">
                    <div class="card-body text-center">
                        <p class="display-4 m-0">{{zeroPad(seconds)}}</p>
                        <p class="lead m-0 text-light text-uppercase">secs</p>
                    </div>
                </div>
            </div>  
          </div>

          <div class="row">
            <div class="col text-center intro"><small>Zoom meeting starts after countdown</small></div>                                                       
          </div>
          
        </div>
      </div>

      <div id="panorama">
        <div id="controls">
          <div class="ctrl" @click="handleBgmPlayToggle">
            <i class="fa fa-volume-up" v-if="$store.getters.bgmStart"></i>
            <i class="fa fa-volume-off" v-else></i>
          </div>
        </div>
      </div>

      <Sidebar @handleNavigateTo="handleNavigateTo"></Sidebar>
      <Modal :value="$store.getters.isWelcomed" v-if="$store.getters.user">
        <template v-slot:title >
            <h3 class="display-4 mt-3">Hello {{$store.getters.user.first_name}},</h3>
        </template>
        <template v-slot:body>
            <p class="text-center lead text-success mt-3 mb-3"><strong> Welcome to First PSP Virtual Event.</strong></p>
        </template>
        <template v-slot:footer >
            <button class="btn btn-primary" type="button" @click="handleUpdateIsWelcomed">
              <i class="fa fa-caret-right"></i> proceed</button>
        </template>
      </Modal>

      <marquee v-if="announcement != null" direction="left"> Announcement: {{announcement}}</marquee>

    </div>
</template>
<script>
import Sidebar from './Sidebar'
import Modal from './Modal'
import MeetingHall from './MeetingHall/MeetingHall.js'
export default {
  components:{
    Sidebar, Modal
  },
  props:['sceneId'],

    data() {
      return {
        booths: null,
        viewer: null,
        panorama_details: null,
        lobby_booths: null,
        hall_a_booths: null,
        hall_b_booths: null,
        hall_c_booths: null,
        hall_d_booths: null,
        
        countDownStartTime: '',
        countDownEndTime: '',
        counDownDistance: '',
        days: '',
        hours: '',
        minutes: '',
        seconds: '',
        start_at: null,
        isOpen: false,
        sponsor_booth: null,
        visited_booths: null,

        announcement: 'All participants, kindly go to the meeting hall now.',
      }
    },
    mounted() {
      this.init()
      window.addEventListener("resize", this.reSize);
      //  setInterval(()=>{console.log(this.viewer.getScene())}, 1000)
      this.loadTimer()
      this.handleLoadBoothTracker()
      document.getElementById('booth_visits').style.display = "none"
    },
    methods:{
      async init(){
        let vm = this
        // auth:api
        let {data} = await axios.get('api/v1/booths?api_token='+localStorage.getItem('access_token'))
        // let {data} = await axios.get('api/v1/booths')
        this.$store.commit('updateBooths', data)
        this.booths = this.$store.getters.booths

        this.panorama_details = {
            "default": {
                "firstScene": this.sceneId ? this.sceneId : "lobby",
                "sceneFadeDuration": 500,
                "autoLoad": true,
                "showControls": false,
                // uncomment the code below to get the PITCH and YAW of hotspot - console
                "hotSpotDebug": true,
            },

            "scenes": {
                "lobby": {
                    "type": "multires",
                    "multiRes": {
                      "basePath": "/images/multires/lobby1",
                      "path": "/%l/%s%y_%x",
                      "fallbackPath": "/fallback/%s",
                      "extension": "jpg",
                      "tileResolution": 512,
                      "maxLevel": 3,
                      "cubeResolution": 1904
                    },
                    "hotSpots": [
                      {
                        "clickHandlerFunc": ()=>{this.$router.push('/vote')},
                        "scene": 'lobby',
                        "pitch": 22,
                        "yaw": 0,
                        "cssClass": "custom-hotspot vote",

                      },
                    ]
                },

                "meeting_hall": {
                    "type": "multires",
                    "multiRes": {
                      "basePath": "/images/multires/stage",
                      "path": "/%l/%s%y_%x",
                      "fallbackPath": "/fallback/%s",
                      "extension": "jpg",
                      "tileResolution": 512,
                      "maxLevel": 3,
                      "cubeResolution": 1904
                    },
                    "hotSpots": [

                    ]
                },
                "hall_a" :{
                    "type": "multires",
                    "multiRes": {
                      "basePath": "/images/multires/hall_a",
                      "path": "/%l/%s%y_%x",
                      "fallbackPath": "/fallback/%s",
                      "extension": "jpg",
                      "tileResolution": 512,
                      "maxLevel": 3,
                      "cubeResolution": 1904
                    },
                    "hotSpots": [

                    ]
                },
                "hall_b" :{
                    "type": "multires",
                    "multiRes": {
                      "basePath": "/images/multires/hall_b",
                      "path": "/%l/%s%y_%x",
                      "fallbackPath": "/fallback/%s",
                      "extension": "jpg",
                      "tileResolution": 512,
                      "maxLevel": 3,
                      "cubeResolution": 1904
                    },
                    "hotSpots": [

                    ]
                },
                "hall_c" :{
                    "type": "multires",
                    "multiRes": {
                      "basePath": "/images/multires/hall_c",
                      "path": "/%l/%s%y_%x",
                      "fallbackPath": "/fallback/%s",
                      "extension": "jpg",
                      "tileResolution": 512,
                      "maxLevel": 3,
                      "cubeResolution": 1904
                    },
                    "hotSpots": [

                    ]
                },
                "hall_d" :{
                    "type": "multires",
                    "multiRes": {
                      "basePath": "/images/multires/hall_d",
                      "path": "/%l/%s%y_%x",
                      "fallbackPath": "/fallback/%s",
                      "extension": "jpg",
                      "tileResolution": 512,
                      "maxLevel": 3,
                      "cubeResolution": 1904
                    },
                    "hotSpots": [

                    ]
                }
            }
        }
        for(let i in this.booths){
          this.booths[i].cssClass = "custom-hotspot booth"
          this.booths[i].text = this.booths[i].name
          this.booths[i].clickHandlerFunc =  () => {this.handleBoothClicked(this.booths[i])}

        }
        if(this.$store.getters.user.classification ==='sponsor'){
          this.viewer= pannellum.viewer('panorama', this.panorama_details );
          this.sponsor_booth = _.filter(this.$store.getters.booths, ['id', this.$store.getters.user.booth.id])
          this.viewer.loadScene(this.$store.getters.user.booth.panorama_location)
          this.panorama_details.scenes.[this.$store.getters.user.booth.panorama_location].pitch = this.$store.getters.user.booth.pitch
          this.panorama_details.scenes.[this.$store.getters.user.booth.panorama_location].yaw = this.$store.getters.user.booth.yaw
          this.panorama_details.scenes.[this.$store.getters.user.booth.panorama_location].hotSpots.push(...this.sponsor_booth)

        }else{

          this.hall_a_booths = _.filter(this.$store.getters.booths, ['panorama_location', 'hall_a'])
          this.hall_b_booths = _.filter(this.$store.getters.booths, ['panorama_location', 'hall_b'])
          this.hall_c_booths = _.filter(this.$store.getters.booths, ['panorama_location', 'hall_c'])
          this.hall_d_booths = _.filter(this.$store.getters.booths, ['panorama_location', 'hall_d'])
          this.lobby_booths = _.filter(this.$store.getters.booths, ['panorama_location', 'lobby'])
          for(let i in this.$store.getters.scene_hotSpots){
            this.$store.getters.scene_hotSpots[i].clickHandlerFunc =  () => {this.handleHotspotClicked(this.$store.getters.scene_hotSpots[i].sceneId)}
          }
          this.panorama_details.scenes.lobby.hotSpots.push(..._.filter(this.$store.getters.scene_hotSpots, ['scene', 'lobby']))
          this.panorama_details.scenes.lobby.hotSpots.push(...this.lobby_booths)

          this.panorama_details.scenes.meeting_hall.hotSpots.push(..._.filter(this.$store.getters.scene_hotSpots, ['scene', 'meeting_hall']))

          this.panorama_details.scenes.hall_a.hotSpots.push(..._.filter(this.$store.getters.scene_hotSpots, ['scene', 'exhibit_hall']))
          this.panorama_details.scenes.hall_a.hotSpots.push(...this.hall_a_booths)

          this.panorama_details.scenes.hall_b.hotSpots.push(..._.filter(this.$store.getters.scene_hotSpots, ['scene', 'exhibit_hall']))
          this.panorama_details.scenes.hall_b.hotSpots.push(...this.hall_b_booths)

          this.panorama_details.scenes.hall_c.hotSpots.push(..._.filter(this.$store.getters.scene_hotSpots, ['scene', 'exhibit_hall']))
          this.panorama_details.scenes.hall_c.hotSpots.push(...this.hall_c_booths)

          this.panorama_details.scenes.hall_d.hotSpots.push(..._.filter(this.$store.getters.scene_hotSpots, ['scene', 'exhibit_hall']))
          this.panorama_details.scenes.hall_d.hotSpots.push(...this.hall_d_booths)

          this.viewer= pannellum.viewer('panorama', this.panorama_details );
        }
          // this.viewer = pannellum.viewer('panorama', { 'scenes': [], 'autoLoad': true, 'showFullscreenCtrl': false, 'showZoomCtrl': false });
          // this.viewer.on('scenechange', ()=>{console.log(this.viewer.getScene())})
          this.viewer.on('scenechange', this.handleSceneChange)
          this.viewer.on('load', this.handleSceneLoad);
          this.reSize()

        
      },
      handleSceneLoad(){
          if(this.viewer.getScene()=="meeting_hall"){
              MeetingHall.init(this)
          }
      },
      handleSceneChange(){
        this.reSize()
        this.$store.commit('changeCurrentScene',this.viewer.getScene())
      },
      reSize() {
        // Get screen size (inner/outerWidth, inner/outerHeight)
        var height = window.innerHeight;
        var width = window.innerWidth;

        if(width<height) {
          // portrait
          this.viewer.setHfov(50  );
        } else {
          // landscape (or width=height)
          this.viewer.setHfov(100 );
        }
      },
      updateBooth(scene){
        this.reSize
        this.booths = _.filter(this.$store.getters.booths, ['panorama_location', scene])
        for(let i in this.booths){
          this.booths[i].cssClass = "custom-hotspot booth"
          this.booths[i].clickHandlerFunc = ()=>{ this.$router.push('/sponsors/'+this.booths[i].id)}
          _.filter(this.$store.getters.booths, ['panorama_location', 'lobby'])
        }
        this.panorama_details.scenes.scene.hotSpots.push(...this.booths)
      },
      handleNavigateTo(sceneId){
        this.viewer.loadScene(sceneId)
        const label = sceneId+" hotspot"
        this.$sendGuestEvent('click', label)
      },
      handleUpdateIsWelcomed(){
        this.$store.commit('updateIsWelcomed', false)
      },
      handleBoothClicked(booth){
        const label = booth.name+" booth"
        this.$router.push('sponsors/'+booth.id)
        this.$sendGuestEvent('click', label, booth)
      },
      handleHotspotClicked(scene){
        const label = scene+" hotspot"
        this.$sendGuestEvent('click', label)
      },
      handleBgmPlayToggle(){
        if(this.$store.getters.bgmStart){
          this.$store.commit('updateBgmStart', false)
        }else{
          this.$store.commit('updateBgmStart', true)
          
        }
      },

      // ZOOM TIMER
      async loadTimer(){
        let {data} = await axios.get('/api/v1/program?api_token='+localStorage.getItem('access_token'))
        this.start_at = data.start_at_

        // disable display
        let now = new Date()
        let start_at_ = data.start_at_
        if(now < start_at_){
            this.isOpen = true
        }

        this.countDownEndTime =  this.start_at;
        this.countDownStart()
        let x = setInterval(()=>{
            this.countDownStart()
            if(this.distance < 0){
                clearInterval(x)
                this.handleTimerEnd()
            }
        }, 1000)
      },
      countDownStart(){
                
          let now = new Date().getTime();
          if(now > this.start_at){
              this.isOpen = true
          }
          this.distance = this.countDownEndTime - now;

          // Time calculations for days, hours, minutes and seconds
          this.days = Math.floor(this.distance / (1000 * 60 * 60 * 24));
          this.hours = Math.floor((this.distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
          this.minutes = Math.floor((this.distance % (1000 * 60 * 60)) / (1000 * 60));
          this.seconds = Math.floor((this.distance % (1000 * 60)) / 1000);
      },
      handleTimerEnd(){
        this.isOpen = false
      },
      zeroPad(num){
          return String(num).padStart(2, '0');
      },
      // ZOOM TIMER

      // BOOTH TRACKER
      handleBoothTracker(){
       
         var x = document.getElementById("booth_visits");
          if (x.style.display === "none") {
            x.style.display = "block";
          } else {
            x.style.display = "none";
          }
      },

      async handleLoadBoothTracker(){
        let {data} = await axios.get('api/v1/guests/booths/tracker?api_token='+localStorage.getItem('access_token'))
        this.visited_booths = data
      }
      // BOOTH TRACKER
    }
}

</script>
<style scoped>
  div >>> .custom-hotspot {
    height: 32px;
    width: 32px;
    animation: pulse 2s infinite;
    border-radius: 50%;
  }
  div >>> .vote{
    height: 50px;
    width: 50px;
    background-image: url('/images/icons/vote.png');
    background-size: cover;
  }  
  
  div >>> .meeting_hall{
    background-image: url('/images/icons/meeting-hall-icon-min.png');
    background-size: cover;
  }
  div >>> .zoom{
    background-image: url('/images/icons/zoom.png');
    background-size: cover;
  }  
  div >>> .exhibit_hall{
    background-image: url('/images/icons/exhibit-hall-icon-min.png');
    background-size: cover;
  }
  div >>> .booth{
    background-image: url('/images/icons/booth-icon-min.png');
    background-size: cover;
  }
  div >>> .left_arrow{
    background-image: url('/images/icons/left_arrow-min.png');
    background-size: cover;
  }
  div >>> .right_arrow{
    background-image: url('/images/icons/right_arrow-min.png');
    background-size: cover;
  }
  @-webkit-keyframes pulse {
    0% {
      -webkit-box-shadow: 0 0 0 0 rgba(255, 255, 255, 0.9);
    }
    70% {
      -webkit-box-shadow: 0 0 0 10px rgba(255, 255, 255, 0);
    }
    100% {
      -webkit-box-shadow: 0 0 0 0 rgba(255, 255, 255, 0);
    }
  }
  @keyframes pulse {
    0% {
      -moz-box-shadow: 0 0 0 0 rgba(255, 255, 255, 0.9);
      box-shadow: 0 0 0 0 rgba(255, 255, 255, 0.9);
    }
    70% {
      -moz-box-shadow: 0 0 0 10px rgba(255, 255, 255, 0);
      box-shadow: 0 0 0 10px rgba(255, 255, 255, 0);
    }
    100% {
      -moz-box-shadow: 0 0 0 0 rgba(255, 255, 255, 0);
      box-shadow: 0 0 0 0 rgba(255, 255, 255, 0);
    }
  }
  div.background {
    position: fixed;
    top: 0;
    left: 0;
  }

  div.full{
    width: 100%;
    height: 100%;
  }
   div >>> .pnlm-about-msg {
    width: 0;
    height: 0;
    padding: 0;
    visibility: hidden;

  }
  .pnlm-about-msg >>> a {
    visibility: hidden;
  }
  #controls {
        position: absolute;
        bottom: 0;
        z-index: 2;
        text-align: center;
        width: 100%;
        padding-bottom: 3px;
    }
    .ctrl {
        padding: 8px 5px;
        width: 30px;
        text-align: center;
        background: rgba(200, 200, 200, 0.8);
        display: inline-block;
        cursor: pointer;
    }
    .ctrl:hover {
        background: rgba(200, 200, 200, 1);
    }
  
  .booth_tracker {
    position: fixed;
    top: 0.1em;
    right: 0.5em;
    /* background-color: rgba(0,0,0,0.5); */
    z-index: 2;
    cursor: pointer;
  }

  #booth_visits{
    padding: 1%;
    position: fixed;
    top: 5em;
    right: 0.5em;
    z-index: 2;
    width: 35%;
    height: 75%;
  }

  marquee {
    position: fixed;
    bottom: 5em;
    right: 0.8em;
    /* border: 1px solid red; */
    width: 30%;
    height: 5%;
    font-weight:600;
    color:firebrick;
  }

  #zoom_countdown {
    position: fixed;
    top: 0.4em;
    right: 3.5em;
    z-index: 2;
  }
  #zoom_countdown .intro {
    font-size: 0.9em;
  }
  #zoom_countdown .display-4 {
      font-size: 0.9rem;
  }
  #zoom_countdown .lead {
      font-size: 0.5rem;
  }
  #box .card-body {
      padding: 0.5rem !important; 
  }

  @media screen and (max-width: 750px) {
    #zoom_countdown .display-4 {
       font-size: 0.8rem;
    }
    #zoom_countdown .lead {
       font-size: 0.5rem;
    }
    #zoom_countdown .intro {
        font-size: 0.6em;
    }
    #box .card-body {
        padding: 0.6rem !important; 
    }

    #booth_visits{
        width: 55%;
      }
    #booth_visits .display-4 {
      font-size: 2rem;
    }
    #booth_visits .table th {
      font-size: 0.8rem;
    }
    #booth_visits .table td {
      font-size: 0.8rem;
    }

    marquee {
        width: 90%;
    }
    
  }

  @media screen and (max-width: 320px) {

      #zoom_countdown .display-4 {
          font-size: 0.6rem;
      }
    
  }

  @media screen and (max-width: 360px) {
      #zoom_countdown .display-4 {
          font-size: 0.7rem;
      }
      #zoom_countdown .lead {
          font-size: 0.4rem;
      }
      #zoom_countdown .intro {
        font-size: 0.6em;
      }
      #box .card-body {
          padding: 0.6rem !important; 
      }

      #booth_visits{
        width: 55%;
      }
      #booth_visits .display-4 {
        font-size: 2rem;
      }
      #booth_visits .table th {
        font-size: 0.6rem;
      }
      #booth_visits .table td {
        font-size: 0.6rem;
      }

      marquee {
        width: 90%;
      }
  }

@media screen and (max-width: 280px) {
    #zoom_countdown .display-4 {
          font-size: 0.7rem;
      }
      #zoom_countdown .lead {
          font-size: 0.4rem;
      }
      #zoom_countdown .intro {
        font-size: 0.4em;
      }
      #box .card-body {
          padding: 0.4rem !important; 
      }
      #booth_visits{
        width: 95%;
      }
      #booth_visits .display-4 {
        font-size: 2rem;
        padding-left: 5%;
      }
      #booth_visits .table th {
        font-size: 0.6rem;
      }
      #booth_visits .table td {
        font-size: 0.6rem;
      }

      marquee {
        width: 90%;
        height: 5%;
        font-weight:600;
        color:firebrick;
      }
}

@media screen and (max-width: 1024px) {

      marquee {
        width: 90%;
      }

}
 

  

</style>
