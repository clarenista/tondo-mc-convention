import axios from 'axios';
export default {
    init(vue) {
        let zoomBtn = vue.$el.querySelector(".open-zoom-meeting");
        if (zoomBtn) {
            zoomBtn.addEventListener("click", () => {
                if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
                    this.openZoomMobile();
                } else {
                    window.location = '/meeting-hall';
                }
            });
        }
    },
    leaveZoom(vue) {
        document.querySelector("#zmmtg-root").style.display = "none";
        vue.ZoomMtg.leaveMeeting({})
    },
    async openZoomMobile() {
        let { data } = await axios.get('/api/v1/guests/zoom/join/mobile?api_token=123123');
        window.open(data, "_blank");
    }
}
