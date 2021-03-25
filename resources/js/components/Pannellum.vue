<template >
    <div class="background full">
      <div id="panorama">

      </div>
    </div>
</template>
<script>
export default {
    data() {
      return {
        booths: null
      }
    },
    mounted() {
        this.init()
    },
    methods:{
      async init(){
        let vm = this
        let {data} = await axios.get('api/v1/booths')
        this.$store.commit('updateBooths', data)
        this.booths = _.filter(this.$store.getters.booths, ['panorama_location', 'lobby'])
        for(let i in this.booths){
          this.booths[i].cssClass = "custom-hotspot booth"
          this.booths[i].clickHandlerFunc = ()=>{ this.$router.push('/sponsors/'+this.booths[i].id)}
        }
        let panorama_details = {   
            "default": {
                "firstScene": "lobby",
                "sceneFadeDuration": 500,
                "autoLoad": true,
                "showControls": false,
                // uncomment the code below to get the PITCH and YAW of hotspot - console
                // "hotSpotDebug": true,
            },

            "scenes": {
                "lobby": {
                    "type": "equirectangular",
                    "panorama": "/images/lobby.png",
                    "hotSpots": [
                        // meeting hall left
                        {
                            "pitch": 12.9,
                            "yaw": -23.5,
                            "type": "scene",
                            "cssClass": "custom-hotspot meeting_hall",
                            "sceneId": "meeting_hall"
                        },
                        // meeting hall right
                        {
                            "pitch": 12.9,
                            "yaw": 23.3,
                            "type": "scene",
                            "cssClass": "custom-hotspot meeting_hall",
                            "sceneId": "meeting_hall"
                        },
                        // hall a
                        {
                            "pitch": 1.9,
                            "yaw": -21.3,
                            "type": "scene",
                            "cssClass": "custom-hotspot exhibit_hall",
                            "sceneId": "exhibit_hall_a"
                        },
                        // hall b
                        {
                            "pitch": -3,
                            "yaw": -21.3,
                            "type": "scene",
                            "cssClass": "custom-hotspot exhibit_hall",
                            "sceneId": "exhibit_hall_b"
                        },
                        // hall c
                        {
                            "pitch": 1.9,
                            "yaw": 21.3,
                            "type": "scene",
                            "cssClass": "custom-hotspot exhibit_hall",
                            "sceneId": "exhibit_hall_c"
                        },
                        // hall d
                        {
                            "pitch": -3,
                            "yaw": 21.3,
                            "type": "scene",
                            "cssClass": "custom-hotspot exhibit_hall",
                            "sceneId": "exhibit_hall_d"
                        },
                    ]
                },

                "meeting_hall": {
                    "type": "equirectangular",
                    "panorama": "/images/stage-min.png",
                    "hotSpots": [
                        {
                            "pitch": 3.8,
                            "yaw": -29.6,
                            "type": "scene",
                            "cssClass": "custom-hotspot left_arrow",
                            "sceneId": "lobby",
                        },
                        {
                            "pitch": 3.8,
                            "yaw": 29.6,
                            "type": "scene",
                            "cssClass": "custom-hotspot right_arrow",
                            "sceneId": "lobby",
                        },
                    ]
                },
                "exhibit_hall_a" :{
                  "type": "equirectangular",
                    "panorama": "/images/hall.png",
                    "hotSpots": [
                        {
                            "pitch": -3,
                            "yaw": -0,
                            "type": "scene",
                            "cssClass": "custom-hotspot left_arrow",
                            "sceneId": "lobby",
                        },
                        {
                            "pitch": 10.6,
                            "yaw": -10.6,
                            "type": "scene",
                            "cssClass": "custom-hotspot meeting_hall",
                            "sceneId": "meeting_hall",
                        },
                        {
                            "pitch": 10.6,
                            "yaw": 10.6,
                            "type": "scene",
                            "cssClass": "custom-hotspot meeting_hall",
                            "sceneId": "meeting_hall",
                        },
                    ]
                },
                "exhibit_hall_b" :{
                  "type": "equirectangular",
                    "panorama": "/images/hall.png",
                    "hotSpots": [
                        {
                            "pitch": -3,
                            "yaw": -0,
                            "type": "scene",
                            "cssClass": "custom-hotspot left_arrow",
                            "sceneId": "lobby",
                        },
                        {
                            "pitch": 10.6,
                            "yaw": -10.6,
                            "type": "scene",
                            "cssClass": "custom-hotspot meeting_hall",
                            "sceneId": "meeting_hall",
                        },
                        {
                            "pitch": 10.6,
                            "yaw": 10.6,
                            "type": "scene",
                            "cssClass": "custom-hotspot meeting_hall",
                            "sceneId": "meeting_hall",
                        },
                    ]
                },
                "exhibit_hall_c" :{
                  "type": "equirectangular",
                    "panorama": "/images/hall.png",
                    "hotSpots": [
                        {
                            "pitch": -3,
                            "yaw": -0,
                            "type": "scene",
                            "cssClass": "custom-hotspot left_arrow",
                            "sceneId": "lobby",
                        },
                        {
                            "pitch": 10.6,
                            "yaw": -10.6,
                            "type": "scene",
                            "cssClass": "custom-hotspot meeting_hall",
                            "sceneId": "meeting_hall",
                        },
                        {
                            "pitch": 10.6,
                            "yaw": 10.6,
                            "type": "scene",
                            "cssClass": "custom-hotspot meeting_hall",
                            "sceneId": "meeting_hall",
                        },
                    ]
                },
                "exhibit_hall_d" :{
                  "type": "equirectangular",
                    "panorama": "/images/hall.png",
                    "hotSpots": [
                        {
                            "pitch": -3,
                            "yaw": -0,
                            "type": "scene",
                            "cssClass": "custom-hotspot left_arrow",
                            "sceneId": "lobby",
                        },
                        {
                            "pitch": 10.6,
                            "yaw": -10.6,
                            "type": "scene",
                            "cssClass": "custom-hotspot meeting_hall",
                            "sceneId": "meeting_hall",
                        },
                        {
                            "pitch": 10.6,
                            "yaw": 10.6,
                            "type": "scene",
                            "cssClass": "custom-hotspot meeting_hall",
                            "sceneId": "meeting_hall",
                        },
                    ]
                }
            }
        }
        panorama_details.scenes.lobby.hotSpots.push(...this.booths)
        pannellum.viewer('panorama', panorama_details );        
      },
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
</style>