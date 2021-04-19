<script>
export default {
    methods: {
        async $sendGuestEvent(eventType, label, booth = null){
            // category: lobby,
            // label: click Astra Zeneca Booth
            const fd = new FormData()
            fd.append('category', booth != null ? booth.name : this.$store.getters.currentScene)
            fd.append('label', eventType+" "+label)

            let {data} = await axios.post('/api/v1/guests/event/push?api_token='+localStorage.getItem('access_token'), fd);
        }
    }        
}
</script>