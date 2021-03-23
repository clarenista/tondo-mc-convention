<template>
    <section class="hotspots--wrapper">
        <img src="/images/bt.png" class="hotspots--figure">
        <a class="hotspot hotspot--iphone" href="#">
            <span class="hotspot--cta"></span>
        </a>
        <a class="hotspot hotspot--macbook" href="#">
            <span class="hotspot--title">MacBook</span>
            <span class="hotspot--cta"></span>
        </a>
        
    </section>
</template>
<script>
export default {
    props:['id'],
    mounted() {
     this.init()
        
    },
    data() {
        return {
            booth_details: null
        }
    },
    methods:{
        async init(){
            let {data} = await axios.get('/api/v1/booths/'+this.id);
            console.log(data)
            this.booth_details = data

            data.forEach((point) => {
                let a = document.createElement('a'); 
                a.style.left = point.x;
                a.style.top = point.y;
                a.title = point.data;
                a.className= 'overlay-image';
                a.src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/544303/Target_Logo.svg"
                overlay.appendChild(img);
                a.data = point.data;
                a.addEventListener('mouseenter', handleMouseEnter);
                a.addEventListener('mouseleave', handleMouseLeave);
            });
            
            // $(window)
            //     .resize(function() {
            //         vm.rescale();
            //     })
            //     .resize();
        },
        rescale(){

            // let parent, ratio, uiratios, dimension, size;
            // parent = this.$refs.parent 
            // ratio = this.$refs.uiratio.dataset.uiRatio
            // uiratios = ratio.split(',')
            // dimension = {
            //     w: parseFloat(uiratios[0]),
            //     h: parseFloat(uiratios[1])
            // }
            // size = Math.min(parent.clientWidth / dimension.w, parent.clientHeight / dimension.h);
            // this.style = {width: dimension.w * size+"px", height: dimension.h * size+"px", }
                      
        }
    }

  }
</script>
<style scoped>
@import url('https://fonts.googleapis.com/css?family=Maven+Pro:500&display=swap');

body div {
  margin: 0;
  padding: 0;
  display: flex;
  min-height: 100vh;
}

.hotspots--wrapper {
  background-image: url('/images/lt.png');
  background-size: cover;
  position: relative;
  margin: auto;
  max-width: 960px;
  font-family: 'Maven Pro', sans-srif;
  font-weight: 500;
}

.hotspots--figure {
  max-width: 100%;
}

.hotspot {
  position: absolute;
  display: block;
}

.hotspot--title {
  display: inline-block;
  padding-right: 10px;
  color: #ff0000;
  text-transform: uppercase;
  line-height: 50px;
  font-size: 12px;
  letter-spacing: 1px;
  transition: all cubic-bezier(.8,0,.2,1) .4s;
}

.hotspot--title__right {
  float: right;
  padding-right: 0;
  padding-left: 10px;
}

.hotspot--cta {
  position: relative;
  float: right;
  display: inline-block;
  width: 50px;
  height: 50px;
  border-radius: 50%;
  background: #ff0000;
  transition: all cubic-bezier(.8,0,.2,1) .4s;
}

.hotspot--cta::after {
  content: '';
  position: absolute;
  left: 0;
  top: 0;
  bottom: 0;
  right: 0;
  margin: auto;
  width: 10px;
  height: 10px;
  border-radius: 50%;
  background: #fff;
  z-index: 2;
  transition: opacity .6s;
  animation: pulse 1.5s cubic-bezier(.8,0,.2,1) 0s infinite;
}

.hotspot:hover .hotspot--cta {
  transform: scale(.6);
}

.hotspot:hover .hotspot--cta:after {
  opacity: 0;
}

@keyframes pulse {
  0% {transform: scale(0.4);}
  33% {transform: scale(1);}
  66% {transform: scale(0.4);}
  100% {transform: scale(0.4);}
}

.hotspot--iphone {
    top: 36%;
    right: 71.5%;
}

.hotspot--macbook {
  top: 22%;
  right: 48%;
}

.hotspot--watch {
  top: 72%;
  left: 45%;
}

@media screen and (max-width: 640px) {
  .hotspot--title {
    line-height: 40px;
    font-size: 10px;
  }
  .hotspot--cta {
    width: 40px;
    height: 40px;
  }
}

@media screen and (max-width: 420px) {
  .hotspot--title {
    line-height: 30px;
    font-size: 9px;
  }
  .hotspot--cta {
    width: 30px;
    height: 30px;
  }
}

@media screen and (max-width: 320px) {
  .hotspot--title {
    display: none;
  }
  
  .hotspot--cta {
    width: 20px;
    height: 20px;
  }
  .hotspot--cta::after {
    width: 5px;
    height: 5px;
  }
}
</style>