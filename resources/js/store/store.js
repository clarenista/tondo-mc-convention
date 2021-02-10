import Vue from 'vue/dist/vue';
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    pois: [
        {value: 'POI 1', key: 1},
        {value: 'POI 2', key: 2},
        {value: 'POI 3', key: 3},

    ]
  },
  mutations: {
    // setter
    // this.$store.commit('change', event.target.value)

    // getter
    // $store.getters.flavor 
    change(state, flavor) {
      state.flavor = flavor
    }
  },
  getters: {
    pois: state => state.pois
  }
})