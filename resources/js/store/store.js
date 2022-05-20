import Vue from 'vue/dist/vue';
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    isWelcomed: true,
    roles: [
        {value: 'ADMIN', key: 'admin'},
        {value: 'SPONSOR', key: 'sponsor'},
    ],
    booths:null,
    user: null,
    permissions: null,
    api_token: null,
    users:null,
    currentScene: 'lobby',
    bgmStart: true,
    bgm: null,
    audio: new Audio('/bgm/landing.mp3'),
    booth_details: null,
    announcement: null,
    isNotAllowed: null,
    isNotAllowedMessage: '',
    scene_hotSpots: [
      {
        "scene": 'landing',
        "type": "scene",
        "pitch": -7.3,
        "yaw": 37.3,
        "cssClass": "custom-hotspot arrow_left",
        "sceneId": "main_entrance",
      },
      {
        "scene": 'main_entrance',
        "type": "scene",
        "pitch": -7.78,
        "yaw": -4.33,
        "cssClass": "custom-hotspot enter",
        "sceneId": "lobby",
      },
      {
        "scene": 'main_entrance',
        "type": "scene",
        "pitch": -7.78,
        "yaw": 3.89,
        "cssClass": "custom-hotspot enter",
        "sceneId": "lobby",
      },

      // LOBBY HOTSPOTS
      {
        "scene": 'lobby',
        "type": "scene",
        "pitch": 1.14,
        "yaw": -13.30,
        "cssClass": "custom-hotspot enter",
        "sceneId": "meeting_hall",
      },

      {
        "scene": 'lobby',
        "type": "info",
        "pitch": 2.45,
        "yaw": -162.28,
        "text": "Transcending Barriers: The PSP on its commitment to excellence and unceasing innovation in the midst of a pandemic",
      },

      // {
      //   "scene": 'lobby',
      //   "type": "scene",
      //   "pitch": 11.12,
      //   "yaw": -29.65,
      //   "cssClass": "custom-hotspot hall_a",
      //   "sceneId": "hall_a",
      // },

      // {
      //   "scene": 'lobby',
      //   "type": "scene",
      //   "pitch": 12.08,
      //   "yaw": -18.84,
      //   "cssClass": "custom-hotspot hall_b",
      //   "sceneId": "hall_b",
      // },

      // {
      //   "scene": 'lobby',
      //   "type": "scene",
      //   "pitch": 12.58,
      //   "yaw": -6.25,
      //   "cssClass": "custom-hotspot hall_c",
      //   "sceneId": "hall_c",
      // },

      // {
      //   "scene": 'lobby',
      //   "type": "scene",
      //   "pitch": 12.65,
      //   "yaw": 7.15,
      //   "cssClass": "custom-hotspot hall_d",
      //   "sceneId": "hall_d",
      // },
      // {
      //   "scene": 'lobby',
      //   "type": "info",
      //   "pitch": 31.72,
      //   "yaw": -179,
      //   "text": "Dr. Nelson T. Geraldino's Orchid Collection",
      // },
      // {
      //   "scene": 'lobby',
      //   "type": "scene",
      //   "pitch": -0.93,
      //   "yaw": 21.24,
      //   "cssClass": "custom-hotspot enter",
      //   "sceneId": "hall",
      // },
      // {
      //   "scene": 'lobby',
      //   "type": "scene",
      //   "pitch": 0.36,
      //   "yaw": 164.62,
      //   "cssClass": "custom-hotspot enter",
      //   "sceneId": "main_entrance",
      // },
      // {
      //   "scene": 'lobby',
      //   "type": "scene",
      //   "pitch": 0.15,
      //   "yaw": -164.26,
      //   "cssClass": "custom-hotspot enter",
      //   "sceneId": "main_entrance",
      // },
      {
        "scene": 'hall',
        "type": "scene",
        "pitch": -12.0,
        "yaw": -16.0,
        "cssClass": "custom-hotspot hall_a",
        "sceneId": "hall_a",
      },
      {
        "scene": 'hall',
        "type": "scene",
        "pitch": 4.9,
        "yaw": 11.6,
        "cssClass": "custom-hotspot arrow_right",
        "sceneId": "secondf_meeting_hall",
      }, 
      {
        "scene": 'secondf_meeting_hall',
        "type": "scene",
        "pitch": -0.7,
        "yaw": -17.0,
        "cssClass": "custom-hotspot enter",
        "sceneId": "meeting_hall",
      }, 
      {
        "scene": 'secondf_meeting_hall',
        "type": "scene",
        "pitch": -0.7,
        "yaw": 21.1,
        "cssClass": "custom-hotspot enter",
        "sceneId": "meeting_hall",
      },
      {
        "scene": 'secondf_meeting_hall',
        "type": "scene",
        "pitch": -20.3,
        "yaw": 107.8,
        "cssClass": "custom-hotspot hall_a",
        "sceneId": "hall_a",
      },
      {
        "scene": 'secondf_meeting_hall',
        "type": "scene",
        "pitch": -13.6,
        "yaw": 95.1,
        "cssClass": "custom-hotspot hall_b",
        "sceneId": "hall_b",
      },
      {
        "scene": 'secondf_meeting_hall',
        "type": "scene",
        "pitch": -15.4,
        "yaw": 67.7,
        "cssClass": "custom-hotspot hall_c",
        "sceneId": "hall_c",
      },
      {
        "scene": 'secondf_meeting_hall',
        "type": "scene",
        "pitch": -26.5,
        "yaw": 67.7,
        "cssClass": "custom-hotspot hall_d",
        "sceneId": "hall_d",
      },
      {
        "scene": 'hall',
        "type": "scene",
        "pitch": 4.5,
        "yaw": -14.9,
        "cssClass": "custom-hotspot arrow_left",
        "sceneId": "pool_area",
      },   

      // HALL A HOTSPOT
      {
        "scene": 'hall_a',
        "type": "scene",
        "pitch": 8.68,
        "yaw": -14.92,
        "cssClass": "custom-hotspot hall_b",
        "sceneId": "hall_b",
      },

      {
        "scene": 'hall_a',
        "type": "scene",
        "pitch": 8.56,
        "yaw": 15.33,
        "cssClass": "custom-hotspot hall_c",
        "sceneId": "hall_c",
      },

      {
        "scene": 'hall_a',
        "type": "scene",
        "pitch": 9.61,
        "yaw": 0,
        "cssClass": "custom-hotspot enter",
        "sceneId": "meeting_hall",
      },
      {
        "scene": 'hall_a',
        "type": "scene",
        "pitch": 7.32,
        "yaw": 36.45,
        "cssClass": "custom-hotspot hall_d",
        "sceneId": "hall_d",
      },

      {
        "scene": 'hall_a',
        "type": "scene",
        "pitch": -1.52,
        "yaw": -0.10,
        "cssClass": "custom-hotspot enter",
        "sceneId": "lobby",
      },


      {
        "scene": 'pool_area',
        "type": "scene",
        "pitch": -12.62,
        "yaw": -98.01,
        "cssClass": "custom-hotspot enter",
        "sceneId": "hall_a",
      },
      {
        "scene": 'hall',
        "type": "scene",
        "pitch": -12.0,
        "yaw": 16.0,
        "cssClass": "custom-hotspot hall_d",
        "sceneId": "hall_d",
      },


      // HALL C HOTSPOTS
      {
        "scene": 'hall_c',
        "type": "scene",
        "pitch": 7.04,
        "yaw": -36.73,
        "cssClass": "custom-hotspot hall_a",
        "sceneId": "hall_a",
      },
      {
        "scene": 'hall_c',
        "type": "scene",
        "pitch": 8.68,
        "yaw": -14.92,
        "cssClass": "custom-hotspot hall_b",
        "sceneId": "hall_b",
      },
      {
        "scene": 'hall_c',
        "type": "scene",
        "pitch": 9.61,
        "yaw": 0,
        "cssClass": "custom-hotspot enter",
        "sceneId": "meeting_hall",
      },
      {
        "scene": 'hall_c',
        "type": "scene",
        "pitch": 7.32,
        "yaw": 36.45,
        "cssClass": "custom-hotspot hall_d",
        "sceneId": "hall_d",
      },

      {
        "scene": 'hall_c',
        "type": "scene",
        "pitch": -1.52,
        "yaw": -0.10,
        "cssClass": "custom-hotspot enter",
        "sceneId": "lobby",
      },


      {
        "scene": 'hall',
        "type": "scene",
        "pitch": -22.8,
        "yaw": -34.1,
        "cssClass": "custom-hotspot hall_b",
        "sceneId": "hall_b",
      },

      // HALL B HOTSPOTS
      {
        "scene": 'hall_b',
        "type": "scene",

        "pitch": 7.04,
        "yaw": -36.73,
        "cssClass": "custom-hotspot hall_a",
        "sceneId": "hall_a",
      },
      {
        "scene": 'hall_b',
        "type": "scene",
        "pitch": 8.56,
        "yaw": 15.33,
        "cssClass": "custom-hotspot hall_c",
        "sceneId": "hall_c",
      },
      {
        "scene": 'hall_b',
        "type": "scene",
        "pitch": 9.61,
        "yaw": 0,
        "cssClass": "custom-hotspot enter",
        "sceneId": "meeting_hall",
      },
      {
        "scene": 'hall_b',
        "type": "scene",
        "pitch": 7.32,
        "yaw": 36.45,
        "cssClass": "custom-hotspot hall_d",
        "sceneId": "hall_d",
      },

      {
        "scene": 'hall_b',
        "type": "scene",
        "pitch": -1.52,
        "yaw": -0.10,
        "cssClass": "custom-hotspot enter",
        "sceneId": "lobby",
      },
      
      
      {
        "scene": 'hall',
        "type": "scene",
        "pitch": -22.8,
        "yaw": 34.1,
        "cssClass": "custom-hotspot hall_c",
        "sceneId": "hall_c",
      },

      // HALL D HOTSPOTS
      {
        "scene": 'hall_d',
        "type": "scene",

        "pitch": 7.04,
        "yaw": -36.73,
        "cssClass": "custom-hotspot hall_a",
        "sceneId": "hall_a",
      },
      {
        "scene": 'hall_d',
        "type": "scene",
        "pitch": 8.68,
        "yaw": -14.92,
        "cssClass": "custom-hotspot hall_b",
        "sceneId": "hall_b",
      },
      {
        "scene": 'hall_d',
        "type": "scene",
        "pitch": 9.61,
        "yaw": 0,
        "cssClass": "custom-hotspot enter",
        "sceneId": "meeting_hall",
      },
      {
        "scene": 'hall_d',
        "type": "scene",
        "pitch": 8.56,
        "yaw": 15.33,
        "cssClass": "custom-hotspot hall_c",
        "sceneId": "hall_c",
      },

      {
        "scene": 'hall_d',
        "type": "scene",
        "pitch": -1.52,
        "yaw": -0.10,
        "cssClass": "custom-hotspot enter",
        "sceneId": "lobby",
      },


      // MEETING HALL HOTSPOTS
      {
        "scene": 'meeting_hall',
        "pitch": 2.71,
        "yaw": -49.66,
        "type": "scene",
        "cssClass": "custom-hotspot enter",
        "sceneId": "lobby",
      },
      {
        "scene": 'meeting_hall',
        "pitch": 2.26,
        "yaw": 49.62,
        "type": "scene",
        "cssClass": "custom-hotspot enter",
        "sceneId": "lobby",
      },




      {
        "id": 'zoom_meeting',
        "scene": 'meeting_hall',
        "pitch": 3.8,
        "yaw": 0,
        "type": "scene",
        "cssClass": "custom-hotspot zoom open-zoom-meeting",
      },
      {
        "scene": 'exhibit_hall',
        "pitch": -3,
        "yaw": -0,
        "type": "scene",
        "cssClass": "custom-hotspot left_arrow",
        "sceneId": "lobby",
      },
      {
        "scene": 'exhibit_hall',
        "pitch": 10.6,
        "yaw": -10.6,
        "type": "scene",
        "cssClass": "custom-hotspot meeting_hall",
        "sceneId": "meeting_hall",
      },
      {
        "scene": 'exhibit_hall',
        "pitch": 10.6,
        "yaw": 10.6,
        "type": "scene",
        "cssClass": "custom-hotspot meeting_hall",
        "sceneId": "meeting_hall",
      },
      {
        "scene": 'secondf_outside',
        "pitch": -1.6,
        "yaw": -1.1,
        "type": "scene",
        "cssClass": "custom-hotspot arrow_left",
        "sceneId": "hall_c",
      },
      {
        "scene": 'pool_area',
        "pitch": -2.3,
        "yaw": 2.6,
        "type": "scene",
        "cssClass": "custom-hotspot arrow_up",
        "sceneId": "pool_area2",
      },
      {
        "scene": 'pool_area2',
        "pitch": -3.4,
        "yaw": -123,
        "type": "scene",
        "cssClass": "custom-hotspot arrow_up",
        "sceneId": "pool_area",
      },


    ]

    // sponsors:[
    //   {id: 1, name: 'Johnson & Johnson', x: 3663.38, y: -102.64, z: 3392.30, direction: 'NW'},
    //   {id: 2, name: 'Astra Zenica', x: 3459.15, y: -183.72, z:-3592.03, direction: 'NE'},
    //   {id: 3, name: 'Novavax', x: -2616.53, y: -168.16, z: 4246.58, direction: 'SW'},
    //   {id: 4, name: 'Pfizer', x: -2881.17, y: -204.73, z: -4073.01, direction: 'SE'},
    // ],
    // halls:[

    //   {name: 'Hall A', x: 4669.04, y: 157.28, z: 1752.54, panorama: 'hallPanorama_A'},
    //   {name: 'Hall B', x: 4670.81, y: -275.96, z: 1734.92, panorama: 'hallPanorama_B'},
    //   {name: 'Hall C', x: 4686.30, y: 154.93, z: -1707.82, panorama: 'hallPanorama_C'},
    //   {name: 'Hall D', x: 4680.38, y: -272.51, z: -1710.38, panorama: 'hallPanorama_D'},
    // ],
    // meetingHalls: [
    //   {name: 'Meeting Hall', x: 4483.87, y: 1004.02, z: 1957.63},
    //   {name: 'Meeting Hall', x: 4476.78, y: 1030.80, z: -1961.26},
    // ]

  },
  mutations: {
    // setter
    // this.$store.commit('change', event.target.value)

    // getter
    // $store.getters.flavor
    // change(state, flavor) {
    //   state.flavor = flavor
    // }
    updateIsNotAllowedMessage(state, isNotAllowedMessage){
        state.isNotAllowedMessage = isNotAllowedMessage;
    },
    updateIsAllowed(state, isNotAllowed){
        state.isNotAllowed = isNotAllowed;
    },
    updateBooths(state, booths) {
        state.booths = booths
      },
    changeUser(state, user) {
      state.user = user
    },
    updateIsWelcomed(state, isWelcomed) {
      state.isWelcomed = isWelcomed
    },
    changeCurrentScene(state, scene) {
      state.currentScene = scene
    },
    updateBgmStart(state, start) {
      

      // console.log(state.audio)
      state.bgmStart = start
      if(!start){
        state.audio.pause()
        // bgm.currentTime = 0;
      }else{
        state.audio.play()
      }
    },
    changeBoothDetails(state, booth_details) {
      state.booth_details = booth_details
    },
    changeAnnouncement(state, announcement){
      state.announcement = announcement

    },
    updateAudioSource(state, src){
      state.audio.pause()
      state.audio.currentTime = 0
      state.audio = new Audio(src)
      state.audio.loop = true
      state.audio.play()
    },
    
  },
  getters: {
    pois: state => state.pois,
    assets: state => state.assets,
    booths: state => state.booths,
    user: state => state.user,
    halls: state => state.halls,
    sponsors: state => state.sponsors,
    meetingHalls: state => state.meetingHalls,
    isWelcomed: state => state.isWelcomed,
    currentScene: state => state.currentScene,
    scene_hotSpots: state => state.scene_hotSpots,
    bgmStart: state => state.bgmStart,
    booth_details: state => state.booth_details,
    announcement: state => state.announcement,
    isNotAllowed: state => state.isNotAllowed,
    isNotAllowedMessage: state => state.isNotAllowedMessage,
    audio: state => state.audio,
  },
  actions:{
    getBgm({commit}){
      // alert('test')
      
      
      commit('updateBgmStart', true)
    }
  }
})
