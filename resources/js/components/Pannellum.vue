<template>
    <div class="background full">
        <!-- BOOTH TRACKER -->
        <div class="booth_tracker">
            <h1>
                <i
                    class="fa fa-address-card text-dark"
                    type="button"
                    @click="handleBoothTracker"
                    title="View My Activity"
                    aria-hidden="true"
                    style="font-size: 42px;
                    background: -webkit-linear-gradient(#006595, #8241e4);
                    -webkit-background-clip: text;
                    -webkit-text-fill-color: transparent;"
                ></i>
            </h1>
        </div>

        <Modal :value="camera" v-if="camera">
            <template v-slot:title>
                <img src="/images/71st_logo.png" alt="" class="center_logo" />
                <br />
            </template>
            <br />
            <template v-slot:body>
                <PhotoboothModal :image="imageRendered" />
            </template>
            <template v-slot:footer>
                <button class="btnletsgo" type="button" @click="camera = false">
                    <i class="fa fa-arrow-right"></i> DONE
                </button>
            </template>
        </Modal>
        <!-- Selfie -->
        <div class="selfie">
            <h1>
                <i
                    class="fa fa-camera text-dark"
                    type="button"
                    @click="handleSelfie"
                    title="Take selfie here"
                    aria-hidden="true"
                ></i>
            </h1>
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
                            <td>{{ i.name }}</td>
                            <td>
                                <i
                                    v-if="i.visited != true"
                                    class="fa fa-times text-danger"
                                ></i>
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
        <!-- <div id="zoom_countdown" v-if="enabled">
            <div class="col-12">
                <div class="row">
                    <div class="col p-1" id="box">
                        <div class="card card-primary bg-dark text-light">
                            <div class="card-body text-center">
                                <p class="display-4 m-0">{{ zeroPad(days) }}</p>
                                <p class="lead m-0 text-light text-uppercase">
                                    days
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col p-1" id="box">
                        <div class="card card-primary bg-dark text-light">
                            <div class="card-body text-center">
                                <p class="display-4 m-0">
                                    {{ zeroPad(hours) }}
                                </p>
                                <p class="lead m-0 text-light text-uppercase">
                                    hrs
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col p-1" id="box">
                        <div class="card card-primary bg-dark text-light">
                            <div class="card-body text-center">
                                <p class="display-4 m-0">
                                    {{ zeroPad(minutes) }}
                                </p>
                                <p class="lead m-0 text-light text-uppercase">
                                    mins
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col p-1" id="box">
                        <div class="card card-primary bg-dark text-light">
                            <div class="card-body text-center">
                                <p class="display-4 m-0">
                                    {{ zeroPad(seconds) }}
                                </p>
                                <p class="lead m-0 text-light text-uppercase">
                                    secs
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col text-center intro" style="color: red;">
                        <small
                            ><b>{{ zoom_title }}</b></small
                        >
                    </div>
                </div>
            </div>
        </div> -->

        <div v-if="this.standee_dtls">
            <CoolLightBox
                :items="standee_dtls"
                :index="standee_index"
                :useZoomBar="true"
                @close="standee_index = null"
            >
            </CoolLightBox>
        </div>

        <div id="panorama"></div>

        <Sidebar
            @handleNavigateTo="handleNavigateTo"
            @handleBgmPlayToggle="handleBgmPlayToggle"
            @handleLogout="handleLogout"
            :bgmStatus="bgmStatus"
        ></Sidebar>

        <Modal :value="$store.getters.isNotAllowed" v-if="$store.getters.user">
            <template v-slot:title>
                <h3 class="display-4 mt-3">
                    Hi {{ $store.getters.user.first_name }},
                </h3>
            </template>
            <template v-slot:body>
                <p class="text-center lead text-success mt-3 mb-3">
                    <strong> {{ $store.getters.isNotAllowedMessage }}</strong>
                </p>
            </template>
            <template v-slot:footer>
                <button
                    class="btn btn-success"
                    type="button"
                    @click="handleIsNotAllowedClose"
                >
                    <i class="fa fa-caret-right"></i> Ok
                </button>
            </template>
        </Modal>

        <marquee
            style="background-color: rgb(255 255 255 / 40%); color: #212529; font-size: 1.2rem;"
            class="text-uppercase"
            v-if="$store.getters.announcement != null"
            direction="left"
        >
            {{ $store.getters.announcement.payload.title }}:
            {{ $store.getters.announcement.payload.message }}</marquee
        >
    </div>
</template>
<script>
import Sidebar from './Sidebar'
import Modal from './Modal'
import PhotoboothModal from './PhotoboothModal'
import MeetingHall from './MeetingHall/MeetingHall.js'

export default {
  components:{
    Sidebar, Modal, PhotoboothModal
  },
  props:['sceneId'],

    data() {
      return {
          bgmStatus: localStorage.getItem('bgmStatus'),
        imageRendered: null,
        camera: false,
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

        welcomeMessage: 'Welcome to our Virtual Convention Event',
      }
    },
    mounted() {
      this.init()
      window.addEventListener("resize", this.reSize);
      //  setInterval(()=>{console.log(this.viewer.getScene())}, 1000)
      this.loadTimer()
      this.handleLoadBoothTracker()
      document.getElementById('booth_visits').style.display = "none"
    //   this.bgmStatus = localStorage.getItem('bgmStatus')
    },
    methods:{
      async init(){
        let vm = this
        // auth:api
        let {data} = await axios.get('api/v1/booths?api_token='+localStorage.getItem('access_token'))
        // let {data} = await axios.get('api/v1/booths')

        for(let i in data){
          data[i]['src'] = data[i].url
        }

        this.$store.commit('updateBooths', data)
        this.booths = data

        this.standees = _.filter(this.booths, ['type', 'standee'])


        this.panorama_details = {
            "default": {
                "firstScene": localStorage.getItem('sceneId'),
                "sceneFadeDuration": 500,
                "autoLoad": true,
                "showControls": false,
                'mouseZoom': false,
                // uncomment the code below to get the PITCH and YAW of hotspot - console
                // "hotSpotDebug": true,


            },

            "scenes": {
              "lobby": {

                "type": "equirectangular",
                "panorama": "/images/multires/lobby.jpg",
                  "hotSpots": [
                    {
                        pitch: 4.57,
                        yaw: -167.12,
                        cssClass: "custom-hotspot enter",
                        text: "logout",
                        clickHandlerFunc: () =>{
                            this.handleLogout()
                        }
                    },

                    // voting hot spot
                    // {
                    //     pitch: 0.50,
                    //     yaw: 14.31,
                    //     cssClass: "custom-hotspot vote",
                    //     text: "Voting",
                    //     clickHandlerFunc: () =>{
                    //         this.handleVote()
                    //     }
                    // },
                  ],


              },





              "psp_monument": {
                "type": "equirectangular",
                "panorama": "/images/multires/psp-monument.jpg",
                  "hotSpots": [

                  ],

              },
              "bar": {
                "type": "equirectangular",
                "panorama": "/images/multires/bar.jpg",
                  "hotSpots": [

                  ],

              },
              "microscope": {
                "type": "equirectangular",
                "panorama": "/images/multires/microscope.jpg",
                  "hotSpots": [

                  ],

              },
              "piano": {
                "type": "equirectangular",
                "panorama": "/images/multires/piano.jpg",
                  "hotSpots": [

                  ],

              },
              "meeting_hall": {

                "type": "equirectangular",
                "panorama": "/images/multires/Meeting_Hall.jpg",
                "hotSpots": [
                ],
                // 180 view | 360 view = 180 view x 2
                'minPitch' :-20,
                'maxPitch' :20,
                'minYaw': -55,
                'maxYaw':55,
              },
            //   "pool_area": {
            //     "type": "multires",
            //     "multiRes": {
            //       "basePath": "/images/multires/pool_area",
            //       "path": "/%l/%s%y_%x",
            //       "fallbackPath": "/fallback/%s",
            //       "extension": "jpg",
            //       "tileResolution": 512,
            //       "maxLevel": 3,
            //       "cubeResolution": 1904,
            //     },
            //     "hotSpots": [
            //     ],
            //     // 180 view | 360 view = 180 view x 2
            //     // 'minPitch' :-45,
            //     // 'maxPitch' :45,
            //     // 'minYaw': -90,
            //     // 'maxYaw':90,
            //   },

              "hall_a" :{
                "type": "equirectangular",
                "panorama": "/images/multires/Hall_A.jpg",
                  "hotSpots": [

                  ],

              },
              "hall_b" :{
                "type": "equirectangular",
                "panorama": "/images/multires/Hall_B.jpg",
                  "hotSpots": [

                  ],
              },
              "hall_c" :{
                "type": "equirectangular",
                "panorama": "/images/multires/Hall_C.jpg",
                  "hotSpots": [

                  ],
              },
              "hall_d" :{
                "type": "equirectangular",
                "panorama": "/images/multires/Hall_D.jpg",
                  "hotSpots": [

                  ],
              },
              "pool_area" :{
                "type": "equirectangular",
                "panorama": "/images/multires/pool_area.jpg",
                  "hotSpots": [

                  ],
              },

              "pool_area2" :{
                "type": "equirectangular",
                "panorama": "/images/multires/pool_area2.jpg",
                  "hotSpots": [

                  ],
              },

              "blue_room" :{
                "type": "equirectangular",
                "panorama": "/images/multires/Blue_Room.jpg",
                  "hotSpots": [

                  ],
              },
            }
        }
        for(let i in this.booths){
          this.booths[i].cssClass = this.booths[i].type !== 'standee' ? "custom-hotspot booth" : "custom-hotspot brochures"
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
          this.panorama_details.scenes.bar.hotSpots.push(..._.filter(this.$store.getters.scene_hotSpots, ['scene', 'bar']))
          this.panorama_details.scenes.piano.hotSpots.push(..._.filter(this.$store.getters.scene_hotSpots, ['scene', 'piano']))
          this.panorama_details.scenes.psp_monument.hotSpots.push(..._.filter(this.$store.getters.scene_hotSpots, ['scene', 'psp_monument']))

          this.panorama_details.scenes.meeting_hall.hotSpots.push(..._.filter(this.$store.getters.scene_hotSpots, ['scene', 'meeting_hall']))

          this.panorama_details.scenes.hall_a.hotSpots.push(..._.filter(this.$store.getters.scene_hotSpots, ['scene', 'hall_a']))
          this.panorama_details.scenes.hall_a.hotSpots.push(...this.hall_a_booths)

          this.panorama_details.scenes.hall_b.hotSpots.push(..._.filter(this.$store.getters.scene_hotSpots, ['scene', 'hall_b']))
          this.panorama_details.scenes.hall_b.hotSpots.push(...this.hall_b_booths)

          this.panorama_details.scenes.hall_c.hotSpots.push(..._.filter(this.$store.getters.scene_hotSpots, ['scene', 'hall_c']))
          this.panorama_details.scenes.hall_c.hotSpots.push(...this.hall_c_booths)

          this.panorama_details.scenes.hall_d.hotSpots.push(..._.filter(this.$store.getters.scene_hotSpots, ['scene', 'hall_d']))
          this.panorama_details.scenes.hall_d.hotSpots.push(...this.hall_d_booths)

          this.panorama_details.scenes.pool_area.hotSpots.push(..._.filter(this.$store.getters.scene_hotSpots, ['scene', 'pool_area']))
          this.panorama_details.scenes.pool_area2.hotSpots.push(..._.filter(this.$store.getters.scene_hotSpots, ['scene', 'pool_area2']))
          this.panorama_details.scenes.blue_room.hotSpots.push(..._.filter(this.$store.getters.scene_hotSpots, ['scene', 'blue_room']))
          this.panorama_details.scenes.microscope.hotSpots.push(..._.filter(this.$store.getters.scene_hotSpots, ['scene', 'microscope']))
          this.viewer= pannellum.viewer('panorama', this.panorama_details );
        }



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
        localStorage.setItem('sceneId', this.viewer.getScene())
        this.$store.commit('changeCurrentScene',this.viewer.getScene())
        switch(this.viewer.getScene()) {
          case 'landing':
            this.$store.commit('updateAudioSource', '/bgm/landing.mp3')
            break;
          case 'piano':
            this.$store.commit('updateAudioSource', '/bgm/piano.mp3')
            break;
          case 'lobby':
            this.$store.commit('updateAudioSource', '/bgm/lobby.mp3')
            break;
          case 'hall':
            this.$store.commit('updateAudioSource', '/bgm/lobby.mp3')
            break;
          case 'hall_a':
            this.$store.commit('updateAudioSource', '/bgm/hall_a.mp3')
            break;
          case 'hall_b':
            this.$store.commit('updateAudioSource', '/bgm/hall_b.mp3')
            break;
          case 'hall_c':
            this.$store.commit('updateAudioSource', '/bgm/hall_c.mp3')
            break;
          case 'hall_d':
            this.$store.commit('updateAudioSource', '/bgm/hall_d.mp3')
            break;
          case 'pool_area':
            this.$store.commit('updateAudioSource', '/bgm/pool.mp3')
            break;
          case 'pool_area2':
            this.$store.commit('updateAudioSource', '/bgm/pool.mp3')
            break;
          case 'blue_room':
            this.$store.commit('updateAudioSource', '/bgm/pool.mp3')
            break;
          case 'meeting_hall':
            this.$store.commit('updateAudioSource', '/bgm/meeting_hall.mp3')
            break;
          case 'secondf_meeting_hall':
            this.$store.commit('updateAudioSource', '/bgm/meeting_hall.mp3')
            break;
          case 'secondf_outside':
            this.$store.commit('updateAudioSource', '/bgm/landing.mp3')
            break;
          default:
            this.$store.commit('updateAudioSource', '')
            // code block
        }
            this.$store.getters.audio.volume = 0.1
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
        this.sceneId = null
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
        if(this.bgmStatus == 'true'){
          this.$store.commit('updateBgmStart', false)
          localStorage.setItem('bgmStatus', false)
          this.bgmStatus = 'false'
        }else{
          this.$store.commit('updateBgmStart', true)
          localStorage.setItem('bgmStatus', true)
          this.bgmStatus = 'true'

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

      handleSelfie(){
        this.camera = true
        const renderer = this.viewer.getRenderer();

        if(this.viewer.isLoaded()){

          const i = renderer.render(
              this.viewer.getPitch() / 180 * Math.PI,
              this.viewer.getYaw() / 180 * Math.PI,
              this.viewer.getHfov() / 180 * Math.PI,
              { returnImage: true },
            );

            this.imageRendered = i
        }
      },

      b64toBlob (b64Data, contentType='', sliceSize=512){
        const byteCharacters = atob(b64Data);
        const byteArrays = [];

        for (let offset = 0; offset < byteCharacters.length; offset += sliceSize) {
          const slice = byteCharacters.slice(offset, offset + sliceSize);

          const byteNumbers = new Array(slice.length);
          for (let i = 0; i < slice.length; i++) {
            byteNumbers[i] = slice.charCodeAt(i);
          }

          const byteArray = new Uint8Array(byteNumbers);
          byteArrays.push(byteArray);
        }

        const blob = new Blob(byteArrays, {type: contentType});
        return blob;
      },

      async handleLoadBoothTracker(){
        let {data} = await axios.get('api/v1/guests/booths/tracker?api_token='+localStorage.getItem('access_token'))
        this.visited_booths = data
      },

      testScreenshot(){
        const renderer = this.viewer.getRenderer();
        renderer.resize();
        if(this.viewer.isLoaded()){

          const i = renderer.render(
              this.viewer.getPitch() / 180 * Math.PI,
              this.viewer.getYaw() / 180 * Math.PI,
              this.viewer.getHfov() / 180 * Math.PI,
              { returnImage: true },
            );

        }
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
      // BOOTH TRACKER
// background: url(/images/loader.gif) 0 0;
    }
}
</script>
<style scoped>
.pnlm-container {
    /* background: #f1f2f3; */
    background: #fff url(/images/71st_logo.png) no-repeat center !important;
    background-size: contain !important;
}
div >>> .pnlm-load-box {
    background: url(/images/loader.gif) no-repeat center !important;
    background-size: contain !important;
    left: 50% !important;
}
div >>> .pnlm-load-box p {
    z-index: -999 !important;
    opacity: 0 !important;
}

div >>> .pnlm-lbox {
    z-index: -999 !important;
    opacity: 0 !important;
}
div >>> .pnlm-lbar {
    z-index: -999 !important;
    opacity: 0 !important;
}
div >>> .custom-hotspot {
    height: 32px;
    width: 32px;
    animation: pulse 2s infinite;
    border-radius: 50%;
}
div >>> .vote {
    background-image: url("/images/icons/vote.png");
    background-size: cover;
}

div >>> .meeting_hall {
    background-image: url("/images/icons/meeting-hall-icon-min.png");
    background-size: cover;
}
div >>> .zoom {
    background-image: url("/images/icons/zoom.png");
    background-size: cover;
}
div >>> .exhibit_hall {
    background-image: url("/images/icons/exhibit-hall-icon-min.png");
    background-size: cover;
}
div >>> .booth {
    background-image: url("/images/multires/ICONS/ENTER.png");
    background-size: cover;
}
div >>> .arrow_left {
    background-image: url("/images/multires/ICONS/ARROW.png");
    background-size: cover;
}
div >>> .arrow_right {
    background-image: url("/images/multires/ICONS/ARROW_RIGHT.png");
    background-size: cover;
}
div >>> .arrow_up {
    background-image: url("/images/multires/ICONS/ARROW_UP.png");
    background-size: cover;
}
div >>> .arrow_down {
    background-image: url("/images/multires/ICONS/ARROW_DOWN.png");
    background-size: cover;
}
div >>> .enter {
    background-image: url("/images/multires/ICONS/ENTER.png");
    background-size: cover;
}
div >>> .hall_a {
    background-image: url("/images/multires/ICONS/A.png");
    background-size: cover;
}
div >>> .hall_b {
    background-image: url("/images/multires/ICONS/B.png");
    background-size: cover;
}
div >>> .hall_c {
    background-image: url("/images/multires/ICONS/C.png");
    background-size: cover;
}
div >>> .hall_d {
    background-image: url("/images/multires/ICONS/D.png");
    background-size: cover;
}
div >>> .left_arrow {
    background-image: url("/images/icons/left_arrow-min.png");
    background-size: cover;
}
div >>> .right_arrow {
    background-image: url("/images/icons/right_arrow-min.png");
    background-size: cover;
}

div >>> .brochures {
    background-image: url("/images/icons/brochure.png");
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

div.full {
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

.center_logo {
    display: block;
    margin-left: auto;
    margin-right: auto;
    width: 50%;
}

.btnletsgo {
    margin-left: auto;
    margin-right: auto;
    background-color: #1e471f;
    border: none;
    color: white;
    padding: 10px 25px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 14px;
}
.booth_tracker {
    position: fixed;
    top: 0.1em;
    right: 0.5em;
    z-index: 2;
    cursor: pointer;
}

.selfie {
    position: fixed;
    bottom: 0.1em;
    right: 0.5em;
    z-index: 2;
    cursor: pointer;
}

#booth_visits {
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
    /* right: 0.8em; */
    /* border: 1px solid red; */
    /* width: 30%; */
    height: 5%;
    font-weight: 600;
    padding-top: 0.8rem;
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

.center_logo {
    display: block;
    margin-left: auto;
    margin-right: auto;
    width: 50%;
}

.btnletsgo {
    margin-left: auto;
    margin-right: auto;
    background-color: #1e471f;
    border: none;
    color: white;
    padding: 10px 25px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 14px;
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

    #booth_visits {
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

    #booth_visits {
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
    #booth_visits {
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
        font-weight: 600;
        color: firebrick;
    }
}

@media screen and (max-width: 1024px) {
    marquee {
        width: 90%;
    }
}
</style>
