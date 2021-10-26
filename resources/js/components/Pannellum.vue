<template >
    <div class="background full">
      <!-- BOOTH TRACKER -->
      <div class="booth_tracker">
        <h1><i class="fa fa-address-card text-dark" type="button" @click="handleBoothTracker" title="View My Activity" aria-hidden="true" ></i></h1>
      </div>

      <div id="booth_visits" class="bg-light text-dark table-responsive">
        <h3 class="display-4">Booth Tracker</h3>
        <!-- <hr> -->
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
      <div id="zoom_countdown" v-if="enabled">
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
            <div class="col text-center intro" style="color: red;"><small><b>{{zoom_title}}</b></small></div>
          </div>

        </div>
      </div>
      <div v-if="this.standee_dtls">
       <CoolLightBox
          :items="standee_dtls"
          :index="standee_index"
          :useZoomBar="true"
          @close="standee_index = null">
        </CoolLightBox>
      </div>

      <div id="panorama">
        <div id="controls" v-if="$store.getters.currentScene === 'hall_a' || $store.getters.currentScene === 'hall_b' || $store.getters.currentScene === 'hall_c' || $store.getters.currentScene === 'hall_d' ">
          <div class="ctrl custom-hotspot hall_a" @click="handleNavigateTo('hall_a')" :style="$store.getters.currentScene === 'hall_a' ? 'padding:5px;' : ''">
          </div>
          <div class="ctrl custom-hotspot hall_b" @click="handleNavigateTo('hall_b')" :style="$store.getters.currentScene === 'hall_b' ? 'padding:5px;' : ''"></div>
          <div class="ctrl custom-hotspot hall_c" @click="handleNavigateTo('hall_c')" :style="$store.getters.currentScene === 'hall_c' ? 'padding:5px;' : ''"></div>
          <div class="ctrl custom-hotspot hall_d" @click="handleNavigateTo('hall_d')" :style="$store.getters.currentScene === 'hall_d' ? 'padding:5px;' : ''"></div>
        </div>
      </div>

      <Sidebar @handleNavigateTo="handleNavigateTo"></Sidebar>
      <Modal :value="$store.getters.isWelcomed" v-if="$store.getters.user">
        <template v-slot:title >
            <h3 class="display-4 mt-3 text-light" style="font-size: 2em;">Hello {{$store.getters.user.first_name}},</h3>
        </template>
        <template v-slot:body>
            <p class="text-center lead text-success mt-3 mb-3"><strong> Welcome to the First PSP Virtual Event</strong></p>
        </template>
        <template v-slot:footer >
            <button class="btn btn-primary" type="button" @click="handleUpdateIsWelcomed">
              <i class="fa fa-caret-right"></i> proceed</button>
        </template>
      </Modal>

      <Modal :value="$store.getters.isNotAllowed" v-if="$store.getters.user">
        <template v-slot:title >
            <h3 class="display-4 mt-3">Hello {{$store.getters.user.first_name}},</h3>
        </template>
        <template v-slot:body>
            <p class="text-center lead text-success mt-3 mb-3"><strong> {{$store.getters.isNotAllowedMessage}}</strong></p>
        </template>
        <template v-slot:footer >
            <button class="btn btn-primary" type="button" @click="handleIsNotAllowedClose">
              <i class="fa fa-caret-right"></i> Ok</button>
        </template>
      </Modal>
      <marquee style="background-color:#fff; color: #00008b;" class="text-uppercase" v-if="$store.getters.announcement != null" direction="left"> {{$store.getters.announcement.payload.title}}: {{$store.getters.announcement.payload.message}}</marquee>

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
        booths: [],
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
        enabled: null,
        sponsor_booth: null,
        visited_booths: null,

        announcement: null,
        zoom_title: null,

        show_standee: false,
        standee_dtls: [],
        standee_index: null,
        standees: null,
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
        console.log(data)

        for(let i in data){
          data[i]['src'] = data[i].url
        }

        this.$store.commit('updateBooths', data)
        this.booths = data

        this.standees = _.filter(this.booths, ['type', 'standee'])
        // console.log(this.booths)


        this.panorama_details = {
            "default": {
                "firstScene": this.sceneId ? this.sceneId : "landing",
                "sceneFadeDuration": 500,
                "autoLoad": true,
                "showControls": false,
                // uncomment the code below to get the PITCH and YAW of hotspot - console
                "hotSpotDebug": true,
            },

            "scenes": {
              "landing": {
                "type": "multires",
                "multiRes": {
                  "basePath": "/images/multires/landing",
                  "path": "/%l/%s%y_%x",
                  "fallbackPath": "/fallback/%s",
                  "extension": "jpg",
                  "tileResolution": 512,
                  "maxLevel": 3,
                  "cubeResolution": 1904,
                },
                "hotSpots": [
                ],
                // 180 view | 360 view = 180 view x 2
                'minPitch' :-45,
                'maxPitch' :45,
                'minYaw': -90,
                'maxYaw':90,   
              },
              "main_entrance": {
                "type": "multires",
                "multiRes": {
                  "basePath": "/images/multires/main_entrance",
                  "path": "/%l/%s%y_%x",
                  "fallbackPath": "/fallback/%s",
                  "extension": "jpg",
                  "tileResolution": 512,
                  "maxLevel": 3,
                  "cubeResolution": 1904,
                },
                "hotSpots": [
                ],
                // 180 view | 360 view = 180 view x 2
                'minPitch' :-45,
                'maxPitch' :45,
                'minYaw': -90,
                'maxYaw':90,   
              },
              "lobby": {
                "type": "multires",
                "multiRes": {
                  "basePath": "/images/multires/lobby",
                  "path": "/%l/%s%y_%x",
                  "fallbackPath": "/fallback/%s",
                  "extension": "jpg",
                  "tileResolution": 512,
                  "maxLevel": 3,
                  "cubeResolution": 1904,
                },
                  "hotSpots": [
                    {
                      // "clickHandlerFunc": ()=>{
                      //   this.$router.push('/vote');
                      // },
                      // "scene": 'lobby',
                      // "pitch": -2,
                      // "yaw": 10,
                      // "cssClass": "custom-hotspot vote",
                      // "id": "vote"
                    },
                  ],
                   
              },
              "hall": {
                "type": "multires",
                "multiRes": {
                  "basePath": "/images/multires/hall",
                  "path": "/%l/%s%y_%x",
                  "fallbackPath": "/fallback/%s",
                  "extension": "jpg",
                  "tileResolution": 512,
                  "maxLevel": 3,
                  "cubeResolution": 1904,
                },
                "hotSpots": [
                ],
                // 180 view | 360 view = 180 view x 2
                // 'minPitch' :-45,
                // 'maxPitch' :45,
                // 'minYaw': -90,
                // 'maxYaw':90,   
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
                  "cubeResolution": 1904,
                },
                "hotSpots": [
                  {
                    "clickHandlerFunc": ()=>{
                      this.$router.push('/sponsors/7');
                    },
                    "scene": 'lobby',
                    "pitch": 1.5,
                    "yaw": -89.6,
                    "cssClass": "custom-hotspot enter",
                  }                  

                ]
              },  
              "hall_a_silver" :{
                "type": "equirectangular",
                "panorama": "/images/multires/A-Silver.png",
                "hotSpots": [

                ],
                'minPitch' :-20,
                'maxPitch' :20,
                'minYaw': -50,
                'maxYaw':50, 
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
                  "cubeResolution": 1904,
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
                  "cubeResolution": 1904,
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
                  "cubeResolution": 1904,
                },
                "hotSpots": [
                ]
              },            

                
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
          this.viewer.removeHotSpot('vote')
          this.viewer.removeHotSpot('zoom_meeting')
          this.viewer.loadScene(this.$store.getters.user.booth.panorama_location)
          this.panorama_details.scenes.[this.$store.getters.user.booth.panorama_location].pitch = this.$store.getters.user.booth.pitch
          this.panorama_details.scenes.[this.$store.getters.user.booth.panorama_location].yaw = this.$store.getters.user.booth.yaw
          this.panorama_details.scenes.[this.$store.getters.user.booth.panorama_location].hotSpots.push(...this.sponsor_booth)

        }
        this.hall_a_booths = _.filter(this.$store.getters.booths, ['panorama_location', 'hall_a'])
        this.hall_b_booths = _.filter(this.$store.getters.booths, ['panorama_location', 'hall_b'])
        this.hall_c_booths = _.filter(this.$store.getters.booths, ['panorama_location', 'hall_c'])
        this.hall_d_booths = _.filter(this.$store.getters.booths, ['panorama_location', 'hall_d'])
        this.lobby_booths = _.filter(this.$store.getters.booths, ['panorama_location', 'lobby'])
        for(let i in this.$store.getters.scene_hotSpots){
          this.$store.getters.scene_hotSpots[i].clickHandlerFunc =  () => {this.handleHotspotClicked(this.$store.getters.scene_hotSpots[i].sceneId)}
        }
        this.panorama_details.scenes.landing.hotSpots.push(..._.filter(this.$store.getters.scene_hotSpots, ['scene', 'landing']))
        // this.panorama_details.scenes.landing.hotSpots.push(...this.lobby_booths)

        this.panorama_details.scenes.main_entrance.hotSpots.push(..._.filter(this.$store.getters.scene_hotSpots, ['scene', 'main_entrance']))
        this.panorama_details.scenes.lobby.hotSpots.push(..._.filter(this.$store.getters.scene_hotSpots, ['scene', 'lobby']))
        this.panorama_details.scenes.hall.hotSpots.push(..._.filter(this.$store.getters.scene_hotSpots, ['scene', 'hall']))
        // this.panorama_details.scenes.lobby.hotSpots.push(...this.lobby_booths)

        // this.panorama_details.scenes.meeting_hall.hotSpots.push(..._.filter(this.$store.getters.scene_hotSpots, ['scene', 'meeting_hall']))

        this.panorama_details.scenes.hall_a.hotSpots.push(..._.filter(this.$store.getters.scene_hotSpots, ['scene', 'hall_a']))
        // this.panorama_details.scenes.hall_a.hotSpots.push(...this.hall_a_booths)

        this.panorama_details.scenes.hall_b.hotSpots.push(..._.filter(this.$store.getters.scene_hotSpots, ['scene', 'hall_b']))
        // this.panorama_details.scenes.hall_b.hotSpots.push(...this.hall_b_booths)

        this.panorama_details.scenes.hall_c.hotSpots.push(..._.filter(this.$store.getters.scene_hotSpots, ['scene', 'hall_c']))
        // this.panorama_details.scenes.hall_c.hotSpots.push(...this.hall_c_booths)

        this.panorama_details.scenes.hall_d.hotSpots.push(..._.filter(this.$store.getters.scene_hotSpots, ['scene', 'hall_d']))
        // this.panorama_details.scenes.hall_d.hotSpots.push(...this.hall_d_booths)

        this.viewer= pannellum.viewer('panorama', this.panorama_details );
        // this.viewer = pannellum.viewer('panorama', { 'scenes': [], 'autoLoad': true, 'showFullscreenCtrl': false, 'showZoomCtrl': false });
        // this.viewer.on('scenechange', ()=>{console.log(this.viewer.getScene())})
        this.viewer.on('scenechange', this.handleSceneChange)
        this.viewer.on('load', this.handleSceneLoad);
        this.reSize()


      },
      handleIsNotAllowedClose(){
          this.$store.commit('updateIsAllowed', false);
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
        this.standee_dtls = []
        const label = booth.name+" booth"

        if(booth.type == 'standee'){

          booth['src'] = booth.url


          this.show_standee = true
          this.standee_dtls.push(booth)
          this.standee_index = 0;
          console.log(this.standee_index)

        } else {
          this.$router.push('sponsors/'+booth.id)
          this.$sendGuestEvent('click', label, booth)
        }
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
        this.zoom_title = data.title
        this.enabled = data.enabled

        // disable display
        let now = new Date()
        let start_at_ = data.start_at_
        if(now > start_at_){
            this.enabled = null
        }

        this.countDownEndTime =  this.start_at;
        this.countDownStart()
        let x = setInterval(()=>{
            this.countDownStart()
            if(this.distance < 0){
                clearInterval(x)
                this.enabled = false
            }
        }, 1000)
      },
      countDownStart(){

          let now = new Date().getTime();
          // if(now > this.start_at){
          //     this.isOpen = true
          // }
          this.distance = this.countDownEndTime - now;

          // Time calculations for days, hours, minutes and seconds
          this.days = Math.floor(this.distance / (1000 * 60 * 60 * 24));
          this.hours = Math.floor((this.distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
          this.minutes = Math.floor((this.distance % (1000 * 60 * 60)) / (1000 * 60));
          this.seconds = Math.floor((this.distance % (1000 * 60)) / 1000);
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
      },
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
  div >>> .arrow_left{
    background-image: url('/images/multires/ICONS/Arrow.png');
    background-size: cover;
  }  
  div >>> .enter{
    background-image: url('/images/multires/ICONS/Enter.png');
    background-size: cover;
  } 
  div >>> .hall_a{
    background-image: url('/images/multires/ICONS/A.png');
    background-size: cover;
  } 
  div >>> .hall_b{
    background-image: url('/images/multires/ICONS/B.png');
    background-size: cover;
  } 
  div >>> .hall_c{
    background-image: url('/images/multires/ICONS/C.png');
    background-size: cover;
  } 
  div >>> .hall_d{
    background-image: url('/images/multires/ICONS/D.png');
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

   #booth_visits h3 {
    /* background: url('/images/modal_header.jpg');
    background-position: center;
    background-repeat: no-repeat; */
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
