export default {
    init(vue) {
        let zoomBtn = vue.$el.querySelector(".open-zoom-meeting");
        zoomBtn.style.display = "none";
        this.isAllowed(vue).then((result) => {
            if (result) {
                zoomBtn.style.display = "";
                zoomBtn.addEventListener("click", () => {
                    this.isAllowed(vue).then((result) => {
                        if (result) {
                            if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
                                this.openZoomMobile(vue);
                            } else {
                                window.location = "/meeting-hall";
                            }
                        } else {
                            zoomBtn.style.display = "none";
                        }
                    });
                });
            }
        })
    },
    async openZoomMobile(vue) {
        let { data } = await vue.axios.get(`/api/v1/guests/zoom/join/mobile?api_token=${localStorage.getItem("access_token")}`);
        window.open(data, "_blank");
    },
    async isAllowed(vue) {
        let { data } = await vue.axios.get(`/api/v1/program?api_token=${localStorage.getItem("access_token")}`);
        let program = data;
        console.log(program);
        if (program.enabled == 1) {
            if (program.type == "all")
                return true;
            if (program.type == "private" && (userType == "Diplomate" || userType == "Fellow"))
                return true;
        }
        return false;
    },
    getZoomType(vue) {
        return vue.axios.get(`/api/v1/program?api_token=${localStorage.getItem("access_token")}`);
    },
};
