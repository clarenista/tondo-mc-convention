<template lang="">
  <div align="center">
    <h1>Winwheel.js example wheel - wheel of fortune</h1>
    <p class="lead">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quae temporibus saepe sequi nostrum, dolore nihil quam ipsum exercitationem distinctio sapiente explicabo unde eligendi maxime dignissimos a atque debitis, quod doloremque?</p>
    <br />
    <table cellpadding="0" cellspacing="0" border="0">
      <tr>
        <td>
            <div class="power_controls">
                <br />
                <br />
                <table class="power" cellpadding="10" cellspacing="0">
                    <tr>
                        <th align="center">Power</th>
                    </tr>
                    <tr>
                        <td width="78" align="center" id="pw3" @click="powerSelected(3);">High</td>
                    </tr>
                    <tr>
                        <td align="center" id="pw2" @click="powerSelected(2);">Med</td>
                    </tr>
                    <tr>
                        <td align="center" id="pw1" @click="powerSelected(1);">Low</td>
                    </tr>
                </table>
                <br />
                <img id="spin_button" src="/images/spin_off.png" alt="Spin" @click="startSpin();" />
                <br /><br />
                &nbsp;&nbsp;<a href="#" @click="resetWheel(); return false;">Play Again</a><br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(reset)
            </div>
        </td>
        <td width="438" height="582" class="the_wheel" align="center" valign="center">
            <canvas id="canvas" width="434" height="434">
                <p style="{color: white}" align="center">Sorry, your browser doesn't support canvas. Please try another.</p>
            </canvas>
        </td>
      </tr>
    </table>  
  </div>
</template>
<script>
import WinWheel from "winwheel";
import "/js/TweenMax.min.js";
import  '/css/main.css'
export default {
  data() {
    return {
      wheelPower: 0,
      wheelSpinning: false,
      theWheel: null,
      audio: null
    }
  },  
  mounted() {
    const vm = this
        // Create new wheel object specifying the parameters at creation time.
    vm.theWheel = new WinWheel({
        'outerRadius'     : 212,        // Set outer radius so wheel fits inside the background.
        'innerRadius'     : 75,         // Make wheel hollow so segments don't go all way to center.
        'textFontSize'    : 24,         // Set default font size for the segments.
        'textOrientation' : 'vertical', // Make text vertial so goes down from the outside of wheel.
        'textAlignment'   : 'outer',    // Align text to outside of wheel.
        'numSegments'     : 9,         // Specify number of segments.
        'segments'        :             // Define segments including colour and text.
        [                               // font size and test colour overridden on backrupt segments.
            {'fillStyle' : '#ee1c24', 'text' : '1000'},
            {'fillStyle' : '#f6989d', 'text' : '500'},
            {'fillStyle' : '#f26522', 'text' : '400'},
            {'fillStyle' : '#3cb878', 'text' : '900'},
            {'fillStyle' : '#000000', 'text' : 'BANKRUPT', 'textFontSize' : 16, 'textFillStyle' : '#ffffff'},
            {'fillStyle' : '#a186be', 'text' : '600'},
            {'fillStyle' : '#fff200', 'text' : '700'},
            {'fillStyle' : '#00aef0', 'text' : '800'},
            {'fillStyle' : '#ffffff', 'text' : 'LOOSE TURN', 'textFontSize' : 12}
        ],
        'animation' :           // Specify the animation to use.
        {
            'type'     : 'spinToStop',
            'duration' : 3,    // Duration in seconds.
            'spins'    : 3,     // Default number of complete spins.
            'callbackFinished' : this.alertPrize,
            'callbackSound'    : this.playSound(),   // Function to call when the tick sound is to be triggered.
            'soundTrigger'     : 'pin'        // Specify pins are to trigger the sound, the other option is 'segment'.
        },
        'pins' :				// Turn pins on.
        {
            'number'     : 24,
            'fillStyle'  : 'silver',
            'outerRadius': 4,
        }
    });

    // Loads the tick audio sound in to an audio object.

    this.audio = new Audio('/bgm/tick.mp3');
  },
  methods:{
    playSound()
    { 
      console.log(this.audio)
        // Stop and rewind the sound if it already happens to be playing.
        // this.audio.pause();
        // this.audio.currentTime = 0;

        // // Play the sound.
        // this.audio.play();
    },
    powerSelected(powerLevel)
    {
        // Ensure that power can't be changed while wheel is spinning.
        if (this.wheelSpinning == false) {
            // Reset all to grey incase this is not the first time the user has selected the power.
            document.getElementById('pw1').className = "";
            document.getElementById('pw2').className = "";
            document.getElementById('pw3').className = "";

            // Now light up all cells below-and-including the one selected by changing the class.
            if (powerLevel >= 1) {
                document.getElementById('pw1').className = "pw1";
            }

            if (powerLevel >= 2) {
                document.getElementById('pw2').className = "pw2";
            }

            if (powerLevel >= 3) {
                document.getElementById('pw3').className = "pw3";
            }

            // Set wheelPower var used when spin button is clicked.
            this.wheelPower = powerLevel;

            // Light up the spin button by changing it's source image and adding a clickable class to it.
            document.getElementById('spin_button').src = "/images/spin_on.png";
            document.getElementById('spin_button').className = "clickable";
        }
    },
    startSpin()
    {
      // Ensure that spinning can't be clicked again while already running.
      if (this.wheelSpinning == false) {
          // Based on the power level selected adjust the number of spins for the wheel, the more times is has
          // to rotate with the duration of the animation the quicker the wheel spins.
          if (this.wheelPower == 1) {
              this.theWheel.animation.spins = 3;
          } else if (this.wheelPower == 2) {
              this.theWheel.animation.spins = 6;
          } else if (this.wheelPower == 3) {
              this.theWheel.animation.spins = 10;
          }

          // Disable the spin button so can't click again while wheel is spinning.
          document.getElementById('spin_button').src       = "images/spin_off.png";
          document.getElementById('spin_button').className = "";

          // Begin the spin animation by calling startAnimation on the wheel object.
          this.theWheel.startAnimation();

          // Set to true so that power can't be changed and spin button re-enabled during
          // the current animation. The user will have to reset before spinning again.
          this.wheelSpinning = true;
      }
    },
    resetWheel()
    {
        this.theWheel.stopAnimation(false);  // Stop the animation, false as param so does not call callback function.
        this.theWheel.rotationAngle = 0;     // Re-set the wheel angle to 0 degrees.
        this.theWheel.draw();                // Call draw to render changes to the wheel.

        document.getElementById('pw1').className = "";  // Remove all colours from the power level indicators.
        document.getElementById('pw2').className = "";
        document.getElementById('pw3').className = "";

        this.wheelSpinning = false;          // Reset to false to power buttons and spin can be clicked again.
    },
    alertPrize(indicatedSegment)
    {
        // Just alert to the user what happened.
        // In a real project probably want to do something more interesting than this with the result.
        if (indicatedSegment.text == 'LOOSE TURN') {
            alert('Sorry but you loose a turn.');
        } else if (indicatedSegment.text == 'BANKRUPT') {
            alert('Oh no, you have gone BANKRUPT!');
        } else {
            alert("You have won " + indicatedSegment.text);
        }
    }    
  }
}
</script>
<style lang="">
  
</style>