<template>
  <div>
    <Loader v-if="isLoading"></Loader>
    <div id="container">

        <div class="alert alert-success" role="alert" v-if="successMessage">
            Message sent.
        </div>

        <Modal :value="value" v-if="selectedHotspot != null">
            <template v-slot:title >
              <CoolLightBox
                :items="selectedHotspot.assets"
                :index="indexSelected"
                @close="indexSelected = null">
              </CoolLightBox>
                <h1 class="text-light" v-if="selectedHotspot.name == 'contact-us'">Send us a Message</h1>
                <h1 class="text-light" v-else>{{(selectedHotspot.name).replace(/_/g, ' ')}}</h1>
            </template>

            <template v-slot:body >
                <div class="row px-4">
                  <!-- External link -->
                    <template v-if="selectedHotspot.name == 'external-link'">
                      <div class="row p-1 text-center">
                        <div class="col-12">
                          <h3 class="redirrect_msg text-dark"><i class="fa fa-info-circle text-info" aria-hidden="true"></i>
                            You are about to leave the 69<sup>th</sup> PSP virtual convention site, you will be redirected to:
                          </h3>
                          <a :href="selectedHotspot.assets[0].url" target="_blank">
                            <small><u class="text-primary">{{selectedHotspot.assets[0].url}}</u></small>
                          </a>
                        </div>
                        <div class="col-12 mt-3">
                          <small>Click the <u class="text-primary">link</u> if you wish to continue.</small>
                        </div>
                      </div>
                    </template>
                    <!-- External link -->

                    <!-- CONTACT US FORM -->
                    <template v-else-if="selectedHotspot.name == 'contact-us'">
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
                                <span class="input-group-text">Email&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                            </span>
                            <input type="email" class="form-control" v-model="email" placeholder="Email" aria-label="">
                        </div>
                      </div>

                      <div class="col-12 mb-3">
                        <div class="input-group">
                            <span class="input-group-prepend">
                                <span class="input-group-text">Mobile #&nbsp;&nbsp;</span>
                            </span>
                            <input type="text" class="form-control" v-model="mobile_number" placeholder="Mobile #" aria-label="">
                        </div>
                      </div>

                      <div class="col-12 mb-3">
                        <div class="input-group">
                            <span class="input-group-prepend">
                                <span class="input-group-text">Subject&nbsp;&nbsp;&nbsp;&nbsp;</span>
                            </span>
                            <input type="text" class="form-control" v-model="subject" placeholder="Subject" aria-label="">
                        </div>
                      </div>

                      <div class="col-12 mb-3">
                        <div class="input-group">
                            <span class="input-group-prepend">
                                <span class="input-group-text">Interest&nbsp;&nbsp;&nbsp;</span>
                            </span>
                            <input type="text" class="form-control" v-model="interest" placeholder="Interest" aria-label="">
                        </div>
                      </div>

                      <div class="col-12 mb-3">
                        <div class="input-group">
                            <span class="input-group-prepend">
                                <span class="input-group-text">Message&nbsp;</span>
                            </span>
                            <textarea class="form-control" v-model="message" placeholder="Message" aria-label=""></textarea>
                        </div>
                      </div>

                      <div class="col-12">
                        <button class="btn btn-success btn-block" @click="handleSendMessage()">&#9993; SEND MESSAGE</button>
                      </div>
                    </template>
                    <!-- CONTACT US FORM -->

                    <!-- QUIZ  -->
                    <template v-else-if="selectedHotspot.name == 'quiz'">
                    <div class="col-12 p-1">

                      <div v-if="selectedHotspot.quiz_taken  != ''">
                        <legend class="text-center text-primary mb-3"><i class="fa fa-trophy" aria-hidden="true"></i>&nbsp;Your total score: {{renderTotal}} / {{selectedHotspot.questions.length}}</legend>
                        <ol>
                          <li v-for="(question, questionIndex) in selectedHotspot.questions" :key="questionIndex">
                            <p>{{question.question}}</p>
                            <p v-if="question.answers[0]" :class="question.answers[0].correct == 1 ? 'text-success' : 'text-danger'">Your Answer: {{question.answers[0].answer}} <i class="fa" :class="question.answers[0].correct == 1 ? 'fa-check' : 'fa-times'"></i></p>
                            <p v-else class="text-danger">No Answer <i class="fa fa-times" ></i></p>
                          </li>
                        </ol>
                      </div>
                      <div v-else>
                        <div class="col-12 p-1" v-if="page == assetIndex" v-for="(item, assetIndex) in selectedHotspot.questions" :key="assetIndex" >
                          <div class="row"  >
                            <div class="col">
                              <legend>Question {{assetIndex+1}}: &nbsp;{{item.question}}?</legend>

                              <div class="form-check mb-3" v-for="(choice, index) in item.choices" :key="index">
                                <input class="form-check-input" :id="'customRadio'+index+assetIndex" type="radio" v-model="answers[item.id]"  :value="choice">
                                <label class="form-check-label" :for="'customRadio'+index+assetIndex">{{choice}}</label>
                              </div>

                              <button class="btn btn-danger float-left" type="button" v-show="!start" @click="handlePrev">Prev</button>
                              <button class="btn btn-primary float-right" type="button" v-if="!end" @click="handleNext">Next</button>
                              <button class="btn btn-primary float-right" type="button" v-else @click="handleSubmitAnswer">Submit</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    </template>
                    <!-- QUIZ  -->

                    <!-- GALLERY  -->
                    <template v-else-if="selectedHotspot.name == 'gallery'">
                    <div class="col-6 p-1" v-for="(item, assetIndex) in selectedHotspot.assets" :key="assetIndex" @click="handleSelectAssetIndex(assetIndex)">
                      <!-- <div class="card" style="cursor:pointer;">
                        <div class="card-img-overlay text-white"><small>{{item.name}}</small></div>
                        <img :src="item.url" class="img-fluid" width="100%" alt="" srcset="">
                      </div> -->

                       <div class="card text-center" style="cursor:pointer;">
                        <!-- <img :src="item.url" width="100%" alt="" srcset=""> -->
                        <div class="card-body bg-dark">
                          <!-- use to have a clickable image on the card -->

                            <div style="width: 100%;overflow: hidden;height: 8rem;display: inline-flex;">
                         <img v-if="item.thumbnail_url != null" :src="item.thumbnail_url" width="100%" alt="" srcset="">
                         <img v-else :src="item.url" width="100%" alt="" srcset="">
                            </div>
                        </div>
                        <div class="card-footer">

                          <div class="lead text-dark" style="align-items: center;white-space: nowrap;text-overflow: ellipsis;overflow: hidden;font-size: 1rem;">{{item.name}}</div>
                        </div>
                      </div>
                    </div>
                    </template>
                    <!-- GALLERY  -->

                    <!-- VIDEO -->
                    <template v-else-if="selectedHotspot.name == 'videos'">
                    <div class="col-6 p-1" v-for="(item, assetIndex) in selectedHotspot.assets" :key="assetIndex" @click="handleSelectAssetIndex(assetIndex)">
                      <div class="card text-center" style="cursor:pointer;">
                        <img :src="'https://www.youtube.com/embed/'+item.url" width="100%" alt="" srcset="">
                        <div class="card-body bg-dark">
                          <!-- use to have a clickable image on the card -->
                         <img v-if="item.thumbnail_url != null" :src="item.thumbnail_url" width="98%" alt="" srcset="">
                         <img v-else src="https://media.tenor.com/images/2c2d6329835b0cc59bb8368b66e423df/tenor.gif" width="98%" alt="" srcset="">
                        </div>
                        <div class="card-footer bg-danger">
                          <div class="lead text-white" style="align-items: center;"><i class="fa fa-file-video-o" aria-hidden="true"></i>&nbsp;{{item.name}}</div>
                        </div>
                      </div>
                    </div>
                    </template>
                    <!-- VIDEO -->

                    <!-- BROCHURES -->
                    <template v-else-if="selectedHotspot.name == 'brochures'">
                    <div class="col-6 p-1" v-for="(item, assetIndex) in selectedHotspot.assets" :key="assetIndex" @click="handleSelectAssetIndex(assetIndex)">
                      <div class="card text-center" style="cursor:pointer;">
                        <img :src="item.url" width="100%" alt="" srcset="">
                        <div class="card-body bg-dark">

                            <div style="width: 100%;overflow: hidden;height: 8rem;display: inline-flex;">
                          <!-- use to have a clickable image on the card -->
                         <img v-if="item.thumbnail_url != null" :src="item.thumbnail_url" width="100%" alt="" srcset="">
                         <img v-else src="/images/pdf-icon.png" width="100%" alt="" srcset="">
                            </div>
                        </div>
                        <div class="card-footer">
                          <div class="lead text-dark" style="align-items: center;white-space: nowrap;text-overflow: ellipsis;overflow: hidden;font-size: 1rem;">{{item.name}}</div>
                        </div>
                      </div>
                    </div>
                    </template>
                    <!-- BROCHURES -->

                    <div class="col-4" v-else v-for="(item, index) in selectedHotspot.assets" :key="index">
                      <div class="card ">
                        <p class="card-header">{{item.name}}</p>
                          <a :href="item.url" target="_blank">
                            <img src="/images/logo.png" class="img-fluid" alt="" srcset="">
                          </a>
                      </div>
                    </div>

                </div>
            </template>
            <template v-slot:footer >
                <button class="btn btn-secondary" type="button" @click="handleCloseModal">Close</button>
            </template>
        </Modal>

        <div class="booth-container" v-if="booth_details">
            <img class="centered" :src="booth_details.background" @load="imageLoad">
            <img src="/images/icons/sponsor-back-btn.png " @click="handleBackToLobby" class="btn btn-sm" alt="" srcset="" style="position: fixed; top: 0; left: 0; margin:1em; z-index: 10;" width="100">
        </div>

        <section class="hotspots--wrapper" v-if="booth_details != null">
            <img :src="booth_details.booth" class="hotspots--figure">
            <a  href="" class="hotspot" @click.prevent="handleSelectHotspot(item)" v-for="(item, index) in booth_details.hotspots" :key="index" :style="addStyle(item)">
                <!-- <span class="hotspot--cta" v-if="index == 'brochure'"></span> -->
                <img class="pulse" src="/images/icons/brochure.png" alt="brochure" srcset="" v-if="index == 'brochures'">
                <img class="pulse" src="/images/icons/contact.png" alt="contact-us" srcset="" v-if="index == 'contact-us'">
                <img class="pulse" src="/images/icons/link.png" alt="external-link" srcset="" v-if="index == 'external-link'">
                <img class="pulse" src="/images/icons/gallery.png" alt="gallery" srcset="" v-if="index == 'gallery'">
                <img class="pulse" src="/images/icons/quiz.png" alt="quiz" srcset="" v-if="index == 'quiz'">
                <img class="pulse" src="/images/icons/video.png" alt="videos" srcset="" v-if="index == 'videos'">
            </a>
            <a  href="/cms" target="_blank" class="hotspot" style="right: 25%; top: 20%;" v-if="renderNavigateToCmsHotspot">
              <img class="pulse" src="/images/icons/booth-icon-min.png" alt="cms">
            </a>

        </section>

    </div>
  </div>
