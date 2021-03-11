import Vue from 'vue/dist/vue';
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    roles: [
        {value: 'ADMIN', key: 'admin'},
        {value: 'SPONSOR', key: 'sponsor'},
    ],
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
      
      {name: 'Hall A', x: 4669.04, y: 157.28, z: 1752.54},
      {name: 'Hall B', x: 4670.81, y: -275.96, z: 1734.92},
      {name: 'Hall C', x: 4686.30, y: 154.93, z: -1707.82},
      {name: 'Hall D', x: 4680.38, y: -272.51, z: -1710.38},
    ],


    assets:[
      {type: 'image', name: 'image 1', path: 'https://via.placeholder.com/100'},
      {type: 'image', name: 'image 2', path: 'https://via.placeholder.com/200'},
      {type: 'image', name: 'image 3', path: 'https://via.placeholder.com/300'},
      {type: 'image', name: 'image 4', path: 'https://via.placeholder.com/400'},
      {type: 'image', name: 'image 5', path: 'https://via.placeholder.com/500'},
      {type: 'image', name: 'image 6', path: 'https://via.placeholder.com/600'},
      {type: 'pdf', name: 'pdf 1', path: 'https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf'},
      {type: 'pdf', name: 'pdf 2', path: 'https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf'},
      {type: 'pdf', name: 'pdf 3', path: 'https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf'},
      {type: 'pdf', name: 'pdf 4', path: 'https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf'},
      {type: 'pdf', name: 'pdf 5', path: 'https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf'},
      {type: 'pdf', name: 'pdf 6', path: 'https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf'},
      {type: 'pdf', name: 'pdf 7', path: 'https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf'},
    ],  
    
    gallery: [
      {type: 'image', name: 'image 1', path: 'https://via.placeholder.com/400'},
      {type: 'image', name: 'image 2', path: 'https://via.placeholder.com/500'},
      {type: 'image', name: 'image 3', path: 'https://via.placeholder.com/400'},
      {type: 'image', name: 'image 4', path: 'https://via.placeholder.com/500'},
      {type: 'image', name: 'image 5', path: 'https://via.placeholder.com/400'},
      {type: 'image', name: 'image 1', path: 'https://via.placeholder.com/500'},
      {type: 'image', name: 'image 2', path: 'https://via.placeholder.com/400'},
      {type: 'image', name: 'image 3', path: 'https://via.placeholder.com/500'},
      {type: 'image', name: 'image 4', path: 'https://via.placeholder.com/400'},
      {type: 'image', name: 'image 5', path: 'https://via.placeholder.com/500'},
    ],
  },
  mutations: {
    // setter
    // this.$store.commit('change', event.target.value)

    // getter
    // $store.getters.flavor 
    // change(state, flavor) {
    //   state.flavor = flavor
    // }

    changeUser(state, user) {
      state.user = user
    },
    updatePermissions(state, permissions) {
      state.permissions = permissions
    },
    updateApiToken(state, api_token) {
      state.api_token = api_token
    },
    updateUsersList(state, users) {
      state.users = users
    },
    updateSponsorsList(state, sponsors) {
      state.sponsors = sponsors
    }

  },
  getters: {
    pois: state => state.pois,
    assets: state => state.assets,
    user: state => state.user,
    gallery: state => state.gallery,
    permissions: state => state.permissions,
    api_token: state => state.api_token,
    users: state => state.users,
    sponsors: state => state.sponsors,
    halls: state => state.halls,
  }
})