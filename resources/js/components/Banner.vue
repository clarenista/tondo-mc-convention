<template >
    <div class="container mt-1">
        <!-- Modal -->
        <div :class="modalShow ? 'modal-open': ''">
            <div 
                class="modal fade show" 
                :class="modalShow ? 'show' : ''" 
                :style="modalShow ? 'display: block;' : ''"
                tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                        <ul class="list-group">
                            <li 
                                class="list-group-item"
                                style="cursor:pointer;"
                                v-for="(item, index) in filteredAssets" 
                                :key="index"
                                :class="handleActiveClass(item)"
                                @click="handleCopyImagePath(item)"
                            >{{item.name}}</li>
                        </ul>
                        <br>
                        <button class="btn btn-primary" @click="handleUpdateImage">Update</button>
                        <button class="btn btn-danger" @click="handleCancelUpdateImage">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>

            
        </div>    
        <div class="row">
            <div class="col-3">
                <button class="btn btn-primary" type="button" @click="handleChangeBannerClicked">Change banner</button>
            </div>
            <div class="col ">
                <div class="item">
                    <img class="img-fluid text-center" :src="banner" alt="">
                </div>
            </div>
        </div>
        
        <div class="modal-backdrop fade show" v-if="modalShow"></div> 
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
        },
        handleActiveClass(item){
            if(this.itemSelected){
                if(this.itemSelected.name == item.name) {
                    return 'active'
                }
            }
        }
    }
}
</script>
<style scoped>

img {
    max-width: 100%;
    height: auto;
}

.item {
    width: 300px;
    min-height: 120px;
    max-height: auto;
    float: left;
    margin: 3px;
    padding: 3px;
}    
</style>