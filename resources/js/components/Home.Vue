<template>
    <div>
<div class="blobs-container">
  <div class="blob white"></div>
  <div class="blob red"></div>
  <div class="blob orange"></div>
  <div class="blob yellow"></div>
  <div class="blob blue"></div>
  <div class="blob green"></div>
  <div class="blob purple"></div>
  <div class="blob"></div>
</div>
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
    </div>

</template>


<script>
    import Login from './Login.vue';
    import Loader from './Loader.vue';
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
                var viewer, lobbyPanorama, hallPanorama_A,hallPanorama_B,hallPanorama_C,hallPanorama_D, meetingHallPanorama, container, lobbySponsorsInfoSpot, hallsInfoSpot, meetingInfoSpotEast ,meetingInfoSpotWest;
                container = document.querySelector( 'div.background' );

                lobbyPanorama= new PANOLENS.ImagePanorama( '/images/lobby.png' );
                hallPanorama_A = new PANOLENS.ImagePanorama( '/images/hall.png' );
                hallPanorama_B = new PANOLENS.ImagePanorama( '/images/hall.png' );
                hallPanorama_C = new PANOLENS.ImagePanorama( '/images/hall.png' );
                hallPanorama_D = new PANOLENS.ImagePanorama( '/images/hall.png' );
                meetingHallPanorama = new PANOLENS.ImagePanorama( '/images/stage-min.png' );
                // goldBoothPanorama = new PANOLENS.ImagePanorama( '/images/Booth-gold.png' );
                viewer = new PANOLENS.Viewer( { output: 'console', autoHideInfospot: false , container: container, controlBar:false} );
                viewer.getControl().rotateLeft(-90 * Math.PI / 180);
                viewer.getControl().update();
                viewer.add( lobbyPanorama, hallPanorama_A,hallPanorama_B,hallPanorama_C,hallPanorama_D, meetingHallPanorama );
                 // Pair with custom scale and image
                // hallPanorama.link( lobbyPanorama, new THREE.Vector3( 4936.44, -770.81, -63.85 ), 300, PANOLENS.DataImage.Info );

                // to meeting hall
                lobbyPanorama.link( meetingHallPanorama, new THREE.Vector3( 4483.87, 1004.02, 1957.63 ), 300, PANOLENS.DataImage.Info );
                lobbyPanorama.link( meetingHallPanorama, new THREE.Vector3( 4476.78, 1030.80, -1961.26 ), 300, PANOLENS.DataImage.Info );

                // to halls 
                lobbyPanorama.link( hallPanorama_A, new THREE.Vector3( 4669.04, 157.28, 1752.54 ), 300, PANOLENS.DataImage.Info );
                lobbyPanorama.link( hallPanorama_B, new THREE.Vector3( 4670.81, -275.96, 1734.92 ), 300, PANOLENS.DataImage.Info );
                lobbyPanorama.link( hallPanorama_C, new THREE.Vector3( 4686.30, 154.93, -1707.82 ), 300, PANOLENS.DataImage.Info );
                lobbyPanorama.link( hallPanorama_D, new THREE.Vector3( 4680.38, -272.51, -1710.38 ), 300, PANOLENS.DataImage.Info );

                // to lobby
                meetingHallPanorama.link( lobbyPanorama, new THREE.Vector3( 4554.64, -92.61, 2051.37 ), 300, PANOLENS.DataImage.Info );
                meetingHallPanorama.link( lobbyPanorama, new THREE.Vector3( 4571.89, -92.96, -2012.66 ), 300, PANOLENS.DataImage.Info );

                hallPanorama_A.link( lobbyPanorama, new THREE.Vector3( 4977.73, 446.12, 9.20 ), 300, PANOLENS.DataImage.Info );
                hallPanorama_B.link( lobbyPanorama, new THREE.Vector3( 4977.73, 446.12, 9.20 ), 300, PANOLENS.DataImage.Info );
                hallPanorama_C.link( lobbyPanorama, new THREE.Vector3( 4977.73, 446.12, 9.20 ), 300, PANOLENS.DataImage.Info );
                hallPanorama_D.link( lobbyPanorama, new THREE.Vector3( 4977.73, 446.12, 9.20 ), 300, PANOLENS.DataImage.Info );


                for(let i in sponsors){
                    lobbySponsorsInfoSpot = new PANOLENS.Infospot(
                    300,
                    PANOLENS.DataImage.Info,
                    true
                    );
                    lobbySponsorsInfoSpot.position.set( sponsors[i].x , sponsors[i].y , sponsors[i].z );
                    lobbySponsorsInfoSpot.addHoverText( sponsors[i].name);
                    lobbySponsorsInfoSpot.addEventListener('click', function(){
                        // viewer.setPanorama( goldBoothPanorama );
                        vm.$router.push('/sponsors/'+sponsors[i].id)
                        // alert(sponsors[i].name)

                    })
                    lobbyPanorama.add( lobbySponsorsInfoSpot );
                }
                // for(let i in halls){
                //     lobbyPanorama.link( meetingHallPanorama, new THREE.Vector3( 4476.78, 1030.80, -1961.26 ), 300, PANOLENS.DataImage.Info );
                //     hallsInfoSpot = new PANOLENS.Infospot(
                //     300,
                //     PANOLENS.DataImage.Info,
                //     true
                //     );
                //     hallsInfoSpot.position.set( halls[i].x , halls[i].y , halls[i].z );
                //     hallsInfoSpot.addHoverText( halls[i].name);
                //     hallsInfoSpot.addEventListener('click', function(){
                //         viewer.setPanorama( hallPanorama );
                //         // vm.$router.push('/sponsors/'+sponsors[i].id)

                //     })
                //     lobbyPanorama.add( hallsInfoSpot );
                // }
                lobbyPanorama.addEventListener('load', function(e){
                    vm.isLoadingAssets = false
                });


                               
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


