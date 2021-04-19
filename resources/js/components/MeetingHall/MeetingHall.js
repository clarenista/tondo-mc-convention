export default {
    init(vue) {
        let userType = vue.$store.getters.user.classification;
        let zoomBtn = vue.$el.querySelector(".open-zoom-meeting");
        zoomBtn.style.display = "none";
        this.getZoomType(vue).then((result) => {
            let program = result.data;
            console.log(program.enabled, program.type, userType);
            if (
                program.enabled == 1 &&
                (program.type == "all" ||
                    (program.type == "private" && userType == "Diplomate"))
            ) {
                zoomBtn.style.display = "";
                zoomBtn.addEventListener("click", () => {
                    if (
                        program.enabled == 1 &&
                        (program.type == "all" ||
                            (program.type == "private" &&
                                userType == "Diplomate"))
                    ) {
                        if (
                            /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(
                                navigator.userAgent
                            )
                        ) {
                            this.openZoomMobile(vue);
                        } else {
                            window.location = "/meeting-hall";
                        }
                    } else {
                        zoomBtn.style.display = "none";
                    }
                });
            }
        });
    },
    async openZoomMobile(vue) {
        let { data } = await vue.axios.get(
            `/api/v1/guests/zoom/join/mobile?api_token=${localStorage.getItem(
                "access_token"
            )}`
        );
        window.open(data, "_blank");
    },
    getZoomType(vue) {
        return vue.axios.get(
            `/api/v1/program?api_token=${localStorage.getItem("access_token")}`
        );
    },
};
