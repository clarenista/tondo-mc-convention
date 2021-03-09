<template>
<div>
    <!-- 
    -->
    <Loader v-if="isLoadingAssets"></Loader>
    <div class="background full"></div>
    <!-- Modal -->
    <div :class="modalShow ? 'modal-open': ''">
        <div 
            class="modal fade" 
            :class="modalShow ? 'show' : ''" 
            :style="modalShow ? 'display: block;' : ''"
            tabindex="-1" role="dialog" aria-hidden="true">
            
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <Login @isLoginSuccess="isLoginSuccess"></Login>
                    </div>
                </div>
            </div>
        </div>

        
    </div> 
    <!-- -->
    
    
    </div>
</template>

<script>
    import Login from './components/Login.vue';
    import Loader from './components/Loader.vue';
    export default {
        components :{
            Login,
            Loader
        },
        mounted() {
            this.init()
            this.api_token = this.$store.getters.api_token ? this.$store.getters.api_token : null
        },
        data(){
            return{
                showCollapse: false,
                api_token: [],
                modalShow: false,
                isLoadingAssets: true
            }
        },
        methods:{
            toggleShow(){
                this.showCollapse = !this.showCollapse
            },

            handleLogInUser(){
                this.modalShow = true
                // this.$router.push('/login')
            },
            handleLogoutUser(){
                this.$store.commit('updateApiToken', null)
                this.$store.commit('changeUser', null)
                this.$router.push('/login')
            },
            init(){
                let vm = this
                let {sponsors, halls} = vm.$store.getters
                var viewer, lobbyPanorama, hallPanorama, container, lobbySponsorsInfoSpot, hallsInfoSpot, centerInfoSpot;
                container = document.querySelector( 'div.background' );

                lobbyPanorama= new PANOLENS.ImagePanorama( '/images/Equirectangular.png' );
                hallPanorama = new PANOLENS.ImagePanorama( '/images/_Equirectangular.png' );
                viewer = new PANOLENS.Viewer( { output: 'console', autoHideInfospot: false , container: container, controlBar:false} );
                viewer.getControl().rotateLeft(-90 * Math.PI / 180);
                viewer.getControl().update();
                viewer.add( lobbyPanorama, hallPanorama );
                 // Pair with custom scale and image
                hallPanorama.link( lobbyPanorama, new THREE.Vector3( 4936.44, -770.81, -63.85 ), 400, PANOLENS.DataImage.Info );
                for(let i in sponsors){
                    lobbySponsorsInfoSpot = new PANOLENS.Infospot(
                    300,
                    PANOLENS.DataImage.Info,
                    true
                    );
                    lobbySponsorsInfoSpot.position.set( sponsors[i].x , sponsors[i].y , sponsors[i].z );
                    lobbySponsorsInfoSpot.addHoverText( sponsors[i].name);
                    lobbySponsorsInfoSpot.addEventListener('click', function(){
                        // viewer.setPanorama( hallPanorama );
                        // vm.$router.push('/sponsors/'+sponsors[i].id)
                        alert(sponsors[i].name)

                    })
                    lobbyPanorama.add( lobbySponsorsInfoSpot );
                }
                for(let i in halls){
                    hallsInfoSpot = new PANOLENS.Infospot(
                    100,
                    PANOLENS.DataImage.Info,
                    true
                    );
                    hallsInfoSpot.position.set( halls[i].x , halls[i].y , halls[i].z );
                    hallsInfoSpot.addHoverText( halls[i].name);
                    hallsInfoSpot.addEventListener('click', function(){
                        viewer.setPanorama( hallPanorama );
                        // vm.$router.push('/sponsors/'+sponsors[i].id)

                    })
                    lobbyPanorama.add( hallsInfoSpot );
                }
                lobbyPanorama.addEventListener('load', function(e){
                    vm.isLoadingAssets = false
                });

                lobbyPanorama.add( centerInfoSpot );

                               
            },
            isLoginSuccess(value){
                if(value){
                    this.modalShow = false
                }else{
                    this.modalShow = true

                }
            }
        },

    }
</script>

<style scoped>

div.background {
  position: fixed;
  top: 0;
  left: 0;
  cursor: -webkit-grab;
  cursor: grab;
}

div.full{
      width: 100%;
  height: 100%;
}

div.content {
  width: 100%;
  z-index: 1;
}

div.example{
  position: absolute;
  width: 100%;
  bottom:0;
  max-width: 1000px;
  padding: 20px;
  -webkit-transform: translateY(-50%);
      -ms-transform: translateY(-50%);
          transform: translateY(-50%);
  max-height: 80%;
  color: #fff;
  margin: auto;
  left: 0;
  right: 0;
  -webkit-transition: opacity 0.5s ease-out;
          -o-transition: opacity 0.5s ease-out;
          transition: opacity 0.5s ease-out;

  overflow-y: scroll;
  -webkit-overflow-scrolling: touch;
   display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -ms-flex-wrap: wrap;
      flex-wrap: wrap;
  padding: 5px;
  margin: 0;
  max-width: 100%;
  -webkit-box-orient: horizontal;
  -webkit-box-direction: normal;
      -ms-flex-direction: row;
          flex-direction: row;          
}

figure {
  background-size: cover;
  background-position: center -40px;
  background-repeat: no-repeat;
  margin: 0;
  -webkit-box-flex: 1;
      -ms-flex-positive: 1;
          flex-grow: 1;
  -ms-flex-preferred-size: 250px;
      flex-basis: 250px;
  height: 300px;
}
.group {
  display: contents;
}
main {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-align: center;
      -ms-flex-align: center;
          align-items: center;
  -webkit-transition: all 0.25s ease-in-out;
          -o-transition: all 0.25s ease-in-out;
          transition: all 0.25s ease-in-out;
}


</style>
    