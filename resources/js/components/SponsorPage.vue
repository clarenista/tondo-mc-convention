<template lang="">
    <div class="background full">
        <div v-if="selectedHotspot">
            <CoolLightBox
                :items="selectedHotspot.assets"
                :index="indexSelected"
                @close="indexSelected = null"
            >
            </CoolLightBox>
        </div>
        <Modal
            :value="value"
            v-if="
                selectedHotspot != null &&
                    !selectedHotspot.assets[0].category.includes('standee')
            "
        >
            <template v-slot:title>
                <h1 class="lgbt" v-if="selectedHotspot.name == 'contact-us'">
                    Send us a Message
                </h1>
                <h1 class="lgbt" v-else>
                    {{ selectedHotspot.name.replace(/_/g, " ") }}
                </h1>
            </template>

            <template v-slot:body>
                <div class="row px-4">
                    <!-- External link -->
                    <template
                        class="lgbt"
                        v-if="selectedHotspot.name == 'external-link'"
                    >
                        <div class="row p-1 text-center">
                            <div class="col-12">
                                <h3 class="redirrect_msg text-light">
                                    <i
                                        class="fa fa-info-circle text-info"
                                        aria-hidden="true"
                                    ></i>
                                    You are about to leave the virtual 2nd
                                    Postgrad course site, you will be redirected
                                    to:
                                </h3>
                                <a
                                    class="lead"
                                    :href="selectedHotspot.assets[0].url"
                                    target="_blank"
                                >
                                    <small
                                        ><u class="text-primary">{{
                                            selectedHotspot.assets[0].url
                                        }}</u></small
                                    >
                                </a>
                            </div>
                            <!-- <div class="col-12 mt-3">
                                <small class="text-light"
                                    >Click the
                                    <u class="text-primary">link</u> if you wish
                                    to continue.</small
                                >
                            </div> -->
                        </div>
                    </template>
                    <!-- External link -->

                    <!-- WHEEL  -->
                    <template v-else-if="selectedHotspot.name == 'wheels'">
                        <div class="col-12 p-1">
                            <div
                                class="embed-responsive embed-responsive-21by9"
                            >
                                <iframe
                                    class="embed-responsive-item"
                                    :src="
                                        '/sponsor/' +
                                            id +
                                            '/fortune-wheel/token/' +
                                            token
                                    "
                                    allowfullscreen
                                ></iframe>
                            </div>
                        </div>
                    </template>
                    <!-- WHEEL  -->

                    <!-- CONTACT US FORM -->
                    <template v-else-if="selectedHotspot.name == 'contact-us'">
                        <div class="col-12 mb-3">
                            <div class="input-group">
                                <span class="input-group-prepend">
                                    <span class="input-group-text"
                                        >Subject&nbsp;&nbsp;&nbsp;&nbsp;</span
                                    >
                                </span>
                                <input
                                    type="text"
                                    class="form-control"
                                    v-model="subject"
                                    placeholder="Subject"
                                    aria-label=""
                                />
                            </div>
                        </div>

                        <div class="col-12 mb-3">
                            <div class="input-group">
                                <span class="input-group-prepend">
                                    <span class="input-group-text"
                                        >Interest&nbsp;&nbsp;&nbsp;</span
                                    >
                                </span>
                                <input
                                    type="text"
                                    class="form-control"
                                    v-model="interest"
                                    placeholder="Interest"
                                    aria-label=""
                                />
                            </div>
                        </div>

                        <div class="col-12 mb-3">
                            <div class="input-group">
                                <span class="input-group-prepend">
                                    <span class="input-group-text"
                                        >Message&nbsp;</span
                                    >
                                </span>
                                <textarea
                                    class="form-control"
                                    v-model="message"
                                    placeholder="Message"
                                    aria-label=""
                                ></textarea>
                            </div>
                        </div>

                        <div class="col-12">
                            <button
                                class="btn btn-success btn-block"
                                @click="handleSendMessage()"
                            >
                                &#9993; SEND MESSAGE
                            </button>
                        </div>
                    </template>
                    <!-- CONTACT US FORM -->

                    <!-- QUIZ  -->
                    <template v-else-if="selectedHotspot.name == 'quiz'">
                        <div class="col-12 p-1">
                            <div v-if="selectedHotspot.quiz_taken != ''">
                                <legend class="text-center text-light mb-3">
                                    <i
                                        class="fa fa-trophy"
                                        aria-hidden="true"
                                    ></i
                                    >&nbsp;Your total score: {{ renderTotal }} /
                                    {{ selectedHotspot.questions.length }}
                                </legend>
                                <div>
                                    <h3
                                        class="text-center text-light end_message"
                                    >
                                        {{
                                            selectedHotspot.questionnaire
                                                .ending_message
                                        }}
                                    </h3>
                                </div>

                                <ol>
                                    <li
                                        class=" text-light"
                                        v-for="(question,
                                        questionIndex) in selectedHotspot.questions"
                                        :key="questionIndex"
                                    >
                                        <p class=" text-light">
                                            {{ question.question }}
                                        </p>
                                        <p
                                            v-if="question.answers[0]"
                                            :class="
                                                question.answers[0].correct == 1
                                                    ? 'text-success'
                                                    : 'text-danger'
                                            "
                                        >
                                            Your Answer:
                                            {{ question.answers[0].answer }}
                                            <i
                                                class="fa"
                                                :class="
                                                    question.answers[0]
                                                        .correct == 1
                                                        ? 'fa-check'
                                                        : 'fa-times'
                                                "
                                            ></i>
                                        </p>
                                        <p v-else class="text-danger">
                                            No Answer
                                            <i class="fa fa-times"></i>
                                        </p>
                                    </li>
                                </ol>
                            </div>

                            <div v-else>
                                <div>
                                    <h3 class="instruction text-light">
                                        {{
                                            selectedHotspot.questionnaire
                                                .instruction
                                        }}
                                    </h3>
                                </div>

                                <div
                                    class="col-12 p-1 text-light"
                                    v-if="page == assetIndex"
                                    v-for="(item,
                                    assetIndex) in selectedHotspot.questions"
                                    :key="assetIndex"
                                >
                                    <div class="row">
                                        <div class="col">
                                            <legend>
                                                Question {{ assetIndex + 1 }}:
                                                &nbsp;{{ item.question }}?
                                            </legend>

                                            <div
                                                class="form-check mb-3"
                                                v-for="(choice,
                                                index) in item.choices"
                                                :key="index"
                                            >
                                                <input
                                                    class="form-check-input"
                                                    :id="
                                                        'customRadio' +
                                                            index +
                                                            assetIndex
                                                    "
                                                    type="radio"
                                                    v-model="answers[item.id]"
                                                    :value="choice"
                                                />
                                                <label
                                                    class="form-check-label"
                                                    :for="
                                                        'customRadio' +
                                                            index +
                                                            assetIndex
                                                    "
                                                    >{{ choice }}</label
                                                >
                                            </div>

                                            <button
                                                class="btn btn-danger float-left"
                                                type="button"
                                                v-show="!start"
                                                @click="handlePrev"
                                            >
                                                Prev
                                            </button>
                                            <button
                                                class="btn btn-primary float-right"
                                                type="button"
                                                v-if="!end"
                                                @click="handleNext"
                                            >
                                                Next
                                            </button>
                                            <button
                                                class="btn btn-primary float-right"
                                                type="button"
                                                v-else
                                                @click="handleSubmitAnswer"
                                            >
                                                Submit
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </template>
                    <!-- QUIZ  -->

                    <!-- GALLERY  -->
                    <template v-else-if="selectedHotspot.name == 'gallery'">
                        <div
                            class="col-4 p-1"
                            v-for="(item, assetIndex) in selectedHotspot.assets"
                            :key="assetIndex"
                            @click="handleSelectAssetIndex(assetIndex)"
                        >
                            <!-- <div class="card" style="cursor:pointer;">
                    <div class="card-img-overlay text-white"><small>{{item.name}}</small></div>
                    <img :src="item.url" class="img-fluid" width="100%" alt="" srcset="">
                  </div> -->

                            <div
                                class="card text-center"
                                style="cursor:pointer;"
                                @click.prevent="
                                    sendVisitedAssets(
                                        item,
                                        selectedHotspot.name
                                    )
                                "
                            >
                                <!-- <img :src="item.url" width="100%" alt="" srcset=""> -->
                                <div class="card-body bg-dark">
                                    <!-- use to have a clickable image on the card -->

                                    <div
                                        style="width: 100%;overflow: hidden;height: 8rem;display: inline-flex; vertical-align: middle;"
                                    >
                                        <img
                                            v-if="item.thumbnail_url != null"
                                            :src="item.thumbnail_url"
                                            width="100%"
                                            alt=""
                                            srcset=""
                                        />
                                        <img
                                            v-else
                                            :src="item.url"
                                            width="100%"
                                            alt=""
                                            srcset=""
                                        />
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div
                                        class="lead text-dark"
                                        style="align-items: center;white-space: nowrap;text-overflow: ellipsis;overflow: hidden;font-size: 1rem;"
                                    >
                                        {{ item.name }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </template>
                    <!-- GALLERY  -->

                    <!-- VIDEO -->
                    <template v-else-if="selectedHotspot.name == 'videos'">
                        <div
                            class="col-4 p-1"
                            v-for="(item, assetIndex) in selectedHotspot.assets"
                            :key="assetIndex"
                            @click="handleSelectAssetIndex(assetIndex)"
                        >
                            <div
                                class="card text-center"
                                style="cursor:pointer;"
                                @click.prevent="
                                    sendVisitedAssets(
                                        item,
                                        selectedHotspot.name
                                    )
                                "
                            >
                                <img
                                    :src="
                                        'https://www.youtube.com/embed/' +
                                            item.url
                                    "
                                    width="100%"
                                    alt=""
                                    srcset=""
                                />
                                <div class="card-body bg-dark">
                                    <div
                                        style="width: 100%;overflow: hidden;height: 8rem;display: inline-flex; vertical-align: middle;"
                                    >
                                        <img
                                            v-if="item.thumbnail_url != null"
                                            :src="item.thumbnail_url"
                                            width="100%"
                                            alt=""
                                            srcset=""
                                        />
                                        <img
                                            v-else
                                            src="https://media.tenor.com/images/2c2d6329835b0cc59bb8368b66e423df/tenor.gif"
                                            width="100%"
                                            alt=""
                                            srcset=""
                                        />
                                    </div>
                                </div>
                                <div class="card-footer bg-danger">
                                    <div
                                        class="lead text-white"
                                        style="align-items: center;white-space: nowrap;text-overflow: ellipsis;overflow: hidden;font-size: 1rem;"
                                    >
                                        {{ item.name }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </template>
                    <!-- VIDEO -->

                    <!-- BROCHURES -->
                    <template v-else-if="selectedHotspot.name == 'brochures'">
                        <div
                            class="col-4 p-1"
                            v-for="(item, assetIndex) in selectedHotspot.assets"
                            :key="assetIndex"
                            @click="handleSelectAssetIndex(assetIndex)"
                        >
                            <div
                                class="card text-center"
                                style="cursor:pointer;"
                                @click.prevent="
                                    sendVisitedAssets(
                                        item,
                                        selectedHotspot.name
                                    )
                                "
                            >
                                <img
                                    :src="item.url"
                                    width="100%"
                                    alt=""
                                    srcset=""
                                />
                                <div class="card-body bg-dark">
                                    <div
                                        style="width: 100%;overflow: hidden;height: 8rem;display: inline-flex; vertical-align: middle;"
                                    >
                                        <!-- use to have a clickable image on the card -->
                                        <img
                                            v-if="item.thumbnail_url != null"
                                            :src="item.thumbnail_url"
                                            width="100%"
                                            alt=""
                                            srcset=""
                                        />
                                        <img
                                            v-else
                                            src="/images/pdf-icon.png"
                                            width="100%"
                                            alt=""
                                            srcset=""
                                        />
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div
                                        class="lead text-dark"
                                        style="align-items: center;white-space: nowrap;text-overflow: ellipsis;overflow: hidden;font-size: 1rem;"
                                    >
                                        {{ item.name }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </template>
                    <!-- BROCHURES -->

                    <div
                        class="col-4"
                        v-else
                        v-for="(item, index) in selectedHotspot.assets"
                        :key="index"
                    >
                        <div class="card ">
                            <p class="card-header">{{ item.name }}</p>
                            <a :href="item.url" target="_blank">
                                <img
                                    src="/images/logo.png"
                                    class="img-fluid"
                                    alt=""
                                    srcset=""
                                />
                            </a>
                        </div>
                    </div>
                </div>
            </template>
            <template v-slot:footer>
                <button
                    class="btn btn-warning"
                    type="button"
                    @click="handleCloseModal()"
                >
                    Close
                </button>
            </template>
        </Modal>
        <Chat
            :sponsor_id="booth_details.sponsor_id"
            :user_details="user"
            v-if="booth_details"
        />
        <img
            src="/images/icons/sponsor-back-btn.png "
            @click="handleBackToLobby"
            class="btn btn-sm"
            alt=""
            srcset=""
            style="position: fixed; top: 0; left: 0; margin:1em; z-index: 10;"
            width="100"
        />
        <div id="panorama"></div>
    </div>
</template>
<script>
import Modal from "./Modal";
import Chat from "./Chat";
export default {
    mounted() {
        console.log("mounted");
        window.addEventListener("resize", this.reSize);
        this.reSize();
    },
    computed: {
        user() {
            return this.$store.getters.user;
        },
        sponsorId() {
            return this.booth_details.sponsor_id;
        }
    },
    props: ["id"],
    components: {
        Modal,
        Chat
    },
    created() {
        this.init();
    },
    methods: {
        async init() {
            const wrapper = document.querySelector(".hotspots--wrapper");
            let { data } = await axios.get(
                "/api/v1/booths/" +
                    this.id +
                    "?api_token=" +
                    localStorage.getItem("access_token")
            );

            this.booth_details = data;
            const viewQuery = this.$route.query.view;
            Object.entries(data.hotspots).find(h => {
                if (h[0] === viewQuery) {
                    this.handleSelectHotspot(h[1]);
                    this.selectedHotspot = h[1];
                    this.value = true;
                }
            });
            switch (data.panorama_location) {
                case "hall_a":
                    this.$store.commit("updateAudioSource", "/bgm/hall_a.mp3");
                    break;
                case "hall_b":
                    this.$store.commit("updateAudioSource", "/bgm/hall_b.mp3");
                    break;
                case "hall_c":
                    this.$store.commit("updateAudioSource", "/bgm/hall_c.mp3");
                    break;
                case "hall_d":
                    this.$store.commit("updateAudioSource", "/bgm/hall_d.mp3");
                    break;
            }
            this.$store.getters.audio.volume = 0.1;
            this.$store.commit("changeBoothDetails", data);
            // this.$store.commit('updateAudioSource', '/bgm/landing.mp3')
            this.sendBoothGuestEvent(data);
            const image = data.background;
            let hs = data.hotspots;
            hs = Object.values(hs);
            // console.log(hs)
            // const image = "/images/multires/A-Silver.png";
            // const hs = [
            //   {name:'brochures', pitch: 0, yaw: 0, cssClass: 'custom-hotspot brochures', id: 'brochure'},
            //   {name:'videos', pitch: 5, yaw: 5, cssClass: 'custom-hotspot videos', id: 'video'},
            //   {name:'external-links', pitch: 10, yaw: 10, cssClass: 'custom-hotspot external-links', id: 'external-links'},
            // ]

            for (let i in hs) {
                const classCss =
                    hs[i].assets.length > 0 &&
                    (hs[i].assets[0].category.includes("standee")
                        ? "standee"
                        : hs[i].name);

                hs[i].name = hs[i].name;
                hs[i].pitch = hs[i].x;
                hs[i].yaw = hs[i].y;
                hs[i].cssClass = "custom-hotspot " + classCss;
                hs[i].clickHandlerFunc = () => {
                    this.handleSelectHotspot(hs[i]);
                    // this.showModal = true
                    this.selectedHotspot = hs[i];
                };
            }
            // console.log(hs)
            this.panorama_details = {
                default: {
                    firstScene: "landing",
                    sceneFadeDuration: 500,
                    autoLoad: true,
                    showControls: false,
                    hotSpots: hs,
                    // uncomment the code below to get the PITCH and YAW of hotspot - console
                    // "hotSpotDebug": true,
                    mouseZoom: false,
                    "doubleClickZoom ": false
                },

                scenes: {
                    landing: {
                        type: "equirectangular",
                        panorama: image,
                        // "hotSpots": hs,
                        // 180 view | 360 view = 180 view x 2
                        minPitch: -20,
                        minYaw: -20,
                        maxPitch: 20,
                        maxYaw: 20
                        // "preview": "/images/multires/loading.png"
                    }
                }
            };
            this.viewer = pannellum.viewer("panorama", this.panorama_details);
        },
        handleBackToLobby() {
            if (this.$store.getters.user.classification === "sponsor") {
                this.$router.push({ name: "home" });
            } else {
                this.$router.push({
                    name: "home",
                    params: {
                        sceneId:
                            this.booth_details.panorama_location != "lobby"
                                ? this.booth_details.panorama_location
                                : "lobby",
                        pitch: this.booth_details.x,
                        yaw: this.booth_details.y
                    }
                });
                // this.$router.push({ name: 'home', params: {sceneId: 'hall_a'}})
            }
        },
        handleSelectHotspot(hotspot) {
            this.value = true;
            for (let i in hotspot.assets) {
                hotspot.assets[i]["src"] = hotspot.assets[i].url;
            }
            this.selectedHotspot = hotspot;
            if (hotspot.name == "videos") {
                this.$store.getters.audio.pause();
            }
            this.sendBoothGuestEvent(this.booth_details, hotspot);

            if (hotspot.assets[0].category.includes("standee")) {
                setTimeout(() => {
                    this.indexSelected = 0;
                }, 100);
            } else {
                this.indexSelected = null;
            }
        },
        handleCloseModal() {
            if (this.selectedHotspot.name == "videos") {
                this.$store.getters.audio.play();
            }
            this.selectedHotspot = null;
            this.value = false;
        },
        async handleSendMessage() {
            let url =
                "/api/v1/booths/" +
                this.id +
                "/message?api_token=" +
                localStorage.getItem("access_token");

            // append text fields
            let fd = new FormData();
            fd.append("subject", this.subject);
            // fd.append('name', this.name)
            // fd.append('affiliation', this.affiliation)
            // fd.append('mobile_number', this.mobile_number)
            // fd.append('email', this.email)
            fd.append("interest", this.interest);
            fd.append("message", this.message);

            try {
                let { data } = await axios.post(url, fd);
                this.selectedHotspot = null;
                this.value = false;

                this.subject = "";
                this.affiliation = "";
                this.email = "";
                this.interest = "";
                this.message = "";

                // show modal after insert
                this.showSuccessModal = true;
            } catch (error) {
                alert(JSON.stringify(error.message));
                this.value = true;
            }
        },
        async sendBoothGuestEvent(booth = null, hotspot = null) {
            // category: lobby,
            // label: click Astra Zeneca Booth
            let fd = new FormData();

            fd.append("type", "event");
            fd.append("category", booth.name);
            fd.append(
                "label",
                hotspot == null ? "visit" : "click " + hotspot.name + " hotspot"
            );

            // alert(hotspot.assets)

            let { data } = await axios.post(
                "/api/v1/guests/event/push?api_token=" +
                    localStorage.getItem("access_token"),
                fd
            );
        },

        async sendVisitedAssets(assets, hotspot) {
            let fd = new FormData();
            fd.append("type", "event");
            fd.append("category", this.booth_details.name);
            fd.append(
                "label",
                "click " + assets.name + " at " + hotspot + " hotspot"
            );

            let { data } = await axios.post(
                "/api/v1/guests/event/push?api_token=" +
                    localStorage.getItem("access_token"),
                fd
            );
        },

        handleSelectAssetIndex(assetIndex) {
            // console.log(assetIndex);
            // this.value = false
            this.indexSelected = assetIndex;
        },
        handleNext() {
            this.start = false;
            let count = this.selectedHotspot.questions.length - 1;
            if (count > this.page) {
                this.page = this.page + 1;
                if (count == this.page) {
                    this.end = true;
                    this.start = false;
                }
            } else {
                this.end = true;
                this.start = false;
            }
        },
        handlePrev() {
            this.end = false;
            let count = this.selectedHotspot.questions.length;
            if (0 < this.page) {
                this.page = this.page - 1;
                if (0 > this.page) {
                    this.end = false;
                    this.start = true;
                }
            } else {
                this.end = false;
                this.start = true;
            }
        },
        async handleSubmitAnswer() {
            let fd = new FormData();
            fd.append("answers", JSON.stringify(this.answers));
            let { data } = await axios.post(
                "/api/v1/booths/" +
                    this.id +
                    "/questionnaire/answer/submit?api_token=" +
                    localStorage.getItem("access_token"),
                fd
            );
            this.selectedHotspot.quiz_taken = data.answers;
            this.selectedHotspot.questions = data.questions;
        },
        async showQuestionnaire() {
            let { data } = await axios.get(
                "/api/v1/booths/" +
                    this.id +
                    "/questionnaire?api_token=" +
                    localStorage.getItem("access_token")
            );
        },
        imageLoad() {
            this.isLoading = false;
        },
        reSize() {
            // Get screen size (inner/outerWidth, inner/outerHeight)
            var height = window.innerHeight;
            var width = window.innerWidth;
            if (width < height) {
                // portrait
                this.viewer.setHfov(70);
            } else {
                // landscape (or width=height)
                this.viewer.setHfov(100);
            }
        }
    },
    data() {
        return {
            viewer: null,
            booth_details: null,
            modalShow: false,
            selectedHotspot: null,
            value: false,
            // contact-us field
            subject: "",
            name: "",
            affiliation: "",
            mobile_number: "",
            email: "",
            interest: "",
            message: "",
            successMessage: false,
            data: "",
            indexSelected: null,
            answers: {},
            page: 0,
            end: false,
            start: true,
            answersS: [],
            isLoading: true,
            bgmStart: null,

            showSuccessModal: false,
            token: localStorage.getItem("access_token")
        };
    }
};
</script>
<style scoped>
.pnlm-container {
    background: #f1f2f3;
}
div >>> .modal-dialog  {
    max-width: 720px !important;
}
div >>> .pnlm-load-box {
    background: url(/images/loader.gif) no-repeat !important;
    background-size: contain !important;
    left: 52% !important;
}
div >>> .pnlm-load-box p {
    z-index: -999 !important;
    opacity: 0 !important;
}

div >>> .pnlm-lbox {
    z-index: -999 !important;
    opacity: 0 !important;
}
div >>> .pnlm-lbar {
    z-index: -999 !important;
    opacity: 0 !important;
}
div.background {
    position: fixed;
    top: 0;
    left: 0;
}

div.full {
    width: 100%;
    height: 100%;
}
div >>> .custom-hotspot {
    height: 43px;
    width: 43px;
    animation: pulse 2s infinite;
    border-radius: 50%;
}

@media only screen and (max-width: 425px) {
    div >>> .custom-hotspot {
        height: 28px;
        width: 28px;
    }
}
div >>> .standee {
    background-image: url("/images/iconsv2/standee.png");
    background-size: cover;
}
div >>> .brochures {
    background-image: url("/images/iconsv2/brochure.png");
    background-size: cover;
}
div >>> .videos {
    background-image: url("/images/iconsv2/videos.png");
    background-size: cover;
}
div >>> .contact-us {
    background-image: url("/images/iconsv2/contact.png");
    background-size: cover;
}
div >>> .external-link {
    background-image: url("/images/iconsv2/link.png");
    background-size: cover;
}
div >>> .gallery {
    background-image: url("/images/iconsv2/gallery.png");
    background-size: cover;
}
div >>> .quiz {
    background-image: url("/images/iconsv2/quiz.png");
    background-size: cover;
}
div >>> .wheels {
    background-image: url("/images/icons/zoom.png");
    background-size: cover;
}

@-webkit-keyframes pulse {
    0% {
        -webkit-box-shadow: 0 0 0 0 rgba(255, 255, 255, 0.9);
    }
    70% {
        -webkit-box-shadow: 0 0 0 10px rgba(255, 255, 255, 0);
    }
    100% {
        -webkit-box-shadow: 0 0 0 0 rgba(255, 255, 255, 0);
    }
}
@keyframes pulse {
    0% {
        -moz-box-shadow: 0 0 0 0 rgba(255, 255, 255, 0.9);
        box-shadow: 0 0 0 0 rgba(255, 255, 255, 0.9);
    }
    70% {
        -moz-box-shadow: 0 0 0 10px rgba(255, 255, 255, 0);
        box-shadow: 0 0 0 10px rgba(255, 255, 255, 0);
    }
    100% {
        -moz-box-shadow: 0 0 0 0 rgba(255, 255, 255, 0);
        box-shadow: 0 0 0 0 rgba(255, 255, 255, 0);
    }
}
.lgbt {
    color: #610089;
    font-size: 2em;
    padding: 0.5em 1.3em;
}
</style>
