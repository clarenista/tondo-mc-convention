<template lang="">
    <div>
        <div class="card">
            <div class="card-body" id="onTakeContainer" ref="onTakeContainer" v-show="newSelfie">
                <div class="row  d-flex justify-content-center align-items-center">
                    <div class="col-md-12 ">
                        <video class="input_video" ref="input_video" style="display:none"></video>
                        <canvas class="output_canvas" ref="output_canvas" width="1280px" height="720px"> </canvas>
                        <br>
                        <div class="d-flex justify-content-center align-items-center">
                            <button class="btn btn-sm btn-primary " type="button" @click="takePhoto">
                                <i class="fa fa-camera fa-lg text-light"></i>
                            </button>
                            <button class="btn btn-primary btn-sm" type="button" @click="handleChangeFacingMode">{{facingMode}}</button>
                        </div>
                    </div>
                    <div class="col-md-12 d-flex justify-content-center">
                        <div class="row ">
                            <img id="img0" ref="img0" :src="image" class="img-fluid" style="display:none">  
                            
                        </div>
                        <br>
                        <div class="d-flex justify-content-center ">

                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body" id="takenContainer"  ref='takenContainer' v-show="!newSelfie">
                <div class="row">
                    <div class="col-md-12">
                        <canvas  id="photoTaken" ref="photoTaken" width="1280px" height="720px"></canvas>
                        <div class="">
                            
                            <a id="downloadPhoto" :href="dloadSource" download="Selfie.jpg" class="btn btn-success" role="button">
                                <i class="fa fa-download"></i> Download
                            </a>
                            <button class="btn btn-info float-right" type="button" @click="newSelfie = true"> 
                            <i class="fa fa-repeat"></i> New
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>        
    </div>
</template>
<script>
import { SelfieSegmentation } from "@mediapipe/selfie_segmentation";
import { Camera } from "@mediapipe/camera_utils";
import "@mediapipe/control_utils/control_utils.js";
import "@mediapipe/drawing_utils/drawing_utils.js";
import { drawConnectors, drawLandmarks } from "@mediapipe/drawing_utils";
export default {
    props: ['image'],
    data() {
        return {
            newSelfie: true,
            dloadSource: null,
            number: null,
            ctx: null,
            width: null,
            height: null,
            canvasElement: null,
            img0 : null,
            photoTaken: null,
            photoTakenCtx: null,
            facingMode: 'user',
            camera: null,
            selfieSegmentation: null
        }
    },
    mounted() {
        this.canvasElement = this.$refs.output_canvas
        this.ctx = this.canvasElement.getContext("2d");
        this.init();

        this.img0 = this.$refs.img0;
        const img1 = this.$refs.img1;
        const onTakeContainer = this.$refs.onTakeContainer
        const takenContainer = this.$refs.takenContainer

        
    },
    computed: {
        inputVideo() {
            return this.$refs.input_video;
        },
    },    
    methods:{
        init(){
            this.selfieSegmentation = new SelfieSegmentation({
                locateFile: (file) => {
                return `https://cdn.jsdelivr.net/npm/@mediapipe/selfie_segmentation/${file}`;
                },
            });
            this.selfieSegmentation.setOptions({
            modelSelection: 1,
            });
            this.selfieSegmentation.onResults(this.onResults);
            this.startCamera(this.facingMode)
                      
        },
        startCamera(facingMode){
            const camera = new Camera(this.inputVideo, {
                onFrame: async () => {
                    await this.selfieSegmentation.send({ image: this.inputVideo });
                },
                width: 1280,                
                height: 720,
                facingMode: facingMode              
            });
            camera.start(facingMode);  
        },
        onResults(results) {
            this.width = results.image.width;
            this.height = results.image.height;
            this.ctx.save();
            this.ctx.clearRect(0, 0, this.canvasElement.width, this.canvasElement.height);
            this.ctx.drawImage(
                results.segmentationMask,
                0,
                0,
                this.canvasElement.width,
                this.canvasElement.height
            );
             // Only overwrite missing pixels.
            this.ctx.globalCompositeOperation = 'source-out';
                
            this.ctx.drawImage(
                this.img0, 0, 0, this.canvasElement.width, this.canvasElement.height);
                
            // Only overwrite missing pixels.
            this.ctx.globalCompositeOperation = "destination-atop";
            this.ctx.drawImage(
                results.image, 0, 0, this.canvasElement.width, this.canvasElement.height);
            this.ctx.restore();
        },
        
        takePhoto(){
            this.newSelfie = false
            this.photoTaken = this.$refs.photoTaken
            // console.log(this.photoTaken)
            this.photoTakenCtx = this.$refs.photoTaken.getContext('2d');
            this.photoTakenCtx.drawImage(this.canvasElement, 0, 0, 1280, 720);
            this.dloadSource = this.photoTaken.toDataURL("image/jpeg").replace("image/jpeg", "image/octet-stream")
        },
        handleChangeFacingMode(){
            this.facingMode = this.facingMode == 'user' ? 'environment' : 'user'
            this.startCamera(this.facingMode)

        }
    }
    
}
</script>
<style scoped>
    canvas {
        background-color: blue;
        width: 100%;
        height: auto;
        
    } 
    @media screen and (max-width: 1200px){
    /*Tablets [601px -> 1200px]*/
        canvas {
            background-color: blue;
            width: 100%;
            height: auto;
            
        }    
    }
    @media only screen and (max-width: 425px){
	/*Small smartphones [325px -> 425px]*/
        canvas {
            background-color: blue;
            
            max-width: 300px;
        
        }

        video.input_video{
            max-width: 300px;

        }
    }
    div.card{
        background: rgba(255, 255, 255, 0.1);
    }    
</style>