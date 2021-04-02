<template>
    <div id="container" >
            <div class="alert alert-success" role="alert" v-if="successMessage">
                Message sent.
            </div>
           <Modal :value="value" v-if="selectedHotspot != null">
                <template v-slot:title >
                    <h1>{{selectedHotspot.name}}</h1>
                </template>           
                <template v-slot:body >
                    <div class="row">
                        <div class="col-12">
                            <img  :src="selectedHotspot.assets[0].url" class="img-fluid" alt="" srcset="">
                        </div>

                        <!-- CONTACT US FORM -->
                        <template v-if="selectedHotspot.name == 'contact-us'">
                        
                        <div class="col-12 mb-3">
                          <!-- {{selectedHotspot.assets[0].url}} -->
                          <div class="input-group">
                              <span class="input-group-prepend">
                                  <span class="input-group-text">Subject</span>
                              </span>
                              <input type="text" class="form-control" v-model="subject" placeholder="Subject" aria-label="">
                          </div>
                        </div>
                        
                        <div class="col-12 mb-3">
                          <div class="input-group">
                              <span class="input-group-prepend">
                                  <span class="input-group-text">Fullname</span>
                              </span>
                              <input type="text" class="form-control" v-model="name" placeholder="Fullname" aria-label="">
                          </div>
                        </div>

                        <div class="col-12 mb-3">
                          <div class="input-group">
                              <span class="input-group-prepend">
                                  <span class="input-group-text">Affiliation</span>
                              </span>
                              <input type="text" class="form-control" v-model="affiliation" placeholder="Affiliation" aria-label="">
                          </div>
                        </div>

                        <div class="col-12 mb-3">
                          <div class="input-group">
                              <span class="input-group-prepend">
                                  <span class="input-group-text">Mobile #</span>
                              </span>
                              <input type="text" class="form-control" v-model="mobile_number" placeholder="Mobile #" aria-label="">
                          </div>
                        </div>

                        <div class="col-12 mb-3">
                          <div class="input-group">
                              <span class="input-group-prepend">
                                  <span class="input-group-text">Email</span>
                              </span>
                              <input type="email" class="form-control" v-model="email" placeholder="Email" aria-label="">
                          </div>
                        </div>

                        <div class="col-12 mb-3">
                          <div class="input-group">
                              <span class="input-group-prepend">
                                  <span class="input-group-text">Interest</span>
                              </span>
                              <input type="text" class="form-control" v-model="interest" placeholder="Interest" aria-label="">
                          </div>
                        </div>

                        <div class="col-12 mb-3">
                          <div class="input-group">
                              <span class="input-group-prepend">
                                  <span class="input-group-text">Message</span>
                              </span>
                              <textarea class="form-control" v-model="message" placeholder="Message" aria-label=""></textarea>
                          </div>
                        </div>

                        <div class="col-12">
                          <button class="btn btn-success btn-block" @click="handleSendMessage()">&#9993; SEND MESSAGE</button>
                        </div>
                        </template>
                        <!-- CONTACT US FORM -->

                        <template v-if="selectedHotspot.name == 'Brochures'">
                          <div class="col-12">
                            <ul>
                              <li>list 1</li>
                              <li>list 2</li>
                              <li>list 3</li>
                            </ul>
                          </div>
                        </template>

                    </div>
                </template>  
                <template v-slot:footer >
                    <button class="btn btn-secondary" type="button" @click="handleCloseModal">Close</button>
                </template>          
           </Modal>
        <div class="booth-container">
            <img class="centered" src="/images/lt.png">
            <button class="btn btn-primary btn-sm" @click="handleBackToLobby" type="button" style="position: fixed; top: 0; left: 0; margin:1em;">< Back to lobby</button>
        </div>
        <section class="hotspots--wrapper" >
          <!-- {{booth_details}} -->
            <img src="/images/bt.png" class="hotspots--figure">
            <a v-if="booth_details.hotspots != null" href="" class="hotspot" @click.prevent="handleSelectHotspot(item)" v-for="(item, index) in booth_details.hotspots" :key="index" :style="addStyle(item)">
                <span class="hotspot--cta"></span>
            </a>
            
        </section>
        
    </div>
</template>
<script>
import Modal from './Modal.vue'
export default {
    components:{
        Modal
    },
    props:['id'],
    mounted() {
     this.init()

    axios.get("/images/lt.mp4")
      .then(res => console.log(res.headers))

    //  fetch("/images/lt.mp4", {method:"HEAD"})
    // .then(response => response.headers.get("Content-Type"))
    // .then(type => console.log(`.${type.replace(/.+\/|;.+/g, "")}`));
        
    },
    data() {
        return {
            booth_details: null,
            modalShow: false,
            selectedHotspot: null,
            value: false,
            // contact-us field
            subject: '',
            name: '',
            affiliation: '',
            mobile_number: '',
            email: '',
            interest: '',
            message: '',
            successMessage: false,

        }
    },
    methods:{
        async init(){
            const wrapper = document.querySelector('.hotspots--wrapper');
            let {data} = await axios.get('/api/v1/booths/'+this.id+'?api_token='+localStorage.getItem('access_token'));
            this.booth_details = data
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
                      
        },
        
        
        addStyle(item){
            return {right: item.y+'%', top: item.x+'%'}
        },
        handleBackToLobby(){
            this.$router.push('/')
        },
        handleSelectHotspot(hotspot){
            this.value = true
            this.selectedHotspot = hotspot
        },
        handleCloseModal(){
            this.selectedHotspot = null
            this.value = false
        },
        async handleSendMessage(){
          let url = '/api/v1/booths/'+this.id+'/message?api_token='+localStorage.getItem('access_token')

          // append text fields
          let fd = new FormData()
          fd.append('subject', this.subject)
          fd.append('name', this.name)
          fd.append('affiliation', this.affiliation)
          fd.append('mobile_number', this.mobile_number)
          fd.append('email', this.email)
          fd.append('interest', this.interest)
          fd.append('message', this.message)
          let {data} = await axios.post(url, fd)
          
          if(data.status === 'ok'){
            this.successMessage = true
          }
          
        }
    }

  }
</script>
<style scoped>

@media screen and (orientation:portrait) {
    .booth-container {
        height: 100vw;
    }

    .centered {
        width: 310%;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-51.5%, -50%);
    }
}

@media screen and (orientation:landscape) {
    .booth-container {
        height: 100vh;
    }

    .centered {
        height: 250%;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-51%, -48%);
    }
}

div#container{
  margin: 0;
  padding: 0;
  display: flex;
  min-height: 100vh;
}

body div {
  display: flex;
}

.hotspots--wrapper {
  overflow: hidden;
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