<template>
<!-- Modal -->
        <div class="modal" :class="value ? 'modal-open': ''" :style="value ? 'display:flex;': ''">
            <div
                class="modal fade"
                :class="value ? 'show' : ''"
                :style="value ? 'display: block;' : ''"
                tabindex="-1" role="dialog" aria-hidden="true">

                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-title container text-uppercase d-flex">
                            <div class="align-middle">
                            <slot name="title"></slot>
                            </div>
                        </div>
                        <div class="modal-body">
                            <slot name="body"></slot>
                        </div>
                        <div class="modal-footer">
                            <slot name="footer"></slot>
                        </div>


                    </div>
                </div>
            </div>

        <div v-if="value" class="modal-backdrop fade show"></div>
        </div>
</template>
<script>
export default {
    props:['value'],
    methods:{
        close(){
            this.$emit('input', !this.value)
        }
    }
}
</script>
<style scoped>
.modal-title {
    background-attachment: fixed;
    object-fit: cover;
    object-fit: scale-down;
    min-height: 106px;
    background: url('/images/modal_header.jpg');
    background-position: center;
    background-repeat: no-repeat;

}
.h1, h1 {
    font-weight: 100;
}

</style>
