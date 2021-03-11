<template>
  <div class="container mt-3">
      <div class="row">
        <div class="col-3">
            <button class="btn btn-primary" type="button" @click="showModal">Upload Image</button>
        </div>
        
        <div class="col ">

            <div class="card-columns">
              <div class="card" v-for="(item, i) in filteredGallery" :key="i">
                 <img :src="item.path" class="img-fluid">
              </div>
            </div>
          
        </div>
      </div>

      <!-- modal -->
      <div class="modal-backdrop fade show" v-if="modalShow"></div> 
      
      <div :class="modalShow ? 'modal-open': ''">
        <div class="modal fade show" 
          :class="modalShow ? 'show' : ''" 
          :style="modalShow ? 'display: block;' : ''"
          tabindex="-1" role="dialog" aria-hidden="true">

          <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
              <div class="modal-header bg-info">
                <h5 class="modal-title" id="exampleModalLabel">Upload New Image</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                ...
              </div>
              <div class="modal-footer bg-info">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" @click="modalClose">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
              </div>
            </div>
          </div>
        </div>
      </div>

  </div>
</template>

<script>
export default {
  mounted() {
      this.getGalleryAssets()
  },
     
  data(){
        return{
            modalShow: false,
            banner: this.galleryAssets,
            filteredGallery: [],
        }
    },
    methods:{
        showModal(){
            this.modalShow = true
        },

        modalClose(){
          this.modalShow = false
        },

        getGalleryAssets(){
          this.filteredGallery = this.$store.getters.gallery
          let galleryAssets = _.map(this.$store.getters.gallery, function(o){
            if(o.type == 'image') return o;
          });

          this.filteredGallery = _.without(galleryAssets, undefined)

        },

    },
}
</script>

<style>

</style>