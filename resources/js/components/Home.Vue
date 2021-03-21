<template>
    <div>
        <div class="background full"></div>
        <div id="progress">
          <div id="bar"></div>
        </div>
        <!-- Modal -->
        <div  class="modal-open">
            <div 
                class="modal fade show" 
                
                tabindex="-1" role="dialog" aria-hidden="true">
                
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <pre>{{booths}}</pre>
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
    import {DataImage} from '../DataImage';
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
                isLoadingAssets: true,
                booths: null
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
            async init(){
              let {data} = await axios.get('api/v1/booths')
              this.$store.commit('updateBooths', data)
              this.booths = _.filter(this.$store.getters.booths, ['panorama_location', 'lobby'])
              
                let vm = this
                let {sponsors,meetingHalls, halls} = vm.$store.getters
                var 
                  viewer, 
                  lobbyPanorama, 
                  hallPanorama_A,
                  hallPanorama_B,
                  hallPanorama_C,
                  hallPanorama_D, 
                  meetingHallPanorama, 
                  container, 
                  meetingInfoSpot, 
                  bar,
                  lobbyInfospot,
                  exhibitHallInfospot,
                  lobbySponsorsInfoSpot,
                  lobbyInfospotMeetingHallRight,
                  lobbyInfospotMeetingHallLeft,
                  lobbyInfospotA,
                  lobbyInfospotB,
                  lobbyInfospotC,
                  lobbyInfospotD,
                container = document.querySelector( 'div.background' );
                bar = document.querySelector( '#bar' );
                var lookAtPositions = [
                  // lobby
                  new THREE.Vector3(4981.49, 391.22, -59.83),
                  // meeting hall
                  new THREE.Vector3(4987.90, 296.01, 9.02),
                  // exhibit hall
                  new THREE.Vector3(4972.23, 488.47, -18.61),
                ];

                lobbyPanorama= new PANOLENS.ImagePanorama( '/images/lobby.png' );
                lobbyPanorama.addEventListener( 'enter-fade-start', function(){
                  viewer.tweenControlCenter( lookAtPositions[0], 0 );
                } );
                lobbyPanorama.addEventListener( 'progress', vm.onProgressUpdate );

                hallPanorama_A = new PANOLENS.ImagePanorama( '/images/hall.png' );
                hallPanorama_A.addEventListener( 'enter-fade-start', function(){
                  viewer.tweenControlCenter( lookAtPositions[2], 0 );
                } );
                hallPanorama_A.addEventListener( 'progress', vm.onProgressUpdate );

                hallPanorama_B = new PANOLENS.ImagePanorama( '/images/hall.png' );
                hallPanorama_B.addEventListener( 'enter-fade-start', function(){
                  viewer.tweenControlCenter( lookAtPositions[2], 0 );
                } );
                hallPanorama_B.addEventListener( 'progress', vm.onProgressUpdate );

                hallPanorama_C = new PANOLENS.ImagePanorama( '/images/hall.png' );
                hallPanorama_C.addEventListener( 'enter-fade-start', function(){
                  viewer.tweenControlCenter( lookAtPositions[2], 0 );
                } );
                hallPanorama_C.addEventListener( 'progress', vm.onProgressUpdate );

                hallPanorama_D = new PANOLENS.ImagePanorama( '/images/hall.png' );
                hallPanorama_D.addEventListener( 'enter-fade-start', function(){
                  viewer.tweenControlCenter( lookAtPositions[2], 0 );
                } );
                hallPanorama_D.addEventListener( 'progress', vm.onProgressUpdate );

                meetingHallPanorama = new PANOLENS.ImagePanorama( '/images/stage-min.png' );
                meetingHallPanorama.addEventListener( 'enter-fade-start', function(){
                  viewer.tweenControlCenter( lookAtPositions[1], 0 );
                } );
                // goldBoothPanorama = new PANOLENS.ImagePanorama( '/images/Booth-gold.png' );
                viewer = new PANOLENS.Viewer( { output: 'console', autoHideInfospot: false , container: container, controlBar:false, horizontalView: false} );
                // viewer.getControl().rotateLeft(-90 * Math.PI / 180);
                // viewer.getControl().update();
                viewer.add( lobbyPanorama, hallPanorama_A,hallPanorama_B,hallPanorama_C,hallPanorama_D, meetingHallPanorama );
                 // Pair with custom scale and image
                // hallPanorama.link( lobbyPanorama, new THREE.Vector3( 4936.44, -770.81, -63.85 ), 300, PANOLENS.DataImage.Info );

                for(let i in meetingHalls){

                  meetingInfoSpot = new PANOLENS.Infospot(
                    300,
                    DataImage.MeetingHallIcon,
                    true
                  );
                  meetingInfoSpot.position.set( meetingHalls[i].x , meetingHalls[i].y , meetingHalls[i].z );
                  meetingInfoSpot.addHoverText( meetingHalls[i].name );
                  meetingInfoSpot.addEventListener( "click", function(){
                    vm.onButtonClick( bar, viewer, meetingHallPanorama )
                  } );
                  lobbyPanorama.add( meetingInfoSpot );
                }

                for(let i in halls){

                  exhibitHallInfospot = new PANOLENS.Infospot(
                    300,
                    DataImage.ExhibitHallIcon,
                    true
                  );
                  exhibitHallInfospot.position.set( halls[i].x , halls[i].y , halls[i].z );
                  exhibitHallInfospot.addHoverText( halls[i].name );
                  exhibitHallInfospot.addEventListener( "click", function(){
                    let panorama 
                    switch(halls[i].panorama){
                      case 'hallPanorama_A':
                        panorama = {'target': hallPanorama_A, 'location': 'Hall_a'}
                        break
                      case 'hallPanorama_B':
                        panorama = {'target': hallPanorama_B, 'location': 'Hall_b'}
                        break
                      case 'hallPanorama_C':
                        panorama = {'target': hallPanorama_C, 'location': 'Hall_c'}
                        break
                      default:
                        panorama = {'target': hallPanorama_D, 'location': 'Hall_d'}
                        break    
                    }
                    vm.onButtonClick( bar, viewer, panorama )
                  });
                  lobbyPanorama.add( exhibitHallInfospot );
                }



                // to lobby
                lobbyInfospotMeetingHallLeft = new PANOLENS.Infospot(
                    300,
                    DataImage.LeftArrowIcon,
                    true
                  );
                lobbyInfospotMeetingHallLeft.position.set( 4355.13, 303.00, 2424.75 );
                lobbyInfospotMeetingHallLeft.addHoverText( "Lobby" );
                lobbyInfospotMeetingHallLeft.addEventListener( "click", function(){
                  vm.onButtonClick( bar, viewer, {"target": lobbyPanorama, "location": 'lobby'} )
                } );
                meetingHallPanorama.add( lobbyInfospotMeetingHallLeft );

                lobbyInfospotMeetingHallRight = new PANOLENS.Infospot(
                    300,
                    DataImage.RightArrowIcon,
                    true
                  );
                lobbyInfospotMeetingHallRight.position.set( 4327.84, 300.39, -2478.52 );
                lobbyInfospotMeetingHallRight.addHoverText( "Lobby" );
                lobbyInfospotMeetingHallRight.addEventListener( "click", function(){
                  vm.onButtonClick( bar, viewer, {"target": lobbyPanorama, "location": 'lobby'} )
                } );
                meetingHallPanorama.add( lobbyInfospotMeetingHallRight );

                lobbyInfospotA = new PANOLENS.Infospot(
                    300,
                    DataImage.LeftArrowIcon,
                    true
                  );
                lobbyInfospotA.position.set( 4988.46, -272.10, 16.26 );
                lobbyInfospotA.addHoverText( "Lobby" );
                lobbyInfospotA.addEventListener( "click", function(){
                  vm.onButtonClick( bar, viewer, {"target": lobbyPanorama, "location": 'lobby'} )
                } );
                hallPanorama_A.add( lobbyInfospotA );

                hallPanorama_A.link( meetingHallPanorama, new THREE.Vector3( 4892.53, 420.40, 908.61 ), 300, DataImage.MeetingHallIcon );
                hallPanorama_A.link( meetingHallPanorama, new THREE.Vector3( 4893.91, 420.52, -899.82 ), 300, DataImage.MeetingHallIcon );

                lobbyInfospotB = new PANOLENS.Infospot(
                    300,
                    DataImage.LeftArrowIcon,
                    true
                  );
                lobbyInfospotB.position.set( 4988.46, -272.10, 16.26 );
                lobbyInfospotB.addHoverText( "Lobby" );
                lobbyInfospotB.addEventListener( "click", function(){
                  vm.onButtonClick( bar, viewer, {"target": lobbyPanorama, "location": 'lobby'} )
                } );
                hallPanorama_B.add( lobbyInfospotB );
                hallPanorama_B.link( meetingHallPanorama, new THREE.Vector3( 4892.53, 420.40, 908.61 ), 300, DataImage.MeetingHallIcon );
                hallPanorama_B.link( meetingHallPanorama, new THREE.Vector3( 4893.91, 420.52, -899.82 ), 300, DataImage.MeetingHallIcon );

                lobbyInfospotC = new PANOLENS.Infospot(
                    300,
                    DataImage.LeftArrowIcon,
                    true
                  );
                lobbyInfospotC.position.set( 4988.46, -272.10, 16.26 );
                lobbyInfospotC.addHoverText( "Lobby" );
                lobbyInfospotC.addEventListener( "click", function(){
                  vm.onButtonClick( bar, viewer, {"target": lobbyPanorama, "location": 'lobby'} )
                } );
                hallPanorama_C.add( lobbyInfospotC );
                hallPanorama_C.link( meetingHallPanorama, new THREE.Vector3( 4892.53, 420.40, 908.61 ), 300, DataImage.MeetingHallIcon );
                hallPanorama_C.link( meetingHallPanorama, new THREE.Vector3( 4893.91, 420.52, -899.82 ), 300, DataImage.MeetingHallIcon );

                lobbyInfospotD = new PANOLENS.Infospot(
                    300,
                    DataImage.LeftArrowIcon,
                    true
                  );
                lobbyInfospotD.position.set( 4988.46, -272.10, 16.26 );
                lobbyInfospotD.addHoverText( "Lobby" );
                lobbyInfospotD.addEventListener( "click", function(){
                  vm.onButtonClick( bar, viewer, {"target": lobbyPanorama, "location": 'lobby'} )
                } );
                hallPanorama_D.add( lobbyInfospotD );
                hallPanorama_D.link( meetingHallPanorama, new THREE.Vector3( 4892.53, 420.40, 908.61 ), 300, DataImage.MeetingHallIcon );
                hallPanorama_D.link( meetingHallPanorama, new THREE.Vector3( 4893.91, 420.52, -899.82 ), 300, DataImage.MeetingHallIcon );


                for(let i in sponsors){
                    lobbySponsorsInfoSpot = new PANOLENS.Infospot(
                    300,
                    DataImage.BoothIcon,
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
            },
            onProgressUpdate ( event ) {
              var percentage = event.progress.loaded/ event.progress.total * 100;
              bar.style.width = percentage + "%";
              if (percentage >= 100){
                bar.classList.add( 'hide' );
                setTimeout(function(){
                  bar.style.width = 0;
                }, 1000);
              }
            },
            onButtonClick( bar, viewer, panorama ) {
              if (panorama instanceof PANOLENS.ImagePanorama){
                viewer.setPanorama( panorama );
              } else {
                viewer.setPanorama( panorama.target );
                this.booths = _.filter(this.$store.getters.booths, ['panorama_location', panorama.location])
              }
              bar.classList.remove( 'hide' );

              console.log(this.booths)
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



#progress {
  position: absolute;
  width: 100%;
  height: 3px;
}

#bar {
  background-color: #fff;
  height: 100%;
  transition: width 0.1s ease;
}

#bar.hide {
  opacity: 0;
  transition: opacity 1s ease;
}

</style>
    