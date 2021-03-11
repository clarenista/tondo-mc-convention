<template>
    <div class="">
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

    <ul class="nav nav-tabs">
        <li class="nav-item" 
            v-for="(item, index) in navs" 
            :key="index"
            
            
        >
            <a 
                style="cursor:pointer;"
                class="nav-link" 
                :class="navSelected == item.text ? 'active' : '' " 
                data-toggle="tab"
                @click="handleSelectNav(item.text)"
            >
                {{item.text}}
            </a>
        </li>
        
    </ul>
       

        <!-- Assets 
        -->
        <assets v-if="navSelected == 'Assets'"></assets>

        <!-- Banner 
        -->
        <banner v-if="navSelected == 'Banner'"></banner>

        <!-- Gallery 
        -->
        <gallery v-if="navSelected == 'Gallery'"></gallery>

        <!-- External Links 
        -->
        <links v-if="navSelected == 'External Links'"></links>

        </div>                
    </div>
</template>

<script>
    import Assets from './Assets.vue';
    import Banner from './Banner.vue';
    import Links from './Links.vue';

    import Gallery from './Gallery.vue';

    export default {
        components:{
            'assets': Assets,
            'banner': Banner,
            'links': Links,
            'gallery' : Gallery,
        },
        mounted() {
        },
        data(){
            
            return{
                navs:[
                    {text: 'Assets', isActive: false},
                    {text: 'Banner', isActive: false},
                    {text: 'Gallery', isActive: false},
                    {text: 'Brochures', isActive: false},
                    {text: 'External Links', isActive: false},
                    {text: 'Contact', isActive: false},
                    {text: 'Quiz', isActive: false},
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