@import url('https://fonts.googleapis.com/css?family=Source+Sans+Pro');

* {
  box-sizing: border-box;
}

body {
  background-image: linear-gradient(to bottom, #cfd9df 0%, #e2ebf0 100%);
  font-family: 'Source Sans Pro', sans-serif;
  margin: 0;
  height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-direction: column;
}

.blobs-container {
  display: flex;
}

.blob {
  background: black;
  border-radius: 50%;
  box-shadow: 0 0 0 0 rgba(0, 0, 0, 1);
  margin: 10px;
  height: 20px;
  width: 20px;
  transform: scale(1);
  animation: pulse-black 2s infinite;
}

@keyframes pulse-black {
  0% {
    transform: scale(0.95);
    box-shadow: 0 0 0 0 rgba(0, 0, 0, 0.7);
  }
  
  70% {
    transform: scale(1);
    box-shadow: 0 0 0 10px rgba(0, 0, 0, 0);
  }
  
  100% {
    transform: scale(0.95);
    box-shadow: 0 0 0 0 rgba(0, 0, 0, 0);
  }
}

.blob.white {
  background: white;
  box-shadow: 0 0 0 0 rgba(255, 255, 255, 1);
  animation: pulse-white 2s infinite;
}

@keyframes pulse-white {
  0% {
    transform: scale(0.95);
    box-shadow: 0 0 0 0 rgba(255, 255, 255, 0.7);
  }
  
  70% {
    transform: scale(1);
    box-shadow: 0 0 0 10px rgba(255, 255, 255, 0);
  }
  
  100% {
    transform: scale(0.95);
    box-shadow: 0 0 0 0 rgba(255, 255, 255, 0);
  }
}

.blob.red {
  background: rgba(255, 82, 82, 1);
  box-shadow: 0 0 0 0 rgba(255, 82, 82, 1);
  animation: pulse-red 2s infinite;
}

@keyframes pulse-red {
  0% {
    transform: scale(0.95);
    box-shadow: 0 0 0 0 rgba(255, 82, 82, 0.7);
  }
  
  70% {
    transform: scale(1);
    box-shadow: 0 0 0 10px rgba(255, 82, 82, 0);
  }
  
  100% {
    transform: scale(0.95);
    box-shadow: 0 0 0 0 rgba(255, 82, 82, 0);
  }
}

.blob.orange {
  background: rgba(255, 121, 63, 1);
  box-shadow: 0 0 0 0 rgba(255, 121, 63, 1);
  animation: pulse-orange 2s infinite;
}

@keyframes pulse-orange {
  0% {
    transform: scale(0.95);
    box-shadow: 0 0 0 0 rgba(255, 121, 63, 0.7);
  }
  
  70% {
    transform: scale(1);
    box-shadow: 0 0 0 10px rgba(255, 121, 63, 0);
  }
  
  100% {
    transform: scale(0.95);
    box-shadow: 0 0 0 0 rgba(255, 121, 63, 0);
  }
}

.blob.yellow {
  background: rgba(255, 177, 66, 1);
  box-shadow: 0 0 0 0 rgba(255, 177, 66, 1);
  animation: pulse-yellow 2s infinite;
}

@keyframes pulse-yellow {
  0% {
    transform: scale(0.95);
    box-shadow: 0 0 0 0 rgba(255, 177, 66, 0.7);
  }
  
  70% {
    transform: scale(1);
    box-shadow: 0 0 0 10px rgba(255, 177, 66, 0);
  }
  
  100% {
    transform: scale(0.95);
    box-shadow: 0 0 0 0 rgba(255, 177, 66, 0);
  }
}

.blob.blue {
  background: rgba(52, 172, 224, 1);
  box-shadow: 0 0 0 0 rgba(52, 172, 224, 1);
  animation: pulse-blue 2s infinite;
}

@keyframes pulse-blue {
  0% {
    transform: scale(0.95);
    box-shadow: 0 0 0 0 rgba(52, 172, 224, 0.7);
  }
  
  70% {
    transform: scale(1);
    box-shadow: 0 0 0 10px rgba(52, 172, 224, 0);
  }
  
  100% {
    transform: scale(0.95);
    box-shadow: 0 0 0 0 rgba(52, 172, 224, 0);
  }
}

.blob.green {
  background: rgba(51, 217, 178, 1);
  box-shadow: 0 0 0 0 rgba(51, 217, 178, 1);
  animation: pulse-green 2s infinite;
}

@keyframes pulse-green {
  0% {
    transform: scale(0.95);
    box-shadow: 0 0 0 0 rgba(51, 217, 178, 0.7);
  }
  
  70% {
    transform: scale(1);
    box-shadow: 0 0 0 10px rgba(51, 217, 178, 0);
  }
  
  100% {
    transform: scale(0.95);
    box-shadow: 0 0 0 0 rgba(51, 217, 178, 0);
  }
}

.blob.purple {
  background: rgba(142, 68, 173, 1);
  box-shadow: 0 0 0 0 rgba(142, 68, 173, 1);
  animation: pulse-purple 2s infinite;
}

@keyframes pulse-purple {
  0% {
    transform: scale(0.95);
    box-shadow: 0 0 0 0 rgba(142, 68, 173, 0.7);
  }
  
  70% {
    transform: scale(1);
    box-shadow: 0 0 0 10px rgba(142, 68, 173, 0);
  }
  
  100% {
    transform: scale(0.95);
    box-shadow: 0 0 0 0 rgba(142, 68, 173, 0);
  }
}

footer {
    background-color: #222;
    color: #fff;
    font-size: 14px;
    bottom: 0;
    position: fixed;
    left: 0;
    right: 0;
    text-align: center;
    z-index: 999;
}

footer p {
    margin: 10px 0;
}

footer i {
    color: red;
}

footer a {
    color: #3c97bf;
    text-decoration: none;
}



</style>
    