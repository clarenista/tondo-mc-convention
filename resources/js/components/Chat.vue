<template>
    <div id="chat">
        <button class="btn btn-primary c-chat-widget-button" ref="button" @click.prevent="toggleModal()"><i class="fa fa-comments-o fa-lg" aria-hidden="true"></i></button>
        <div class="c-chat-widget" ref="modal" :class="{show: modal.show}">
            <div class="c-chat-widget-dialog">
                <div class="c-chat-widget-content">
                    <div class="c-chat-widget-header">Chat With Us</div>
                    <div class="c-chat-widget-body" ref="container">
                        <div v-for="(msg, index) in messages" :key="index" class="mb-2" >
                            <div class="c-chat-widget-bubble row" :class="msg.sender_id === userDetails.id ? 'c-chat-widget-bubble-right' : 'c-chat-widget-bubble-left'">
                                <div class="c-chat-widget-bubble-text">
                                {{msg.message}}
                                </div>
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
        props: ['sponsor_id', 'user_details'],
        data() {
            return {
                modal: {
                    show: false,
                },
                messageData: [],
                collapsed: false,
                channel: null,
                rooms: null,
                room: {
                    id: null
                },
                messages: [],
                newMessage: null,
                userDetails: []
            }
        },
        computed: {
           username() {
                return "client"
           },
           sponsorId(){
               return this.sponsor_id
           },
        },
        mounted() {

            this.init()
            this.scrollToEnd();	
        },
        methods: {
            async getUserInfo(){
                try{
                    let {data} = await axios.get('/api/v1/user?api_token='+localStorage.getItem('access_token'));
                    this.userDetails = data
                    this.getMessages()
                    this.connect()
                }catch({response}){
                    alert(response.statusText)
                }
            },
            init(){
                // this.getRoom()
                this.getUserInfo()
                // this.getMessages()
            },
            connect(){
                let vm = this
                vm.room.id = this.sponsorId+"-"+this.userDetails.id
                this.getMessages();
                window.Echo.channel("chat."+vm.room.id)
                .listen('NewChatMessage', ({chatMessage}) =>{
                    if(!this.modal.show){
                        this.modal.show = true
                    }
                    this.messages.push({
                        'sender_id'     : chatMessage.sender_id,
                        'chat_room_id'     : chatMessage.chat_room_id,
                        'message'     : chatMessage.message,
                    })
                    this.scrollToEnd();	
                })
            },
            async getRoom(){
                const fd = new FormData()
                fd.append('sponsor_id', this.sponsorId)
                try{
                    const {data} = await axios.post('/api/v1/chat/get-room?api_token='+localStorage.getItem('access_token'), fd)
                    this.room = data
                    this.connect()
                }catch({response}){
                    alert(response.statusText)
                }
            },
            async getMessages(){
                this.room.id = this.sponsorId+"-"+this.userDetails.id
                try{
                    const {data} = await axios.get('/api/v1/chat/rooms/'+this.room.id+'/messages?api_token='+localStorage.getItem('access_token'));
                    this.messages = data
                    // this.connect()
                    // console.log(data)
                }catch({response}){
                    alert(response.statusText)
                }
            },
            async sendNewMessage(){
                this.room.id = this.sponsorId+"-"+this.userDetails.id
                const fd = new FormData()
                fd.append('newMessage', this.newMessage)
                try{
                    const {data} = await axios.post('/api/v1/chat/rooms/'+this.room.id+'/messages?api_token='+localStorage.getItem('access_token'), fd)
                    this.scrollToEnd();	
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
            scrollToEnd () {
                var content = this.$refs.container;
                content.scrollTop = content.scrollHeight;
            }
        },
        updated () {
            // This will be called when the component updates
            // try toggling a todo
            this.scrollToEnd(); 
        },
        
            
        
    }
</script>
