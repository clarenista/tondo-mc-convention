<template >
  <div class="embed-responsive embed-responsive-16by9 background full">
    <iframe class="embed-responsive-item" src="https://vote.psp.com.ph" allowfullscreen></iframe>
    <img src="/images/icons/sponsor-back-btn.png " @click="handleBackToLobby" class="btn btn-sm" alt="" srcset="" style="position: fixed; top: 0; left: 0; margin:1em; z-index: 10;" width="100"> 
  </div>
</template>
<script>
export default {
  methods:{
    handleBackToLobby(){
            this.$router.push({ name: 'home' })
        },
  }
    
}
</script>
<style scoped>
  div.background {
    top: 0;
    left: 0;
    position: fixed;
  }

  div.full{
    width: 100%;
    height: 100%;
  }      
</style>