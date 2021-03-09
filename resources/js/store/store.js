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
      {id: 1, name: 'Johnson & Johnson', x: 3157.01, y: -1568.49, z: 3542.93, direction: 'NW'},
      {id: 2, name: 'Astra Zenica', x: 2562.09, y: -1660.91, z: -3947.53, direction: 'NE'},
      {id: 3, name: 'Novavax', x: -3451.00, y: -1282.21, z: 3369.48, direction: 'SW'},
      {id: 4, name: 'Pfizer', x: -3776.58, y:-1341.95, z: -2973.09, direction: 'SE'},
    ],
    halls:[
      {name: 'Hall A', x:4646.22, y:-58.08, z:1822.84},
      {name: 'Hall B', x:4629.73, y:-485.25, z:1798.56},
      {name: 'Hall C', x:4663.18, y:-85.20, z:-1775.68},
      {name: 'Hall D', x:4649.42, y:-496.26, z:-1743.62},
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