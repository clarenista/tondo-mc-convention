export default {
    init(vue) {
        let zoomBtn = vue.$el.querySelector(".open-zoom-meeting");
        if (zoomBtn) {
            zoomBtn.addEventListener("click", () => {
                if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
                    this.openZoomMobile(vue);
                } else {
                    window.location = '/meeting-hall';
                }
            });
        }
    },
    async openZoomMobile(vue) {
        let { data } = await vue.axios.get(`/api/v1/guests/zoom/join/mobile?api_token=${localStorage.getItem('access_token')}`);
        window.open(data, "_blank");
    }
}
