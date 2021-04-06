<template >
    <div class="background full">
      <div id="panorama">
      </div>
      <Sidebar @handleNavigateTo="handleNavigateTo"></Sidebar>
      <Modal :value="$store.getters.isWelcomed">
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
        showModal: true
      }
    },
    mounted() {
       this.init()
       window.addEventListener("resize", this.reSize);

      //  setInterval(()=>{console.log(this.viewer.getScene())}, 1000)

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
                      "basePath": "/images/multires/lobby",
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
                        "cssClass": "custom-hotspot meeting_hall",

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
                "exhibit_hall_a" :{
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
                "exhibit_hall_b" :{
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
                "exhibit_hall_c" :{
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
                "exhibit_hall_d" :{
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

        this.panorama_details.scenes.exhibit_hall_a.hotSpots.push(..._.filter(this.$store.getters.scene_hotSpots, ['scene', 'exhibit_hall']))
        this.panorama_details.scenes.exhibit_hall_a.hotSpots.push(...this.hall_a_booths)

        this.panorama_details.scenes.exhibit_hall_b.hotSpots.push(..._.filter(this.$store.getters.scene_hotSpots, ['scene', 'exhibit_hall']))
        this.panorama_details.scenes.exhibit_hall_b.hotSpots.push(...this.hall_b_booths)

        this.panorama_details.scenes.exhibit_hall_c.hotSpots.push(..._.filter(this.$store.getters.scene_hotSpots, ['scene', 'exhibit_hall']))
        this.panorama_details.scenes.exhibit_hall_c.hotSpots.push(...this.hall_c_booths)

        this.panorama_details.scenes.exhibit_hall_d.hotSpots.push(..._.filter(this.$store.getters.scene_hotSpots, ['scene', 'exhibit_hall']))
        this.panorama_details.scenes.exhibit_hall_d.hotSpots.push(...this.hall_d_booths)

        // this.viewer = pannellum.viewer('panorama', { 'scenes': [], 'autoLoad': true, 'showFullscreenCtrl': false, 'showZoomCtrl': false });
        this.viewer= pannellum.viewer('panorama', this.panorama_details );
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
        this.sendGuestEvent('click', label)
      },
      handleUpdateIsWelcomed(){
        this.$store.commit('updateIsWelcomed', false)
      },
      handleBoothClicked(booth){
        const label = booth.name+" booth"
        this.$router.push('sponsors/'+booth.id)
        this.sendGuestEvent('click', label, booth)
      },
      handleHotspotClicked(scene){
        const label = scene+" hotspot"
        this.sendGuestEvent('click', label)
      },
      async sendGuestEvent(event, label, booth = null){
        // category: lobby,
        // label: click Astra Zeneca Booth
        let fd = new FormData()
        fd.append('category', booth != null ? booth.name : this.$store.getters.currentScene)
        fd.append('label', event+" "+label)
        fd.append('user', this.$store.getters.user.id)

        let {data} = await axios.post('/api/v1/guests/event/push?api_token='+localStorage.getItem('access_token'), fd);
      }
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
  div >>> .meeting_hall{
    background-image: url('/images/icons/meeting-hall-icon-min.png');
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

  }
  .pnlm-about-msg >>> a {
    display: none;
  }

</style>
