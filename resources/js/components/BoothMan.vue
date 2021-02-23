<template>
    <div class="container">
        <div>

        <!--
        <b-nav tabs align="center">
            <b-nav-item 
                v-for="(item, index) in navs" 
                :key="index"
                :active="navSelected == item.text"
                @click="handleSelectNav(item.text)"
            >
            {{item.text}}</b-nav-item>
        </b-nav>
        -->

        <!-- Assets 
        <assets></assets>
        -->

        <!-- Banner 
        <banner></banner>
        -->

        <!-- External Links 
        -->
        <links></links>

        </div>                
    </div>
</template>

<script>
    import Assets from './Assets.vue';
    import Banner from './Banner.vue';
    import Links from './Links.vue';
    export default {
        components:{
            'assets': Assets,
            'banner': Banner,
            'links': Links,
        },
        mounted() {
        },
        data(){
            
            return{
                navs:[
                    {text: 'Assets', isActive: false},
                    {text: 'Banner', isActive: false},
                    {text: 'Gallery', isActive: false},
                ],
                navSelected: 'Assets',

            }
        } ,
        watch:{
        },

        methods:{
            handleSelectNav(nav){
                this.navSelected = nav
                // for(let i in this.navs){
                //     if(this.navs[i] == nav){
                //         this.navs[i].isActive = true
                //     }else{
                //         this.navs[i].isActive = false
                //     }
                // }
            },
        }

    }
</script>

<style>
/* layout.css Style */
.upload-drop-zone {
  height: 200px;
  border-width: 2px;
  margin-bottom: 20px;
}

/* skin.css Style*/
.upload-drop-zone {
  color: #ccc;
  border-style: dashed;
  border-color: #ccc;
  line-height: 200px;
  text-align: center
}
.upload-drop-zone.drop {
  color: #222;
  border-color: #222;
}
</style>