export default {
    init(vue) {
        let zoomBtn = vue.$el.querySelector(".open-zoom-meeting");
        if (zoomBtn) {
            zoomBtn.addEventListener("click", () => {
                vue.$router.push("zoom-meeting");
            });
        }
    }
}
