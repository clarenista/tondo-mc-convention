export default {
    init(vue) {
        let userType = vue.$store.getters.user.classification;
        let zoomBtn = vue.$el.querySelector(".open-zoom-meeting");
        zoomBtn.style.display = "none";
        this.getZoomType(vue).then((result) => {
            let program = result.data;
            if (program.enabled == 1 || (program.type == 'all' && userType == 'Diplomate')) {
                zoomBtn.style.display = "";
                zoomBtn.addEventListener("click", () => {
                    if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
                        this.openZoomMobile(vue);
                    } else {
                        window.location = '/meeting-hall';
                    }
                });
            }
        });
    },
    async openZoomMobile(vue) {
        let { data } = await vue.axios.get(`/api/v1/guests/zoom/join/mobile?api_token=${localStorage.getItem('access_token')}`);
        window.open(data, "_blank");
    },
    getZoomType(vue) {
        return vue.axios.get(`/api/v1/program?api_token=${localStorage.getItem('access_token')}`);
    }
}
