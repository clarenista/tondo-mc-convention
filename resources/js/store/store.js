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
        "pitch": -4.9,
        "yaw": -4.1,
        "cssClass": "custom-hotspot enter",
        "sceneId": "lobby",
      },
      {
        "scene": 'main_entrance',
        "type": "scene",
        "pitch": -4.9,
        "yaw": 4.1,
        "cssClass": "custom-hotspot enter",
        "sceneId": "lobby",
      },
      {
        "scene": 'lobby',
        "type": "scene",
        "pitch": 2.6,
        "yaw": 21.5,
        "cssClass": "custom-hotspot enter",
        "sceneId": "hall",
      },
      {
        "scene": 'lobby',
        "type": "scene",
        "pitch": 2.6,
        "yaw": -21.5,
        "cssClass": "custom-hotspot enter",
        "sceneId": "hall",
      },
      {
        "scene": 'lobby',
        "type": "scene",
        "pitch": 11.6,
        "yaw": -193.2,
        "cssClass": "custom-hotspot enter",
        "sceneId": "main_entrance",
      },
      {
        "scene": 'lobby',
        "type": "scene",
        "pitch": 11.6,
        "yaw": -166.3,
        "cssClass": "custom-hotspot enter",
        "sceneId": "main_entrance",
      },
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
      {
        "scene": 'hall_a',
        "type": "scene",
        "pitch": -3.7,
        "yaw": -0.1,
        "cssClass": "custom-hotspot hall_b",
        "sceneId": "hall_b",
      },
      {
        "scene": 'hall_a',
        "type": "scene",
        "pitch": 19.0,
        "yaw": -138.1,
        "cssClass": "custom-hotspot arrow_right",
        "sceneId": "secondf_meeting_hall",
      },
      {
        "scene": 'hall_a',
        "type": "scene",
        "pitch": 42.2,
        "yaw": -197.8,
        "cssClass": "custom-hotspot arrow_left",
        "sceneId": "pool_area",
      },
      {
        "scene": 'pool_area',
        "type": "scene",
        "pitch": -5.3,
        "yaw": 262.2,
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

      {
        "scene": 'hall_c',
        "type": "scene",

        "pitch": -3.7,
        "yaw": -0.1,
        "cssClass": "custom-hotspot hall_d",
        "sceneId": "hall_d",
      },
      {
        "scene": 'hall_c',
        "type": "scene",
        "pitch": 8.7,
        "yaw": -181.0,
        "cssClass": "custom-hotspot arrow_left",
        "sceneId": "secondf_outside",
      },
      {
        "scene": 'hall_c',
        "type": "scene",
        "pitch": 15.0,
        "yaw": 4.1,
        "cssClass": "custom-hotspot arrow_right",
        "sceneId": "secondf_meeting_hall",
      },
      {
        "scene": 'hall',
        "type": "scene",
        "pitch": -22.8,
        "yaw": -34.1,
        "cssClass": "custom-hotspot hall_b",
        "sceneId": "hall_b",
      },
      {
        "scene": 'hall_b',
        "type": "scene",
        "pitch": -3.7,
        "yaw": -180.1,
        "cssClass": "custom-hotspot hall_a",
        "sceneId": "hall_a",
      },
      {
        "scene": 'hall_b',
        "type": "scene",
        "pitch": 1.4,
        "yaw": -4.0,
        "cssClass": "custom-hotspot enter",
        "sceneId": "lobby",
      },
      {
        "scene": 'hall_b',
        "type": "scene",
        "pitch": 1.4,
        "yaw": -28.3,
        "cssClass": "custom-hotspot enter",
        "sceneId": "lobby",
      },
      {
        "scene": 'hall_b',
        "type": "scene",
        "pitch": 19.0,
        "yaw": 173.9,
        "cssClass": "custom-hotspot arrow_left",
        "sceneId": "pool_area",
      },      
      {
        "scene": 'hall',
        "type": "scene",
        "pitch": -22.8,
        "yaw": 34.1,
        "cssClass": "custom-hotspot hall_c",
        "sceneId": "hall_c",
      },

      {
        "scene": 'hall_d',
        "type": "scene",
        "pitch": -3.7,
        "yaw": -180.1,
        "cssClass": "custom-hotspot hall_c",
        "sceneId": "hall_c",
      },
      {
        "scene": 'hall_d',
        "type": "scene",
        "pitch": 24.8,
        "yaw": 7.2,
        "cssClass": "custom-hotspot arrow_right",
        "sceneId": "secondf_meeting_hall",
      },
      {
        "scene": 'meeting_hall',
        "pitch": 1.0,
        "yaw": -48.7,
        "type": "scene",
        "cssClass": "custom-hotspot enter",
        "sceneId": "secondf_meeting_hall",
      },
      {
        "scene": 'meeting_hall',
        "pitch": 1.0,
        "yaw": -124.1,
        "type": "scene",
        "cssClass": "custom-hotspot enter",
        "sceneId": "secondf_meeting_hall",
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
        "pitch": -3.4,
        "yaw": -193.5,
        "type": "scene",
        "cssClass": "custom-hotspot arrow_left",
        "sceneId": "hall_c",
      },
      {
        "scene": 'pool_area',
        "pitch": -2.3,
        "yaw": 2.6,
        "type": "scene",
        "cssClass": "custom-hotspot arrow_down",
        "sceneId": "pool_area2",
      },
      {
        "scene": 'pool_area2',
        "pitch": -3.1,
        "yaw": -143,
        "type": "scene",
        "cssClass": "custom-hotspot arrow_left",
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
