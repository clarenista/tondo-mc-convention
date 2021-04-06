<template>
  <div class="iframe-container"></div>
</template>
<script>
export default {
//   mounted() {
//     document.querySelector("#zmmtg-root").style.display = "flex";
//     this.init();
//   },
//   methods: {
//     async init() {
//       await this.zoomMtgInit();
//       this.getJoinConfig().then((result) => {
//         this.zoomJoin(result.data);
//       });
//     },
//     zoomMtgInit() {
//       this.ZoomMtg.setZoomJSLib(
//         "https://dmogdx0jrul3u.cloudfront.net/1.9.1/lib",
//         "/av"
//       );
//       this.ZoomMtg.preLoadWasm();
//       this.ZoomMtg.prepareWebSDK();
//     },
//     getJoinConfig() {
//       return axios.get("/api/v1/guests/zoom/join/config?api_token=123123");
//     },
//     zoomJoin(config) {
//       this.ZoomMtg.init({
//         debug: false,
//         leaveUrl: "http://psp.com/",
//         success: () => {
//           this.ZoomMtg.join(config);
//         },
//       });
//     },
//   },
};
</script>
