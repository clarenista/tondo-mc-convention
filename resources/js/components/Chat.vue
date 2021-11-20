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
        data() {
            return {
                modal: {
                    show: false,
                },
                messageData: [],
                collapsed: false,
                channel: null,
                rooms: [],
                currentRoom: null,
                messages: [],
                newMessage: null,
            }
        },
        computed: {
           username() {
                return "client"
           }
        },
        mounted() {
            this.init()
        },
        methods: {
            init(){
                this.getMessages()
            },
            async getMessages(){
                try{
                    const {data} = await axios.get('/api/v1/chat/rooms/1/messages?api_token='+localStorage.getItem('access_token'));
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
                    const {data} = await axios.post('/api/v1/chat/rooms/1/messages?api_token='+localStorage.getItem('access_token'), fd)
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