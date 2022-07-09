import Vue from "vue/dist/vue";
import Vuex from "vuex";

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        isWelcomed: true,
        roles: [
            { value: "ADMIN", key: "admin" },
            { value: "SPONSOR", key: "sponsor" }
        ],
        booths: null,
        user: null,
        permissions: null,
        api_token: null,
        users: null,
        currentScene: "lobby",
        bgmStart: true,
        bgm: null,
        audio: new Audio("/bgm/lobby.mp3"),
        booth_details: null,
        announcement: null,
        isNotAllowed: null,
        isNotAllowedMessage: "",
        scene_hotSpots: [
            {
                scene: "landing",
                type: "scene",
                pitch: -7.3,
                yaw: 37.3,
                cssClass: "custom-hotspot arrow_left",
                sceneId: "main_entrance"
            },
            {
                scene: "main_entrance",
                type: "scene",
                pitch: -7.78,
                yaw: -4.33,
                cssClass: "custom-hotspot enter",
                sceneId: "lobby"
            },
            {
                scene: "main_entrance",
                type: "scene",
                pitch: -7.78,
                yaw: 3.89,
                cssClass: "custom-hotspot enter",
                sceneId: "lobby"
            },

            // LOBBY HOTSPOTS
            {
                scene: "lobby",
                type: "scene",
                pitch: 2.42,
                yaw: 22.07,
                cssClass: "custom-hotspot arrow_right",
                sceneId: "meeting_hall", 
                text: "Go to Meeting Hall"
            },
            // {
            //     scene: "lobby",
            //     type: "info",
            //     pitch: 2.45,
            //     yaw: -162.28
            //     // text: "PSP cast"
            // },

            // *HOTSPOT FOR EXHIBIT HALL
            {
                scene: "lobby",
                type: "scene",
                pitch: 2.42,
                yaw: -22.43,
                cssClass: "custom-hotspot arrow_left",
                sceneId: "hall_a",
                text: "Go to Exhibit Hall"
            },

            // {
            //     scene: "lobby",
            //     type: "scene",
            //     pitch: 12.08,
            //     yaw: -18.84,
            //     cssClass: "custom-hotspot hall_b",
            //     sceneId: "hall_b"
            // },

            // {
            //     scene: "lobby",
            //     type: "scene",
            //     pitch: 12.58,
            //     yaw: -6.25,
            //     cssClass: "custom-hotspot hall_c",
            //     sceneId: "hall_c"
            // },

            // {
            //     scene: "lobby",
            //     type: "scene",
            //     pitch: 12.65,
            //     yaw: 7.15,
            //     cssClass: "custom-hotspot hall_d",
            //     sceneId: "hall_d"
            // },

            // {
            //     // microscope
            //     scene: "lobby",
            //     type: "info",
            //     pitch: 0.73,
            //     yaw: -26.8,
            // },

            // {
            //     // microscope
            //     scene: "lobby",
            //     type: "scene",
            //     pitch: -0.45,
            //     yaw: -24.19,
            //     cssClass: "custom-hotspot arrow_left",
            //     sceneId: "microscope",
            // },

            // {
            //     // go to lobby
            //     scene: "microscope",
            //     type: "scene",
            //     pitch: -10.03,
            //     yaw: -176.2,
            //     cssClass: "custom-hotspot enter",
            //     sceneId: "lobby",
            //     text: "Back to lobby"
            // },

            // {
            //     // going to bar area
            //     scene: "lobby",
            //     type: "scene",
            //     pitch: -4.24,
            //     yaw: 39.11,
            //     cssClass: "custom-hotspot arrow_right",
            //     sceneId: "bar",
            //     text: "Bar Area"
            // },

            // {
            //     // going to PSP monument
            //     scene: "lobby",
            //     type: "scene",
            //     pitch: -5.27,
            //     yaw: -173.28,
            //     cssClass: "custom-hotspot arrow_right",
            //     sceneId: "psp_monument",
            // },

            // {
            //     // going to Pool area
            //     scene: "lobby",
            //     type: "scene",
            //     pitch: 10.71,
            //     yaw: -38.24,
            //     cssClass: "custom-hotspot arrow_left",
            //     sceneId: "pool_area",
            //     text: "Go to Pool Area"
            // },

            // BAR AREA
            {
                scene: "bar",
                type: "scene",
                pitch: -11.88,
                yaw: 142.43,
                cssClass: "custom-hotspot arrow_left",
                sceneId: "piano",
                text: "Go to Piano Area"
            },
            {
                scene: "bar",
                type: "scene",
                pitch: -7.23,
                yaw: -135.11,
                cssClass: "custom-hotspot enter",
                sceneId: "lobby",
                text: "Back to lobby"
            },
            // PIANO AREA
            {
                scene: "piano",
                type: "scene",
                pitch: -8.64,
                yaw: -56.93,
                cssClass: "custom-hotspot arrow_right",
                sceneId: "bar",
                text: "Go to Bar area"
            },
            // psp-monument AREA
            // {
            //     scene: "psp_monument",
            //     type: "scene",
            //     pitch: -5.15,
            //     yaw: 96.58,
            //     cssClass: "custom-hotspot enter",
            //     sceneId: "lobby",
            //     text: "Back to lobby"
            // },

            // HALL A HOTSPOT
            // {
            //     scene: "hall_a",
            //     type: "scene",
            //     pitch: 8.68,
            //     yaw: -14.92,
            //     cssClass: "custom-hotspot hall_b",
            //     sceneId: "hall_b"
            // },

            // {
            //     scene: "hall_a",
            //     type: "scene",
            //     pitch: 8.56,
            //     yaw: 15.33,
            //     cssClass: "custom-hotspot hall_c",
            //     sceneId: "hall_c"
            // },

            // {
            //     scene: "hall_a",
            //     type: "scene",
            //     pitch: 9.61,
            //     yaw: 0,
            //     cssClass: "custom-hotspot enter",
            //     sceneId: "meeting_hall"
            // },
            // {
            //     scene: "hall_a",
            //     type: "scene",
            //     pitch: 7.32,
            //     yaw: 36.45,
            //     cssClass: "custom-hotspot hall_d",
            //     sceneId: "hall_d"
            // },

            {
                scene: "hall_a",
                type: "scene",
                pitch: -1.52,
                yaw: -0.1,
                cssClass: "custom-hotspot enter",
                sceneId: "lobby"
            },

            // HALL B HOTSPOTS
            // {
            //     scene: "hall_b",
            //     type: "scene",
            //     pitch: 7.04,
            //     yaw: -36.73,
            //     cssClass: "custom-hotspot hall_a",
            //     sceneId: "hall_a"
            // },
            // {
            //     scene: "hall_b",
            //     type: "scene",
            //     pitch: 8.56,
            //     yaw: 15.33,
            //     cssClass: "custom-hotspot hall_c",
            //     sceneId: "hall_c"
            // },
            // {
            //     scene: "hall_b",
            //     type: "scene",
            //     pitch: 9.61,
            //     yaw: 0,
            //     cssClass: "custom-hotspot enter",
            //     sceneId: "meeting_hall"
            // },
            // {
            //     scene: "hall_b",
            //     type: "scene",
            //     pitch: 7.32,
            //     yaw: 36.45,
            //     cssClass: "custom-hotspot hall_d",
            //     sceneId: "hall_d"
            // },

            // {
            //     scene: "hall_b",
            //     type: "scene",
            //     pitch: -1.52,
            //     yaw: -0.1,
            //     cssClass: "custom-hotspot enter",
            //     sceneId: "lobby"
            // },

            // {
            //     scene: "hall",
            //     type: "scene",
            //     pitch: -22.8,
            //     yaw: 34.1,
            //     cssClass: "custom-hotspot hall_c",
            //     sceneId: "hall_c"
            // },

            // HALL C HOTSPOTS
            // {
            //     scene: "hall_c",
            //     type: "scene",
            //     pitch: 7.04,
            //     yaw: -36.73,
            //     cssClass: "custom-hotspot hall_a",
            //     sceneId: "hall_a"
            // },
            // {
            //     scene: "hall_c",
            //     type: "scene",
            //     pitch: 8.68,
            //     yaw: -14.92,
            //     cssClass: "custom-hotspot hall_b",
            //     sceneId: "hall_b"
            // },
            // {
            //     scene: "hall_c",
            //     type: "scene",
            //     pitch: 9.61,
            //     yaw: 0,
            //     cssClass: "custom-hotspot enter",
            //     sceneId: "meeting_hall"
            // },
            // {
            //     scene: "hall_c",
            //     type: "scene",
            //     pitch: 7.32,
            //     yaw: 36.45,
            //     cssClass: "custom-hotspot hall_d",
            //     sceneId: "hall_d"
            // },

            // {
            //     scene: "hall_c",
            //     type: "scene",
            //     pitch: -1.52,
            //     yaw: -0.1,
            //     cssClass: "custom-hotspot enter",
            //     sceneId: "lobby"
            // },

            // {
            //     scene: "hall",
            //     type: "scene",
            //     pitch: -22.8,
            //     yaw: -34.1,
            //     cssClass: "custom-hotspot hall_b",
            //     sceneId: "hall_b"
            // },

            // HALL D HOTSPOTS
            // {
            //     scene: "hall_d",
            //     type: "scene",
            //     pitch: 7.04,
            //     yaw: -36.73,
            //     cssClass: "custom-hotspot hall_a",
            //     sceneId: "hall_a"
            // },
            // {
            //     scene: "hall_d",
            //     type: "scene",
            //     pitch: 8.68,
            //     yaw: -14.92,
            //     cssClass: "custom-hotspot hall_b",
            //     sceneId: "hall_b"
            // },
            // {
            //     scene: "hall_d",
            //     type: "scene",
            //     pitch: 9.61,
            //     yaw: 0,
            //     cssClass: "custom-hotspot enter",
            //     sceneId: "meeting_hall"
            // },
            // {
            //     scene: "hall_d",
            //     type: "scene",
            //     pitch: 8.56,
            //     yaw: 15.33,
            //     cssClass: "custom-hotspot hall_c",
            //     sceneId: "hall_c"
            // },

            // {
            //     scene: "hall_d",
            //     type: "scene",
            //     pitch: -1.52,
            //     yaw: -0.1,
            //     cssClass: "custom-hotspot enter",
            //     sceneId: "lobby"
            // },

            // MEETING HALL HOTSPOTS
            {
                scene: "meeting_hall",
                pitch: 2.71,
                yaw: -49.66,
                type: "scene",
                cssClass: "custom-hotspot enter",
                sceneId: "lobby"
            },
            {
                scene: "meeting_hall",
                pitch: 2.26,
                yaw: 49.62,
                type: "scene",
                cssClass: "custom-hotspot enter",
                sceneId: "lobby"
            },

            {
                scene: "meeting_hall",
                pitch: 7.49,
                yaw: -15.54,
                type: "scene",
                cssClass: "custom-hotspot zoom open-zoom-residents-hour",
                text: "Residents Hour"
            },

            {
                scene: "meeting_hall",
                pitch: 7.49,
                yaw: 13.71,
                type: "scene",
                cssClass: "custom-hotspot zoom open-zoom-bussiness-meeting",
                text: "Business Meeting"
            },

            // {
            //     scene: "hall_a",
            //     type: "scene",
            //     pitch: -3.7,
            //     yaw: -0.1,
            //     cssClass: "custom-hotspot enter",
            //     sceneId: "lobby"
            // },

            // {
            //     scene: "hall_c",
            //     type: "scene",

            //     pitch: -3.7,
            //     yaw: -0.1,
            //     cssClass: "custom-hotspot hall_d",
            //     sceneId: "hall_d"
            // },
            // {
            //     scene: "hall_c",
            //     type: "scene",
            //     pitch: 8.7,
            //     yaw: -181.0,
            //     cssClass: "custom-hotspot arrow_left",
            //     sceneId: "secondf_outside"
            // },
            // {
            //     scene: "hall_c",
            //     type: "scene",
            //     pitch: 15.0,
            //     yaw: 4.1,
            //     cssClass: "custom-hotspot arrow_right",
            //     sceneId: "secondf_meeting_hall"
            // },

            // {
            //     scene: "hall_c",
            //     type: "info",
            //     pitch: 12.09,
            //     yaw: 174.28,
            //     text: "Dr. Nelson T. Geraldino's Orchid Collection"
            // },

            // {
            //     scene: "hall",
            //     type: "scene",
            //     pitch: -22.8,
            //     yaw: -34.1,
            //     cssClass: "custom-hotspot hall_b",
            //     sceneId: "hall_b"
            // },
            // {
            //     scene: "hall_b",
            //     type: "scene",
            //     pitch: -3.7,
            //     yaw: -180.1,
            //     cssClass: "custom-hotspot hall_a",
            //     sceneId: "hall_a"
            // },
            // {
            //     scene: "hall_b",
            //     type: "scene",
            //     pitch: -0.38,
            //     yaw: -28.44,
            //     cssClass: "custom-hotspot enter",
            //     sceneId: "lobby"
            // },
            // {
            //     scene: "hall_b",
            //     type: "scene",
            //     pitch: -0.55,
            //     yaw: -4.15,
            //     cssClass: "custom-hotspot enter",
            //     sceneId: "lobby"
            // },
            // {
            //     scene: "hall_b",
            //     type: "info",
            //     pitch: 12.6,
            //     yaw: -17.6,
            //     text: "Dr. Nelson T. Geraldino's Orchid Collection"
            // },
            // {
            //     scene: "hall_b",
            //     type: "scene",
            //     pitch: 19.0,
            //     yaw: 173.9,
            //     cssClass: "custom-hotspot arrow_left",
            //     sceneId: "pool_area"
            // },

            // {
            //     scene: "hall",
            //     type: "scene",
            //     pitch: -22.8,
            //     yaw: 34.1,
            //     cssClass: "custom-hotspot hall_c",
            //     sceneId: "hall_c"
            // },

            // {
            //     scene: "hall_d",
            //     type: "scene",
            //     pitch: -3.7,
            //     yaw: -180.1,
            //     cssClass: "custom-hotspot hall_c",
            //     sceneId: "hall_c"
            // },
            // {
            //     scene: "hall_d",
            //     type: "scene",
            //     pitch: 24.8,
            //     yaw: 7.2,
            //     cssClass: "custom-hotspot arrow_right",
            //     sceneId: "secondf_meeting_hall"
            // },
            // {
            //     scene: "meeting_hall",
            //     pitch: 1.0,
            //     yaw: -48.7,
            //     type: "scene",
            //     cssClass: "custom-hotspot enter",
            //     sceneId: "secondf_meeting_hall"
            // },
            // {
            //     scene: "meeting_hall",
            //     pitch: 1.0,
            //     yaw: -124.1,
            //     type: "scene",
            //     cssClass: "custom-hotspot enter",
            //     sceneId: "secondf_meeting_hall"
            // },
            {
                scene: "meeting_hall",
                pitch: 3.8,
                yaw: 0,
                type: "scene",
                cssClass: "custom-hotspot zoom open-zoom-meeting"
            },
            {
                scene: "exhibit_hall",
                pitch: -3,
                yaw: -0,
                type: "scene",
                cssClass: "custom-hotspot left_arrow",
                sceneId: "lobby"
            },
            {
                scene: "exhibit_hall",
                pitch: 10.6,
                yaw: -10.6,
                type: "scene",
                cssClass: "custom-hotspot meeting_hall",
                sceneId: "meeting_hall"
            },
            {
                scene: "exhibit_hall",
                pitch: 10.6,
                yaw: 10.6,
                type: "scene",
                cssClass: "custom-hotspot meeting_hall",
                sceneId: "meeting_hall"
            },
            {
                scene: "secondf_outside",
                pitch: -1.6,
                yaw: -1.1,
                type: "scene",
                cssClass: "custom-hotspot arrow_left",
                sceneId: "hall_c"
            },

            // UPDATED POOL AREA
            // POOL AREA 1
            {
                scene: "pool_area",
                type: "scene",
                pitch: -4.12,
                yaw: -16.0,
                cssClass: "custom-hotspot arrow_up",
                sceneId: "pool_area2",
                text: "Go to Pool Area 2"
            },

            {
                // going back to lobby
                scene: "pool_area",
                type: "scene",
                pitch: 0.12,
                yaw: -79.36,
                cssClass: "custom-hotspot enter",
                sceneId: "lobby",
                text: "Back to lobby"
            },

            // POOL AREA 2
            {
                // going to blue room
                scene: "pool_area2",
                type: "scene",
                pitch: 0.63,
                yaw: 20.11,
                cssClass: "custom-hotspot enter",
                sceneId: "blue_room",
                text: "Go to Blue room"
            },

            {
                // going back pool area 1
                scene: "pool_area2",
                type: "scene",
                pitch: -9.14,
                yaw: 151.75,
                cssClass: "custom-hotspot arrow_up",
                sceneId: "pool_area",
                text: "Go to Pool Area 1"
            },

            {
                // going back to lobby
                scene: "pool_area2",
                type: "scene",
                pitch: -0.17,
                yaw: -176.75,
                cssClass: "custom-hotspot enter",
                sceneId: "lobby",
                text: "Back to lobby"
            },

            // BLUE ROOM
            {
                scene: "blue_room",
                type: "scene",
                pitch: -0.32,
                yaw: -95.98,
                cssClass: "custom-hotspot arrow_up",
                sceneId: "pool_area2",
                text: "Go to Pool Area 2"
            },

            {
                scene: "blue_room",
                type: "scene",
                pitch: -0.97,
                yaw: 95.83,
                cssClass: "custom-hotspot enter",
                sceneId: "lobby",
                text: "Back to lobby"
            }
        ]

        // sponsors:[
        //   {id: 1, name: 'Johnson & Johnson', x: 3663.38, y: -102.64, z: 3392.30, direction: 'NW'},
        //   {id: 2, name: 'Astra Zenica', x: 3459.15, y: -183.72, z:-3592.03, direction: 'NE'},
        //   {id: 3, name: 'Novavax', x: -2616.53, y: -168.16, z: 4246.58, direction: 'SW'},
        //   {id: 4, name: 'Pfizer', x: -2881.17, y: -204.73, z: -4073.01, direction: 'SE'},
        // ],
        // halls:[

        //   {name: 'Hall A', x: 4669.04, y: 157.28, z: 1752.54, panorama: 'hallPanorama_A'},
        //   {name: 'Hall B', x: 4670.81, y: -275.96, z: 1734.92, panorama: 'hallPanorama_B'},
        //   {name: 'Hall C', x: 4686.30, y: 154.93, z: -1707.82, panorama: 'hallPanorama_C'},
        //   {name: 'Hall D', x: 4680.38, y: -272.51, z: -1710.38, panorama: 'hallPanorama_D'},
        // ],
        // meetingHalls: [
        //   {name: 'Meeting Hall', x: 4483.87, y: 1004.02, z: 1957.63},
        //   {name: 'Meeting Hall', x: 4476.78, y: 1030.80, z: -1961.26},
        // ]
    },
    mutations: {
        // setter
        // this.$store.commit('change', event.target.value)

        // getter
        // $store.getters.flavor
        // change(state, flavor) {
        //   state.flavor = flavor
        // }
        updateIsNotAllowedMessage(state, isNotAllowedMessage) {
            state.isNotAllowedMessage = isNotAllowedMessage;
        },
        updateIsAllowed(state, isNotAllowed) {
            state.isNotAllowed = isNotAllowed;
        },
        updateBooths(state, booths) {
            state.booths = booths;
        },
        changeUser(state, user) {
            state.user = user;
        },
        updateIsWelcomed(state, isWelcomed) {
            state.isWelcomed = isWelcomed;
        },
        changeCurrentScene(state, scene) {
            state.currentScene = scene;
        },
        updateBgmStart(state, start) {
            state.bgmStart = start;
            if (!start) {
                state.audio.pause();
                // bgm.currentTime = 0;
            } else {
                state.audio.play();
            }
        },
        changeBoothDetails(state, booth_details) {
            state.booth_details = booth_details;
        },
        changeAnnouncement(state, announcement) {
            state.announcement = announcement;
        },
        updateAudioSource(state, src) {
            state.audio.pause();
            state.audio.currentTime = 0;
            state.audio = new Audio(src);
            state.audio.loop = true;
            state.bgmStart && state.audio.play();
        }
    },
    getters: {
        pois: state => state.pois,
        assets: state => state.assets,
        booths: state => state.booths,
        user: state => state.user,
        halls: state => state.halls,
        sponsors: state => state.sponsors,
        meetingHalls: state => state.meetingHalls,
        isWelcomed: state => state.isWelcomed,
        currentScene: state => state.currentScene,
        scene_hotSpots: state => state.scene_hotSpots,
        bgmStart: state => state.bgmStart,
        booth_details: state => state.booth_details,
        announcement: state => state.announcement,
        isNotAllowed: state => state.isNotAllowed,
        isNotAllowedMessage: state => state.isNotAllowedMessage,
        audio: state => state.audio
    },
    actions: {
        getBgm({ commit, state }) {
            // alert('test')
            // localStorage.setItem("bgmStatus", true);
            switch (localStorage.getItem("sceneId")) {
                case "lobby":
                    commit("updateAudioSource", "/bgm/lobby.mp3");
                    break;

                case "hall_a":
                    commit("updateAudioSource", "/bgm/hall_a.mp3");
                    break;
                case "hall_b":
                    commit("updateAudioSource", "/bgm/hall_b.mp3");
                    break;
                case "hall_c":
                    commit("updateAudioSource", "/bgm/hall_c.mp3");
                    break;
                case "hall_d":
                    commit("updateAudioSource", "/bgm/hall_d.mp3");
                    break;
                case "pool_area":
                    commit("updateAudioSource", "/bgm/pool.mp3");
                    break;
                case "meeting_hall":
                    commit("updateAudioSource", "/bgm/meeting_hall.mp3");
                    break;
                default:
                    commit("updateAudioSource", "");
                // code block
            }
            state.audio.volume = 0.1;

            const localStorageBgmStatus = localStorage.getItem("bgmStatus");
            if (localStorageBgmStatus === "true") {
                commit("updateBgmStart", true);
            } else {
                commit("updateBgmStart", false);
            }

            // commit("updateBgmStart", false);
        }
    }
});
