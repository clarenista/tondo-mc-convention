<template>
    <div class="parent" ref="parent" data-ui-coverBox>
        <div class="box" ref="uiratio" :style="style" data-ui-ratio="16,9">
            
        </div>
    </div>
</template>
<script>
export default {
    mounted() {
        this.rescale()
        window.addEventListener('resize', this.rescale)
    },
    data() {
        return {
            style: {},
            uiRatio: [16, 9]
        }
    },
    methods:{
        init(){
            let vm = this
            
            
            // $(window)
            //     .resize(function() {
            //         vm.rescale();
            //     })
            //     .resize();
        },
        rescale(){

            let parent, ratio, uiratios, dimension, size;
            parent = this.$refs.parent 
            ratio = this.$refs.uiratio.dataset.uiRatio
            uiratios = ratio.split(',')
            console.log(this.$refs.uiratio.dataset.uiRatio)
            dimension = {
                w: parseFloat(uiratios[0]),
                h: parseFloat(uiratios[1])
            }
            size = Math.min(parent.clientWidth / dimension.w, parent.clientHeight / dimension.h);
            this.style = {width: dimension.w * size+"px", height: dimension.h * size+"px", }
                      
        }
    }

  }
</script>
<style scoped>
.parent{
  position: absolute;
  width: 100%;
  height: 100%;
  top :0;
  left: 0;
  right: 0;
  bottom: 0;
  margin: auto;
  outline:2px solid red;
  overflow: hidden;
  background-image: url('/images/lt.png');
	background-size: 100% 100%;
    background-position: center;
}

[data-ui-ratio]{
  background-image: url('/images/bt.png');
    background-repeat: no-repeat;
	background-size: cover;
      position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  border-radius: 5px;
}
.video-container{
  position: absolute;
  top: 50%;
  left: 50%;
  width: 150%;
  height: 150%;
  transform: translate(-50%, -50%);
  background: #56bcf9;
  opacity: 0.85;
  
  img{
    width: 100%;
    height: 100%;
  }
}
</style>