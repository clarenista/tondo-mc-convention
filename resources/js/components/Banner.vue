<template >
    <div class="container">
        <!-- Modal -->
        <div>

            <b-modal v-model="modalShow" id="modal-1" title="Change banner"  hide-footer>
                <b-list-group>
                    <b-list-group-item  
                        style="cursor:pointer;"
                        v-for="(item, index) in filteredAssets" 
                        :key="index"
                        @click="handleCopyImagePath(item)"
                        :active="itemSelected ? itemSelected.name === item.name : false"
                    >{{item.name}}</b-list-group-item>
                </b-list-group>
                <br>
                <b-button variant="primary" @click="handleUpdateImage">
                    Update
                </b-button><b-button variant="danger" @click="handleCancelUpdateImage">
                    Cancel
                </b-button>
            </b-modal>
        </div>    
        <div class="jumbotron">
            <h1 class="display-4">Banner</h1>
            
            <button class="btn btn-primary" type="button" @click="handleChangeBannerClicked">Change banner</button>
            <hr class="my-4">
            <img class="img-fluid text-center" :src="banner" alt="">
        </div>
    </div>
</template>
<script>
export default {
    mounted() {
        this.getImageAssets()
    },
    data(){
        return{
            modalShow: false,
            banner: 'https://via.placeholder.com/400',
            filteredAssets: [],
            itemSelected: null
        }
    },
    methods:{
        handleChangeBannerClicked(){
            this.modalShow = true
        },
        getImageAssets(){
            this.filteredAssets = this.$store.getters.assets
            let imageAssets = _.map(this.$store.getters.assets, function(o) {
                if (o.type == 'image') return o;
            });            
            // Remove undefines from the array
            this.filteredAssets = _.without(imageAssets, undefined) 
        },
        handleCopyImagePath(item){
            this.itemSelected = item
        },
        handleUpdateImage(){
            this.banner = this.itemSelected.path
            this.modalShow = false
            this.itemSelected = null
        },
        handleCancelUpdateImage(){
            this.modalShow = false
            this.itemSelected = null
        }
    }
}
</script>
<style>
    
</style>