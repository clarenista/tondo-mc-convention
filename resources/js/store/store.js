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
    
    sponsors:[
      {id: 1, name: 'Johnson & Johnson', x: 3663.38, y: -102.64, z: 3392.30, direction: 'NW'},
      {id: 2, name: 'Astra Zenica', x: 3459.15, y: -183.72, z:-3592.03, direction: 'NE'},
      {id: 3, name: 'Novavax', x: -2616.53, y: -168.16, z: 4246.58, direction: 'SW'},
      {id: 4, name: 'Pfizer', x: -2881.17, y: -204.73, z: -4073.01, direction: 'SE'},
    ],
    halls:[
      
      {name: 'Hall A', x: 4669.04, y: 157.28, z: 1752.54, panorama: 'hallPanorama_A'},
      {name: 'Hall B', x: 4670.81, y: -275.96, z: 1734.92, panorama: 'hallPanorama_B'},
      {name: 'Hall C', x: 4686.30, y: 154.93, z: -1707.82, panorama: 'hallPanorama_C'},
      {name: 'Hall D', x: 4680.38, y: -272.51, z: -1710.38, panorama: 'hallPanorama_D'},
    ],
    meetingHalls: [
      {name: 'Meeting Hall', x: 4483.87, y: 1004.02, z: 1957.63},
      {name: 'Meeting Hall', x: 4476.78, y: 1030.80, z: -1961.26},
    ]

  },
  mutations: {
    // setter
    // this.$store.commit('change', event.target.value)

    // getter
    // $store.getters.flavor 
    // change(state, flavor) {
    //   state.flavor = flavor
    // }
    updateBooths(state, booths) {
        state.booths = booths
      },
    changeUser(state, user) {
      state.user = user
    },
    updateIsWelcomed(state, isWelcomed) {
      state.isWelcomed = isWelcomed
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
  }
})