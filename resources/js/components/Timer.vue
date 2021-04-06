<template>
    <div>
        <div class="row d-flex justify-content-center">
            <div class="col-8">
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
            </div>
        </div>
        
        
    </div>
</template>
<script>
export default {
    props:['endTime'],
    mounted() {
        // this.settings = this.props_settings
        this.init()        
    },
    data() {
        return {
            countDownStartTime: '',
            countDownEndTime: '',
            counDownDistance: '',
            days: '',
            hours: '',
            minutes: '',
            seconds: '',
            isClose: false,
            distance: '',            
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
<style lang="">
    
</style>