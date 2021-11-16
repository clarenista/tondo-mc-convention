<template>
    <div>
        <audio src="/bgm/bgm.mp3" loop id="bgm"></audio>
        <router-view></router-view>
    </div>
</template>

<script>
export default {
    mounted() {
        this.init()
        // var audio = new Audio('http://soundbible.com/mp3/Air Plane Ding-SoundBible.com-496729130.mp3');
        // audio.muted = true
        // audio.play();
    },
    methods:{
        init(){

        }
    }
    
}
</script>
<style scoped>

</style>