</template>
<script>
import Modal from './Modal.vue'
import Loader from './Loader.vue'
export default {
    watch:{
      answers(e){
      }
    },
    components:{
        Modal, Loader
    },
    props:['id'],
    mounted() {
      this.init()

    // axios.get("/images/lt.mp4")
    //   .then(res => console.log(res.headers))

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
          affiliation: this.$store.getters.user.affiliation,
          mobile_number: this.$store.getters.user.mobile_number,
          email: this.$store.getters.user.email,
          interest: '',
          message: '',
          successMessage: false,
          data: '',
          indexSelected: null,
          answers: {},
          page: 0,
          end: false,
          start: true,
          answersS: [],
          isLoading: true,
          bgmStart: null
        }
    },
    computed:{
      renderTotal(){

        return _.sumBy(this.selectedHotspot.quiz_taken, function(o) { return o.correct; });
      },
      renderNavigateToCmsHotspot(){
        if(this.$store.getters.user.classification === 'sponsor'){
          if(this.$store.getters.user.booth.id === this.booth_details.id){
            return true
          }else{
            return false

          }
        }
      }
    },
    methods:{
        async init(){
            const wrapper = document.querySelector('.hotspots--wrapper');
            let {data} = await axios.get('/api/v1/booths/'+this.id+'?api_token='+localStorage.getItem('access_token'));
            this.booth_details = data
            this.$store.commit('changeBoothDetails', data)
            this.sendBoothGuestEvent(data)
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

          if(this.$store.getters.user.classification === 'sponsor'){

            this.$router.push({ name: 'home'})
          }else{

            this.$router.push({ name: 'home', params: {sceneId: this.booth_details.panorama_location != 'lobby' ?  this.booth_details.panorama_location : 'lobby' }})
          }
        },
        handleSelectHotspot(hotspot){
          this.value = true
          for(let i in hotspot.assets){
            hotspot.assets[i]['src'] = hotspot.assets[i].url
          }
          this.selectedHotspot = hotspot
          if(hotspot.name == 'videos'){
            if(this.$store.getters.bgmStart){
              this.bgmStart = true
              this.$store.commit('updateBgmStart', false)
            }
          }
          this.sendBoothGuestEvent(this.booth_details, hotspot)
        },
        handleCloseModal(){
          if(this.selectedHotspot.name == 'videos'){
            if(this.bgmStart){
              this.$store.commit('updateBgmStart', true)
            }else{
              this.$store.commit('updateBgmStart', false)

            }
          }
            this.selectedHotspot = null
            this.value = false
        },
        async handleSendMessage(){
          let url = '/api/v1/booths/'+this.id+'/message?api_token='+localStorage.getItem('access_token')



          // append text fields
          let fd = new FormData()
          fd.append('subject', this.subject)
          // fd.append('name', this.name)
          fd.append('affiliation', this.affiliation)
          fd.append('mobile_number', this.mobile_number)
          fd.append('email', this.email)
          fd.append('interest', this.interest)
          fd.append('message', this.message)

          try {
            let {data} = await axios.post(url, fd)
            this.selectedHotspot = null
            this.value = false

            this.subject = ''
            this.affiliation = ''
            this.email = ''
            this.interest = ''
            this.message = ''
          } catch (error) {
            alert(JSON.stringify(error.message))
            this.value = true
          }

        },
        async sendBoothGuestEvent(booth = null, hotspot=null){
          // category: lobby,
          // label: click Astra Zeneca Booth
          let fd = new FormData()

          fd.append('type', 'event')
          fd.append('category', booth.name)
          fd.append('label', hotspot == null ? 'visit' : 'click '+hotspot.name+" hotspot")

          let {data} = await axios.post('/api/v1/guests/event/push?api_token='+localStorage.getItem('access_token'), fd);
        },

        handleSelectAssetIndex(assetIndex){
          // this.value = false
          this.indexSelected=assetIndex
        },
        handleNext(){
          this.start = false
          let count = this.selectedHotspot.questions.length - 1
          if(count > this.page){
            this.page = this.page + 1
            if(count == this.page){
              this.end = true
              this.start = false
            }
          }else{
            this.end = true
            this.start = false
          }
        },
        handlePrev(){
          this.end = false
          let count = this.selectedHotspot.questions.length
          if(0 < this.page){
            this.page = this.page - 1
            console.log(this.page)
            if(0>this.page){

            this.end = false
            this.start = true
            }
          }else{
            this.end = false
            this.start = true
          }
        },
        async handleSubmitAnswer(){
          let fd = new FormData()
          fd.append('answers', JSON.stringify(this.answers))
          let {data} = await axios.post('/api/v1/booths/'+this.id+'/questionnaire/answer/submit?api_token='+localStorage.getItem('access_token'), fd)
          this.selectedHotspot.quiz_taken = data.answers
          this.selectedHotspot.questions = data.questions
        },
        async showQuestionnaire(){
          let {data} = await axios.get('/api/v1/booths/'+this.id+'/questionnaire?api_token='+localStorage.getItem('access_token'))
          console.log(data)
        },
        imageLoad(){
          this.isLoading = false
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
}

.hotspots--wrapper {
  overflow: hidden;
  position: relative;
  margin: auto;
  /* max-width: 960px; */
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

/* ICONS */
.hotspots--wrapper a img {
  width: 75px;
  animation: pulse 2s infinite;
  border-radius: 50%;
}

.hotspots--wrapper a img:hover {
  animation: none;
  box-shadow: 0 3px 18px #000;
}
 @-webkit-keyframes pulse {
    0% {
      -webkit-box-shadow: 0 0 0 0 rgba(0, 183, 255, 0.9);
    }
    70% {
      -webkit-box-shadow: 0 0 0 10px rgba(255, 255, 255, 0);
    }
    100% {
      -webkit-box-shadow: 0 0 0 0 rgba(255, 255, 255, 0);
    }
  }
  @keyframes pulse {
    0% {
      -moz-box-shadow: 0 0 0 0 rgba(61, 200, 255, 0.9);
      box-shadow: 0 0 0 0 rgba(151, 226, 255, 0.9);
    }
    70% {
      -moz-box-shadow: 0 0 0 10px rgba(255, 255, 255, 0);
      box-shadow: 0 0 0 10px rgba(255, 255, 255, 0);
    }
    100% {
      -moz-box-shadow: 0 0 0 0 rgba(255, 255, 255, 0);
      box-shadow: 0 0 0 0 rgba(255, 255, 255, 0);
    }
  }

@media screen and (max-width: 1024px) {
  .hotspots--wrapper a img {
    width: 40px;
  }


}

@media screen and (max-width: 750px) {
    .hotspots--wrapper a img {
      width: 20px;
    }

     .input-group .input-group-text {
      font-size: 11px !important;
    }
    input[type="text"]{
      font-size: 12px !important;
    }
    input[type="email"]{
      font-size: 12px !important;
    }
    textarea{
      font-size: 12px !important;
    }

  }

  @media screen and (max-width: 320px) {

    .hotspots--wrapper a img {
      width: 17px;
    }

  }

  @media screen and (max-width: 360px) {
    .hotspots--wrapper a img {
      width: 20px;
    }

    .input-group .input-group-text {
      font-size: 11px !important;
    }
    input[type="text"]{
      font-size: 11px !important;
    }
    input[type="email"]{
      font-size: 11px !important;
    }
    textarea{
      font-size: 11px !important;
    }
  }

@media screen and (max-width: 280px) {
  .hotspots--wrapper a img {
    width: 15px;
  }
}

.redirrect_msg {
  font-size: 2.2rem;
  font-weight:300;
  line-height:1;
}

.pulse{
  animation: pulse 2s infinite;
}

.custom-control {
  padding: 2% 0 0 2%;
  margin-left: 10%;
}

/* quiz form */
.form-check {
  padding: 1% 1% 1% 8%;
  border:1px solid #1b9e93;
  border-radius: 8px;
  font-weight: 500;
}

.form-check:hover {
   background: #beebd7;
}

input[type="radio"]:checked {
   background: #beebd7;
}

/* send us a message - default */
.input-group .input-group-text {
  font-size: 15px;
}
input[type="text"]{
  font-size: 15px;
}
input[type="email"]{
  font-size: 15px;
}
textarea{
  font-size: 15px;
}
.card-body {
    padding: .5rem;
}
</style>
