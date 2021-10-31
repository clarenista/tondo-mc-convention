<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/@mediapipe/camera_utils/camera_utils.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@mediapipe/control_utils/control_utils.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@mediapipe/drawing_utils/drawing_utils.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@mediapipe/selfie_segmentation/selfie_segmentation.js" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <style>
    body{
      /* background-image:  url("/images/login_bg.jpg");
      background-repeat: no-repeat;
      background-size: cover;
      background-position: center;
      background-attachment: fixed; */
    }
      canvas {
          background-color: blue;
          width: 100%;
          height: auto;
        }
        div.card{
          background: rgba(255, 255, 255, 0.1);


    }
  </style>
</head>

<body>
  <div class="container">
    <div class="row d-flex justify-content-center ">
      <div class="col-md col-sm-12 ">
        <div class="card d-flex align-items-center">
            <div class="card-body" id="onTakeContainer">
              <video class="input_video" style="display:none"></video>
              <canvas class="output_canvas" width="450" height="337.5"></canvas>
              <p class="text-center lead">Select Background</p>
              <div class="row">
                  <img id="img0" src="{{asset('images/70_logo.png')}}" width="100" height="100" style="display:none">  
                  <div class="col-md">
                      <img id="img1" src="{{asset('images/70_logo.png')}}" width="100" height="100" onclick="img0.src=this.src;">
                  </div>
                  <div class="col-md">
                      <img id="img2" src="{{asset('images/login_bg.jpg')}}" width="100" height="100" onclick="img0.src=this.src;">
                  </div>
                  <div class="col-md">
                  
                      <img id="img3" src="{{asset('images/main_entrance.jpg')}}" width="100" height="100" onclick="img0.src=this.src;">
                    </div>
                    <div class="col-md">
                      <img id="img4" src="{{asset('images/lobby.jpg')}}" width="100" height="100" onclick="img0.src=this.src;">
                  </div>
              </div>
              <br>
              <div class="d-flex justify-content-center">

                <button class="btn btn-lg btn-primary" type="button" onclick="photoTaken()">
                  <i class="fa fa-camera fa-lg text-light"></i>
                </button>
              </div>
            </div>
            <div class="card-body" id="takenContainer" style="display:none;">
              <div id="capture">

                  <canvas  id="photoTaken" ref="canvas" width="450" height="337.5"></canvas>
              </div>
              <div class="">
                <a id="downloadPhoto" download="Selfie.jpg" class="btn btn-success" role="button">
                    <i class="fa fa-download"></i> Download
                </a>
                <button class="btn btn-info float-right" type="button" onclick="newSelfie()"> 
                  <i class="fa fa-repeat"></i> New
                </button>
              </div>
            </div>
              
          </div>
          
      </div>
    </div>
  </div>
  
</body>
</html>

<script>
const videoElement = document.getElementsByClassName('input_video')[0];
const canvasElement = document.getElementsByClassName('output_canvas')[0];
const canvasCtx = canvasElement.getContext('2d');

// const canvas = document.getElementById('canvas');
// const Ctx = canvas.getContext('2d');
// const canvas1 = document.getElementById('canvas1');
// const Ctx1 = canvas1.getContext('2d');
// const canvas2 = document.getElementById('canvas2');
// const Ctx2 = canvas2.getContext('2d');
const operation = document.getElementById('operation');
const img0 = document.getElementById('img0');
const img1 = document.getElementById('img1');
const img2 = document.getElementById('img2');
const img3 = document.getElementById('img3');
const img4 = document.getElementById('img4');
img0.crossOrigin = "Anonymous";
img1.crossOrigin = "Anonymous";
img2.crossOrigin = "Anonymous";
img3.crossOrigin = "Anonymous";
img4.crossOrigin = "Anonymous";
const onTakeContainer = document.getElementById('onTakeContainer');
const takenContainer = document.getElementById('takenContainer');
var state = true;

function newSelfie(){

    onTakeContainer.style.display = "block"
    takenContainer.style.display = "none"
}

function photoTaken(){
    onTakeContainer.style.display = "none"
    takenContainer.style.display = "block"
    const photoTaken = document.getElementById('photoTaken');
    const photoTakenCtx = photoTaken.getContext('2d');
    photoTakenCtx.drawImage(canvasElement, 0, 0, 450, 337.5);

    const download = document.getElementById("downloadPhoto");
      
    download.setAttribute("href", photoTaken.toDataURL("image/jpeg").replace("image/jpeg", "image/octet-stream"));
}

function onResults(results) {
  canvasCtx.save();
  canvasCtx.clearRect(0, 0, canvasElement.width, canvasElement.height);
  canvasCtx.drawImage(results.segmentationMask, 0, 0,
                      canvasElement.width, canvasElement.height);
					  	
  // Only overwrite missing pixels.
  canvasCtx.globalCompositeOperation = 'source-out';
	
  canvasCtx.drawImage(
      img0, 0, 0, canvasElement.width, canvasElement.height);
	  
  // Only overwrite missing pixels.
  canvasCtx.globalCompositeOperation = "destination-atop";
  canvasCtx.drawImage(
      results.image, 0, 0, canvasElement.width, canvasElement.height);
      canvasCtx.restore();
}

const selfieSegmentation = new SelfieSegmentation({locateFile: (file) => {
  return `https://cdn.jsdelivr.net/npm/@mediapipe/selfie_segmentation/${file}`;
}});
selfieSegmentation.setOptions({
  modelSelection: 1,
});
selfieSegmentation.onResults(onResults);

const camera = new Camera(videoElement, {
  onFrame: async () => {
    await selfieSegmentation.send({image: videoElement});
  },
  width: 320,
  height: 240
});
camera.start();
</script>