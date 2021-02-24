<template>
    <div class="container">
        <div class="row mt-3" v-if="!isUpload">
            <div class="col-3">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="input-3">Records:</label>
                            <select v-model="form.size" id="input-3" class="custom-select" name="">
                                <option v-for="(item, index) in sizes" :key="index">{{item}}</option>
                            </select>
                            <label for="input-3">Type:</label>
                            <select v-model="form.type" id="input-3" class="custom-select" name="">
                                <option v-for="(item, index) in types" :key="index">{{item}}</option>
                            </select>

                        </div>
                        <button class="btn btn-primary btn-sm float-right" @click="handleFilter">Filter</button>
                        <br>
                        <button class="btn btn-secondary btn-sm" @click="handleUploadAssetPage">Upload new asset</button>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="row">
                    <div class="col-3" v-for="(item, index) in filteredAssets" :key="index">
                        <div class="card m-1">
                            <div class="card-body" v-if="item.type == 'image'">
                                <img :src="item.path" class="img-fluid">
                            </div>
                            <div class="card-body" v-if="item.type == 'pdf'">
                                <a :href="item.path" target="_blank" >{{item.name}}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" v-else>
            <div class="col">
                <div class="panel panel-default">
                    <div class="panel-heading" style="cursor:pointer;" @click="isUpload =false"><strong>Back to list</strong></div>
                    <div class="panel-body">

                    <!-- Standar Form -->
                    <h4>Upload new asset</h4>
                    <p>Select files from your computer</p>
                    <form method="post" enctype="multipart/form-data" id="js-upload-form">
                        <div class="form-inline">
                        <div class="form-group">
                            <input type="file" name="files[]" id="js-upload-files" multiple>
                        </div>
                        <button type="submit" class="btn btn-sm btn-primary" id="js-upload-submit">Upload files</button>
                        </div>
                    </form>

                    <!-- Progress Bar
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                        <span class="sr-only">60% Complete</span>
                        </div>
                    </div>
                    -->

                    <!-- Upload Finished 
                    <div class="js-upload-finished">
                        <h3>Processed files</h3>
                        <div class="list-group">
                        <a href="#" class="list-group-item list-group-item-success"><span class="badge alert-success pull-right">Success</span>image-01.jpg</a>
                        <a href="#" class="list-group-item list-group-item-success"><span class="badge alert-success pull-right">Success</span>image-02.jpg</a>
                        </div>
                    </div>
                    -->
                    </div>
                </div>           
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            this.handleFilter()
        },
        data(){
            
            return{

                assets:[
                    {type: 'image', name: 'image 1', path: 'https://via.placeholder.com/300'},
                    {type: 'image', name: 'image 2', path: 'https://via.placeholder.com/300'},
                    {type: 'image', name: 'image 3', path: 'https://via.placeholder.com/300'},
                    {type: 'image', name: 'image 4', path: 'https://via.placeholder.com/300'},
                    {type: 'image', name: 'image 5', path: 'https://via.placeholder.com/300'},
                    {type: 'image', name: 'image 6', path: 'https://via.placeholder.com/300'},
                    {type: 'pdf', name: 'pdf 1', path: 'https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf'},
                    {type: 'pdf', name: 'pdf 2', path: 'https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf'},
                    {type: 'pdf', name: 'pdf 3', path: 'https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf'},
                    {type: 'pdf', name: 'pdf 4', path: 'https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf'},
                    {type: 'pdf', name: 'pdf 5', path: 'https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf'},
                    {type: 'pdf', name: 'pdf 6', path: 'https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf'},
                    {type: 'pdf', name: 'pdf 7', path: 'https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf'},
                ],
                filteredAssets : [],
                sizes: ['5', '10', '15'],
                form: {
                    size:'5',
                    type:'image'
                },
                types:['image','pdf','audio'],
                isUpload: false
            }
        } ,
        watch:{
            
        },

        methods:{
            
            handleFilter(){
                this.filteredAssets = this.$store.getters.assets
                let formType = this.form.type
                let filteredAssets = _.map(this.$store.getters.assets, function(o) {
                    if (o.type == formType) return o;
                });


                // Remove undefines from the array
                this.filteredAssets = _.without(filteredAssets, undefined)                
            },
            handleUploadAssetPage(){
                this.isUpload = true
            }
        }

    }
</script>

<style>

</style>