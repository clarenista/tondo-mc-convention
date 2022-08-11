export default {
    init(vue) {
        let zoomBtn = vue.$el.querySelector(".open-zoom-meeting");
        // zoomBtn.style.display = "none";
        this.isAllowed(vue).then(result => {
            if (result) {
                // zoomBtn.style.display = "";
                zoomBtn.addEventListener("click", () => {
                    vue.$sendGuestEventNew(
                        "meeting_hall",
                        "zoom button clicked"
                    );
                    this.isAllowed(vue).then(result => {
                        vue.$store.getters.audio.pause();
                        if (result) {
                            this.openZoomMobile(vue).then(ret => {
                                if (!ret) {
                                    vue.$store.commit("updateIsAllowed", true);
                                }
                            });
                        } else {
                            vue.$store.commit("updateIsAllowed", true);
                        }
                    });
                });
            }
        });

        let zoomBtnRH = vue.$el.querySelector(".open-zoom-residents-hour");
        zoomBtnRH.style.display = "none";
        this.isAllowedRH(vue).then(result => {
            if (result) {
                zoomBtnRH.style.display = "";
                zoomBtnRH.addEventListener("click", () => {
                    this.isAllowedRH(vue).then(result => {
                        vue.$store.getters.audio.pause();
                        if (result) {
                            this.openZoomRH(vue).then(ret => {
                                if (!ret) {
                                    vue.$store.commit("updateIsAllowed", true);
                                }
                            });
                        } else {
                            vue.$store.commit("updateIsAllowed", true);
                        }
                    });
                });
            }
        });

        let zoomBtnBM = vue.$el.querySelector(".open-zoom-bussiness-meeting");
        zoomBtnBM.style.display = "none";
        this.isAllowedBM(vue).then(result => {
            if (result) {
                zoomBtnBM.style.display = "";
                zoomBtnBM.addEventListener("click", () => {
                    this.isAllowedBM(vue).then(result => {
                        vue.$store.getters.audio.pause();
                        if (result) {
                            this.openZoomBM(vue).then(ret => {
                                if (!ret) {
                                    vue.$store.commit("updateIsAllowed", true);
                                }
                            });
                        } else {
                            vue.$store.commit("updateIsAllowed", true);
                        }
                    });
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
        if (data == 0) {
            vue.$store.commit(
                "updateIsNotAllowedMessage",
                "Not yet available."
            );
            return false;
        } else {
            window.open(data, "_blank");
            return true;
        }
        return false;
    },
    async openZoomRH(vue) {
        console.log("RH");
        let { data } = await vue.axios.get(
            `/api/v1/guests/zoom/join/rh?api_token=${localStorage.getItem(
                "access_token"
            )}`
        );
        if (data == 0) {
            vue.$store.commit(
                "updateIsNotAllowedMessage",
                "Bussiness Meeting is exclusive only to PSP Members."
            );
            return false;
        } else {
            vue.$store.commit(
                "updateIsNotAllowedMessage",
                "Welcome to the PSP Residents' Forum."
            );
            window.open(data, "_blank");
            return true;
        }
        return false;
    },
    async openZoomBM(vue) {
        console.log("BM");
        let { data } = await vue.axios.get(
            `/api/v1/guests/zoom/join/bm?api_token=${localStorage.getItem(
                "access_token"
            )}`
        );
        if (data == 0) {
            vue.$store.commit(
                "updateIsNotAllowedMessage",
                "Bussiness Meeting is exclusive only to PSP Members."
            );
            return false;
        } else {
            vue.$store.commit(
                "updateIsNotAllowedMessage",
                "You are attending the PSP Bussiness Meeting."
            );
            window.open(data, "_blank");
            return true;
        }
        return false;
    },
    async isAllowed(vue) {
        let userType = vue.$store.getters.user.classification;
        let { data } = await vue.axios.get(
            `/api/v1/program?api_token=${localStorage.getItem("access_token")}`
        );
        let program = data;
        if (program.enabled == 1) {
            return true;
        }
        vue.$store.commit(
            "updateIsNotAllowedMessage",
            "The session is not available."
        );
        return false;
    },

    async isAllowedRH(vue) {
        let userType = vue.$store.getters.user.classification;
        let { data } = await vue.axios.get(
            `/api/v1/program/rh?api_token=${localStorage.getItem(
                "access_token"
            )}`
        );
        let program = data;
        if (program.enabled == 1) {
            return true;
        }
        vue.$store.commit(
            "updateIsNotAllowedMessage",
            "The session is not available."
        );
        return false;
    },

    async isAllowedBM(vue) {
        let { data } = await vue.axios.get(
            `/api/v1/program/bm?api_token=${localStorage.getItem(
                "access_token"
            )}`
        );
        let program = data;
        if (program.enabled == 1) {
            return true;
        }
        vue.$store.commit(
            "updateIsNotAllowedMessage",
            "The session is not available."
        );
        return false;
    },
    getZoomType(vue) {
        return vue.axios.get(
            `/api/v1/program?api_token=${localStorage.getItem("access_token")}`
        );
    }
};

// let userType = vue.$store.getters.user.classification;
// if (Date.now() < program.start_at_) {
//     vue.$store.commit('updateIsNotAllowedMessage', 'The Meeting has not started yet');
//     return false;
// }
