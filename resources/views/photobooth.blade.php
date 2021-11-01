<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
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
  <div class="card">
    <div class="card-body" id="onTakeContainer">
      <div class="row">
        <div class="col-md-6 col-sm-12">
          <video class="input_video"  style="display:none"></video>
          <canvas class="output_canvas" width="1280px" height="720px"> </canvas>
          
        </div>
        <div class="col-md-6 col-sm">
          <p class="text-center lead">Select Background</p>
          <div class="row">
              <img id="img0" src="{{asset('images/70_logo.png')}}" class="img-fluid" style="display:none">  
              <div class="col-md col-sm col-3">
                  <img id="img1" src="{{asset('images/70_logo.png')}}" class="img-fluid" onclick="img0.src=this.src;">
              </div>
              <div class="col-md col-sm col-3">
                  <img id="img2" src="{{asset('images/login_bg.jpg')}}" class="img-fluid" onclick="img0.src=this.src;">
              </div>
              <div class="col-md col-sm col-3">
              
                  <img id="img3" src="{{asset('images/main_entrance.jpg')}}" class="img-fluid" onclick="img0.src=this.src;">
                </div>
                <div class="col-md col-sm col-3">
                  <img id="img4" src="{{asset('images/lobby.jpg')}}" class="img-fluid" onclick="img0.src=this.src;">
              </div>
          </div>
          <br>
          <div class="d-flex justify-content-center ">

            <button class="btn btn-lg btn-primary" type="button" onclick="photoTaken()">
              <i class="fa fa-camera fa-lg text-light"></i>
            </button>
          </div>
        </div>
      </div>
    </div>
    <div class="card-body" id="takenContainer" style="display:none;">
      <div class="row">
        <div class="col-md-6 col-sm-12">
          <div id="desktop">

            <canvas  id="photoTaken" ref="canvas" width="1280px" height="720px"></canvas>
          </div>
          <div id="mobile">

            <canvas  id="photoTaken" ref="canvas" width="720px" height="720px"></canvas>
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
const desktop = document.getElementById('desktop');
const mobile = document.getElementById('mobile');
var state = true;


function newSelfie(){

    onTakeContainer.style.display = "block"
    takenContainer.style.display = "none"
}

function photoTaken(){
  var isMobile = false; //initiate as false
    // device detection
    if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|ipad|iris|kindle|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(navigator.userAgent) 
    || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(navigator.userAgent.substr(0,4))) { 
      isMobile = true;
    }else{
      isMobile = false;

    }
    onTakeContainer.style.display = "none"
    takenContainer.style.display = "block"
    const photoTaken = document.getElementById('photoTaken');
    const photoTakenCtx = photoTaken.getContext('2d');
    if(isMobile){
      mobile.style.display = "block"
      desktop.style.display = "none"
      photoTakenCtx.drawImage(canvasElement, 0, 0, 720, 720);
    }else{
      mobile.style.display = "none"
      desktop.style.display = "block"
      photoTakenCtx.drawImage(canvasElement, 0, 0, 1280, 720);

    }

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
  width: 1280,
  height: 720,

});
camera.start();
</script>