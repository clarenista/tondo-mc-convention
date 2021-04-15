<template>
    <div>
        <div class="row d-flex justify-content-center">
            <div class="col-12">
                <div class="row">
                    <div class="col p-1">
                        <div class="card card-primary bg-primary text-light">
                            <div class="card-body text-center">
                                <p class="display-4 m-0">{{zeroPad(days)}}</p>
                                <p class="lead m-0 text-light text-uppercase">days</p>
                            </div>
                        </div>
                    </div>
                    <div class="col p-1">
                        <div class="card card-primary bg-primary text-light">
                            <div class="card-body text-center">
                                <p class="display-4 m-0">{{zeroPad(hours)}}</p>
                                <p class="lead m-0 text-light text-uppercase">hours</p>
                            </div>
                        </div>
                    </div>
                    <div class="col p-1">
                        <div class="card card-primary bg-primary text-light">
                            <div class="card-body text-center">
                                <p class="display-4 m-0">{{zeroPad(minutes)}}</p>
                                <p class="lead m-0 text-light text-uppercase">minutes</p>
                            </div>
                        </div>
                    </div>
                    <div class="col p-1">
                        <div class="card card-primary bg-primary text-light">
                            <div class="card-body text-center">
                                <p class="display-4 m-0">{{zeroPad(seconds)}}</p>
                                <p class="lead m-0 text-light text-uppercase">seconds</p>
                            </div>
                        </div>
                    </div>                                                          
                </div>
                <p class="text-center text-light mt-3 login_msg" v-html="introduction"></p>
            </div>

        </div>
        
        
    </div>
</template>
<script>
export default {
    props:['endTime'],
    created() {
        // this.settings = this.props_settings
        this.init()        
    },
    data() {
        return {
            countDownStartTime: '',
            countDownEndTime: 0,
            counDownDistance: '',
            days: '',
            hours: '',
            minutes: '',
            seconds: '',
            isClose: false,
            distance: '',    
            introduction: 'PSP 69<sup>th</sup> Annual Convention Virtual Event <br> 23<sup>rd</sup> - 26<sup>th</sup> of April 2021',        
        }
    },
    methods:{
        init(){
            this.countDownEndTime =  new Date(this.endTime).getTime();
            this.countDownStart()
            let x = setInterval(()=>{
                this.countDownStart()
                if(this.distance < 0){
                    clearInterval(x)
                    this.handleTimerEnd()

                }
            }, 1000)
            console.log('type of countDownEndTime', typeof this.countDownEndTime)
            console.log('value of countDownEndTime', this.countDownEndTime)
        },
        countDownStart(){
                
            let now = new Date().getTime();
            this.distance = this.countDownEndTime - now;

            // Time calculations for days, hours, minutes and seconds
            this.days = Math.floor(this.distance / (1000 * 60 * 60 * 24));
            this.hours = Math.floor((this.distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            this.minutes = Math.floor((this.distance % (1000 * 60 * 60)) / (1000 * 60));
            this.seconds = Math.floor((this.distance % (1000 * 60)) / 1000);
            
        },
        handleTimerEnd(){
            this.$emit('handleTimerEnd', true);
        },
        zeroPad(num){
            return String(num).padStart(2, '0');
        }
    }   
}
</script>
<style scoped>
.login_msg {
    font-size: 1.5rem;
    font-weight:300;
    line-height: 1.2;
    font-family:-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji"
}
 .display-4 {
    font-size: 2.0rem;
}
.lead {
    font-size: 2.0rem;
}

@media screen and (max-width: 768px) {
    .login_msg {
        font-size: 1.0rem;
    }
    .display-4 {
        font-size: 1.4rem;
    }
    .lead {
        font-size: 0.8rem;
    }
}

@media screen and (max-width: 320px) {

    .display-4 {
        font-size: 0.6rem;
    }
   
}

@media screen and (max-width: 360px) {
    .login_msg {
        font-size: 0.7rem;
    }
    .display-4 {
        font-size: 1.3rem;
    }
    .lead {
        font-size: 0.7rem;
    }
}

@media screen and (max-width: 280px) {
    .login_msg {
        font-size: 0.9rem;
    }
    .display-4 {
        font-size: 1.3rem;
    }
    .lead {
        font-size: 0.4rem;
    }
}

</style>