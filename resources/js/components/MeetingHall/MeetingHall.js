export default {
    init(vue) {

        let zoomBtn = vue.$el.querySelector(".open-zoom-meeting");
        zoomBtn.style.display = "none";
        this.isAllowed(vue).then((result) => {
            if (result) {
                zoomBtn.style.display = "";
                zoomBtn.addEventListener("click", () => {
                    this.isAllowed(vue).then((result) => {
                        vue.$store.getters.audio.pause();
                        if (result) {
                            this.openZoomMobile(vue).then((ret) => {
                                if (!ret) {
                                    vue.$store.commit('updateIsAllowed', true);
                                }
                            });
                        } else {
                            vue.$store.commit('updateIsAllowed', true);
                        }
                    });
                });
            }
        });

        let zoomBtnRH = vue.$el.querySelector(".open-zoom-residents-hour");
        zoomBtnRH.style.display = "none";
        this.isAllowedRH(vue).then((result) => {
            if (result) {
                zoomBtnRH.style.display = "";
                zoomBtnRH.addEventListener("click", () => {
                    this.isAllowed(vue).then((result) => {
                        vue.$store.getters.audio.pause();
                        if (result) {
                            this.openZoomRH(vue).then((ret) => {
                                if (!ret) {
                                    vue.$store.commit('updateIsAllowed', true);
                                }
                            });
                        } else {
                            vue.$store.commit('updateIsAllowed', true);
                        }
                    });
                });
            }
        })

        let zoomBtnBM = vue.$el.querySelector(".open-zoom-bussiness-meeting");
        zoomBtnBM.style.display = "none";
        this.isAllowedBM(vue).then((result) => {
            if (result) {
                zoomBtnBM.style.display = "";
                zoomBtnBM.addEventListener("click", () => {
                    this.isAllowed(vue).then((result) => {
                        vue.$store.getters.audio.pause();
                        if (result) {
                            this.openZoomBM(vue).then((ret) => {
                                if (!ret) {
                                    vue.$store.commit('updateIsAllowed', true);
                                }
                            });
                        } else {
                            vue.$store.commit('updateIsAllowed', true);
                        }
                    });
                });
            }
        })
    },
    async openZoomMobile(vue) {
        console.log('MAIN');
        let { data } = await vue.axios.get(`/api/v1/guests/zoom/join/mobile?api_token=${localStorage.getItem("access_token")}`);
        if (data == 0) {
            vue.$store.commit('updateIsNotAllowedMessage', "PSP members' fellowship night going on.")
            return false;
        } else {
            window.open(data, "_blank");
            return true;
        }
        return false;
    },
    async openZoomRH(vue) {
        console.log('RH');
        let { data } = await vue.axios.get(`/api/v1/guests/zoom/join/rh?api_token=${localStorage.getItem("access_token")}`);
        if (data == 0) {
            vue.$store.commit('updateIsNotAllowedMessage', "Residents' Hour going on.")
            return false;
        } else {
            window.open(data, "_blank");
            return true;
        }
        return false;
    },
    async openZoomBM(vue) {
        console.log('BM');
        let { data } = await vue.axios.get(`/api/v1/guests/zoom/join/bm?api_token=${localStorage.getItem("access_token")}`);
        if (data == 0) {
            vue.$store.commit('updateIsNotAllowedMessage', "Bussiness Meeting going on.")
            return false;
        } else {
            window.open(data, "_blank");
            return true;
        }
        return false;
    },
    async isAllowed(vue) {
        let userType = vue.$store.getters.user.classification;
        let { data } = await vue.axios.get(`/api/v1/program?api_token=${localStorage.getItem("access_token")}`);
        let program = data;
        if (program.enabled == 1) {
            return true;
        }
        vue.$store.commit('updateIsNotAllowedMessage', 'The session is not available.');
        return false;
    },

    async isAllowedRH(vue) {
        let userType = vue.$store.getters.user.classification;
        let { data } = await vue.axios.get(`/api/v1/program/rh?api_token=${localStorage.getItem("access_token")}`);
        let program = data;
        if (program.enabled == 1) {
            return true;
        }
        vue.$store.commit('updateIsNotAllowedMessage', 'The session is not available.');
        return false;
    },

    async isAllowedBM(vue) {
        let { data } = await vue.axios.get(`/api/v1/program/bm?api_token=${localStorage.getItem("access_token")}`);
        let program = data;
        if (program.enabled == 1) {
            return true;
        }
        vue.$store.commit('updateIsNotAllowedMessage', 'The session is not available.');
        return false;
    },
    getZoomType(vue) {
        return vue.axios.get(`/api/v1/program?api_token=${localStorage.getItem("access_token")}`);
    },
};



// let userType = vue.$store.getters.user.classification;
// if (Date.now() < program.start_at_) {
//     vue.$store.commit('updateIsNotAllowedMessage', 'The Meeting has not started yet');
//     return false;
// }
