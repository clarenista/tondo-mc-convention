<template lang="">
    <div class="row d-flex justify-content-center">
        <div class="card">
          
          <div class="card-body">
            <h5 class="card-title">PhotoBooth</h5>
            <button type="button" class="button is-rounded" :class="{ 'is-primary' : !isCameraOpen, 'is-danger' : isCameraOpen}" @click="toggleCamera">
              <span v-if="!isCameraOpen">Open Camera</span>
              <span v-else>Close Camera</span>
            </button>
            <div v-if="isCameraOpen" v-show="!isLoading" class="camera-box" :class="{ 'flash' : isShotPhoto }">
          
              <div class="camera-shutter" :class="{'flash' : isShotPhoto}"></div>

              <div v-show="!isPhotoTaken">
                <img style="opacity: 1;" class="position-absolute"  :width="450" :height="337.5" src="https://cdn.pixabay.com/photo/2017/11/10/16/59/frame-2936877_960_720.png">
                <video  ref="camera" :width="450" :height="337.5" autoplay></video>
              </div>  
              
              <div ref="printMe" v-show="isPhotoTaken">
                <img  style="opacity: 1;" :width="450" :height="337.5" class="position-absolute" src="https://cdn.pixabay.com/photo/2017/11/10/16/59/frame-2936877_960_720.png">
                <canvas  id="photoTaken" ref="canvas" :width="450" :height="337.5"></canvas>
                <!-- OUTPUT -->
              </div>
            </div>
            
            <div v-if="isCameraOpen && !isLoading" class="camera-shoot">
              <button type="button" class="button" @click="takePhoto">
                <img src="https://img.icons8.com/material-outlined/50/000000/camera--v2.png">
              </button>
            </div>
            
            <div v-if="isPhotoTaken && isCameraOpen" class="camera-download">
              <a id="downloadPhoto" download="my-photo.jpg" class="button" role="button" @click="downloadImage">
                Download
              </a>
            </div>
          </div>
          <div class="card-footer">
            Footer
          </div>
        </div>

    </div>

</template>
<script>
import html2canvas from 'html2canvas'
export default {
    mounted() {
      this.createCameraElement();
    },
    data() {
    return {
      isCameraOpen: true,
      isPhotoTaken: false,
      isShotPhoto: false,
      isLoading: false,
      link: '#',
      output: null
    }
  },
  
  methods: {
    toggleCamera() {
      if(this.isCameraOpen) {
        this.isCameraOpen = false;
        this.isPhotoTaken = false;
        this.isShotPhoto = false;
        this.stopCameraStream();
      } else {
        this.isCameraOpen = true;
        this.createCameraElement();
      }
    },
    
    createCameraElement() {
      this.isLoading = true;
      
      const constraints = (window.constraints = {
				audio: false,
				video: true
			});


			navigator.mediaDevices
				.getUserMedia(constraints)
				.then(stream => {
          this.isLoading = false;
					this.$refs.camera.srcObject = stream;
				})
				.catch(error => {
          this.isLoading = false;
					alert("May the browser didn't support or there is some errors.");
				});
    },
    
    stopCameraStream() {
      let tracks = this.$refs.camera.srcObject.getTracks();

			tracks.forEach(track => {
				track.stop();
			});
    },
    
    async takePhoto() {
      const el = this.$refs.printMe;
      // add option type to get the image version
      // if not provided the promise will return 
      // the canvas.
      const options = {
        type: 'dataURL',
        logging: true,
        letterRendering: 1,
        allowTaint: false,
        useCORS: true,
      }
      if(!this.isPhotoTaken) {
        this.isShotPhoto = true;

        const FLASH_TIMEOUT = 50;

        setTimeout(() => {
          this.isShotPhoto = false;
        }, FLASH_TIMEOUT);
      }
      
      this.isPhotoTaken = !this.isPhotoTaken;
      
      const context = this.$refs.canvas.getContext('2d');
      context.drawImage(this.$refs.camera, 0, 0, 450, 337.5);
      this.output = await this.$html2canvas(el,options);      
    },
    
    downloadImage() {
      const download = document.getElementById("downloadPhoto");
      
      download.setAttribute("href", this.output);
    },

  }
}
</script>
<style scoped>
.result-image{
position: absolute;
    top: 120px;
    width: 550px;
    height: 350px;
    left: 450px;
}



</style>