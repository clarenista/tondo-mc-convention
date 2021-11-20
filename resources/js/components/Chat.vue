<template>
    <div id="chat">
        <button class="btn btn-primary c-chat-widget-button" ref="button" @click.prevent="toggleModal()">C</button>
        <div class="c-chat-widget" ref="modal" :class="{show: modal.show}">
            <div class="c-chat-widget-dialog">
                <div class="c-chat-widget-content">
                    <div class="c-chat-widget-header">Chat With Us Admin</div>
                    <div class="c-chat-widget-body">
                        <div class="c-chat-widget-bubble c-chat-widget-bubble-left row" v-for="(msg, index) in messages" :key="index">
                            <div class="c-chat-widget-bubble-icon">{{msg.user.first_name}}</div>
                            <div class="c-chat-widget-bubble-text">
                              {{msg.message}}
                            </div>
                        </div>
                    </div>
                    <div class="c-chat-widget-footer">
                        <form @submit.prevent="sendNewMessage">
                            <input type="text" name="" id="" cols="30" v-model="newMessage" rows="10" class="c-chat-widget-text" placeholder="Enter Text Here" />
                        <button class="btn btn-block btn-success">Send Message</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        props: ['sponsor_id'],
        data() {
            return {
                modal: {
                    show: false,
                },
                messageData: [],
                collapsed: false,
                channel: null,
                rooms: [],
                room: null,
                messages: [],
                newMessage: null,
            }
        },
        computed: {
           username() {
                return "client"
           },
           sponsorId(){
               return this.sponsor_id
           }
        },
        mounted() {
            this.init()
        },
        methods: {
            init(){
                this.getRoom()
                this.getMessages()
            },
            async getRoom(){
                const fd = new FormData()
                fd.append('sponsor_id', this.sponsorId)
                try{
                    const {data} = await axios.post('/api/v1/chat/get-room?api_token='+localStorage.getItem('access_token'), fd)
                    this.room = data
                }catch({response}){
                    alert(response.statusText)
                }
            },
            async getMessages(){
                try{
                    const {data} = await axios.get('/api/v1/chat/rooms/'+this.room.id+'/messages?api_token='+localStorage.getItem('access_token'));
                    this.messages = data
                    console.log(data)
                }catch({response}){
                    alert(response.statusText)
                }
            },
            async sendNewMessage(){
                const fd = new FormData()
                fd.append('newMessage', this.newMessage)
                try{
                    const {data} = await axios.post('/api/v1/chat/rooms/'+this.room.id+'/messages?api_token='+localStorage.getItem('access_token'), fd)
                    this.messages.push(data)
                    this.newMessage = ''

                }catch({response}){
                    alert(response.statusText)
                }
            },
            toggleModal() {
                this.modal.show = !this.modal.show;
            },
            showModal() {
                this.modal.show = true;
            },
            hideModal() {
                this.modal.show = false;
            },
        }
    }
</script>