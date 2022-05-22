<template>
    <div class="background full">
        <Transition>
            <div class="video-container" id="videoBG" v-if="show">
                <video
                    :autoplay="videoAutoplay"
                    muted
                    loop
                    :src="videoSrc"
                    :pause="videoPause"
                    ref="videoRef"
                    @ended="videoEnded()"
                ></video>
            </div>
        </Transition>
        <div class="content" v-if="!isLoginSuccess">
            <img
                src="images/71st_login_btn.png"
                @click="showLogin()"
                id="logo"
                style="cursor: pointer;"
                width="220px"
                alt=""
                srcset=""
            />

            <!-- <div class="event_info mb-3">
                <div class="card bg-warning mt-3" style="width: 18rem;">
                    <img
                        src="images/PSP 71st Banner.jpg"
                        class="card-img-top"
                        alt="..."
                    />
                    <div class="card-body">
                        <h5 class="card-title">Not registered yet?</h5>
                        <a href="#" class="btn btn-primary"
                            >Proceed to Registration</a
                        >
                    </div>
                </div>
            </div> -->
        </div>

        <!-- change to let's go modal -->
        <div class="content" v-else>
            <Transition>
                <div v-if="!letsGoButtonClicked">
                    <Modal
                        :value="$store.getters.isWelcomed"
                        v-if="$store.getters.user"
                    >
                        <template v-slot:title>
                            <img
                                src="/images/71st_logo_min.png"
                                alt=""
                                class="center_logo mt-1"
                            />
                            <h3
                                class="display-4 mt-3 text-dark"
                                style="font-size: 2em; text-align: center;"
                            >
                                Hi {{ $store.getters.user.first_name }},
                            </h3>
                            <br />
                        </template>
                        <br />
                        <template v-slot:body>
                            <p
                                class="text-center lead mt-3 mb-30"
                                style="color: #77c2e6; font-weight: 300"
                            >
                                <strong>{{ welcomeMessage }}</strong>
                            </p>
                        </template>
                        <template v-slot:footer>
                            <button
                                class="btnletsgo"
                                type="button"
                                @click="letsGo()"
                            >
                                <i class="fa fa-arrow-right"></i> okay, lets go
                            </button>
                        </template>
                    </Modal>
                </div>
            </Transition>
        </div>
        <!-- content -->

        <div class="register" v-if="visible && !isLoginSuccess">
            <div class="close_btn">
                <i
                    class="fa fa-times-circle text-danger"
                    @click="showLogin()"
                    aria-hidden="true"
                ></i>
            </div>

            <div class="register-right col-md-4 mt-5" v-if="start_at">
                <Timer
                    class="register-form"
                    :endTime="start_at"
                    @handleTimerEnd="handleTimerEnd"
                    v-if="!isOpen"
                ></Timer>
                <div v-else class="tab-content" id="myTabContent">
                    <div
                        class="alert alert-success"
                        role="alert"
                        v-if="isLoginSuccess"
                    >
                        Login successs.
                    </div>
                    <div
                        class="alert alert-danger"
                        role="alert"
                        v-if="isLoginSuccess == false"
                    >
                        {{ loginMessage }}
                    </div>

                    <img
                        src="images/71st_login_logo.png"
                        alt="center-image"
                        width="40%"
                        height="40%"
                    />

                    <div
                        class="tab-pane fade show active"
                        id="home"
                        role="tabpanel"
                        aria-labelledby="home-tab"
                    >
                        <div
                            class="row register-form justify-content-center align-items-center"
                        >
                            <div class="col-lg-12 col-sm-12">
                                <form
                                    method="POST"
                                    @submit.prevent="handleSubmit"
                                >
                                    <div class="form-group">
                                        <input
                                            type="text"
                                            class="form-control text-center"
                                            placeholder="Username"
                                            v-model="text_email"
                                            required
                                        />
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input
                                                :type="
                                                    isSeePassword
                                                        ? 'text'
                                                        : 'password'
                                                "
                                                class="form-control text-center"
                                                id="txtpassword"
                                                placeholder="Password"
                                                v-model="text_password"
                                                required
                                            />
                                            <div
                                                class="input-group-append"
                                                @click="toggleSeePassword"
                                            >
                                                <span
                                                    class="input-group-text"
                                                    id="my-addon"
                                                    ><i
                                                        :class="
                                                            isSeePassword
                                                                ? 'fa fa-eye'
                                                                : 'fa fa-eye-slash'
                                                        "
                                                    ></i
                                                ></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-center">
                                        <div class="data_use_clause">
                                            <p
                                                class="check_agree text-light lead"
                                            >
                                                <input
                                                    type="checkbox"
                                                    class="form-check-input"
                                                    id="exampleCheck1"
                                                    v-model="agree"
                                                />
                                                <label
                                                    class="form-check-label"
                                                    for="exampleCheck1"
                                                    >{{ agreement }}</label
                                                >
                                            </p>
                                        </div>
                                    </div>

                                    <br />
                                    <div class="form-group align-middle mt-2">
                                        <button
                                            :class="
                                                agree
                                                    ? 'rounded-2 btn btn-lg btn-block'
                                                    : 'rounded-2 btn btn-lg btn-block'
                                            "
                                            :disabled="agree == false"
                                            style="font-weight: bold; background-color: #296E26; color: #FFF;"
                                        >
                                            LOGIN
                                        </button>

                                        <div class="form-group float-right">
                                            <router-link
                                                :to="'/password-remind'"
                                                class=" text-light"
                                                style="font-style: italic; opacity: 0.4;"
                                                >Forgot Password?</router-link
                                            >
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="d-flex justify-content-center">
                            <div class="data_use_clause">
                                <p
                                    class="clause text-light lead"
                                    v-html="privacy_clause"
                                ></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Timer from "./Timer.vue";
import Modal from "./Modal";
export default {
    components: {
        Timer,
        Modal
    },
    created() {
        this.init();
        const venue1 = "images/Venue1.mp4";
        const venue2 = "images/Venue2.mp4";
        // console.log(this.$store.getters.pois)
    },
    data() {
        return {
            show: true,
            loginMessage: null,
            text_email: "",
            text_password: "",
            isLoginSuccess: null,
            isSeePassword: false,
            isOpen: false,
            start_at: null,

            visible: false,

            privacy_clause:
                'Note: You will be entitled to join the PSP raffle draw if you are able to visit all the booths. However, please refrain from visiting the booths or any particular booth if you do not wish to share your contact details to them.  Virtual booth visit happens when you click <banner class=\' text-success\'><i class="fa fa-sign-in" aria-hidden="true"></i></banner> icon on the booth.',
            agreement:
                "I am aware that when I visit the booths inside the virtual venue, my contact details will be accessible to the event sponsors and that I may be reached for promotion of their products.",
            agree: false,
            videoAutoplay: true,
            videos: ["images/Venue1.mp4", "images/Venue2.mp4"],
            videoSrc: "images/Venue1.mp4",

            welcomeMessage:
                "Welcome to our PSP 71st Platinum Year Virtual Convention Event",
            letsGoButtonClicked: false
        };
    },
    watch: {},

    methods: {
        async init() {
            let { data } = await axios.get("/api/v1/event");
            let now = new Date();
            let start_at_ = data.start_at_;
            if (now > start_at_) {
                this.isOpen = true;
            }
            this.start_at = data.start_at_;
        },

        async handleSubmit() {
            this.isLoginSuccess = null;
            // if(this.errors){
            //     return false
            // }
            let fd = new FormData();
            fd.append("email", this.text_email);
            fd.append("password", this.text_password);
            let { data } = await axios.post("/api/login", fd);
            if (data.status === "ok") {
                this.show = !this.show;
                this.isLoginSuccess = true;
                this.$emit("isLoginSuccess", this.isLoginSuccess);
                this.$store.commit("changeUser", data.user);
                // this.$store.commit("updateAudioSource", "/bgm/landing.mp3");
                localStorage.setItem("access_token", data.access_token);
                localStorage.setItem("sceneId", "lobby");
                setTimeout(() => {
                    this.show = !this.show;
                }, 500);
                //
                this.videoSrc = this.videos.at(1);
                this.videoAutoplay = !this.videoAutoplay;
                this.$refs.videoRef.play();
                this.videoSrc = this.videos.at(1);

                // this.showLogin();
            } else {
                this.isLoginSuccess = false;
                this.loginMessage = data.message;
            }
        },
        toggleSeePassword() {
            this.isSeePassword = !this.isSeePassword;
        },
        handleTimerEnd(e) {
            this.isOpen = e;
        },
        handleToggleBgMusic() {
            this.$store.commit("updateAudioSource", "/bgm/landing.mp3");
        },
        showLogin() {
            this.visible = !this.visible;
        },
        letsGo() {
            this.letsGoButtonClicked = true;
            this.$refs.videoRef.play();
            this.$refs.videoRef.loop = false;
        },
        videoEnded() {
            this.$router.push("/");
        },
        handleUpdateIsWelcomed() {
            this.$store.commit("updateIsWelcomed", false);
        },
        handleIsNotAllowedClose() {
            this.$store.commit("updateIsAllowed", false);
        }
    }
};
</script>

<style scoped>
.v-enter-active,
.v-leave-active {
    transition: opacity 1s ease;
}

.v-enter-from,
.v-leave-to {
    opacity: 0;
}
div >>> .register {
    /* align-items: center;
    justify-content: center;
    display: flex;
    height: 100%;
    width: 100%;
    background: #333;
    opacity: 0.9; */
    /* opacity:0.8;
    background-color:#ccc; */
    position: fixed;
    width: 100%;
    height: 100%;
    top: 0px;
    left: 0px;
    z-index: 1000;
}
div.background {
    height: 100%;
    top: 0;
    left: 0;
}

div.full {
    height: 100%;
}
.register {
    /* overflow: visible; */
    /* background: -webkit-linear-gradient(left, #18a01f, #12ff75); */
    /* padding: 2% 0 3%; */
    align-items: center;
    justify-content: center;
    display: flex;

    background: rgb(34, 34, 34);
    opacity: 0.9;
}

.register-right {
    text-align: center;
    align-items: center;

    /*background-color: #501f9c; For browsers that do not support gradients */
    /*background-image: linear-gradient(#2347a7, #702fa4);*/

    margin-bottom: 3%;
    /* border: 3px solid #17094b; */
    border-radius: 0.8em;
    padding: 2%;
    /* box-shadow: #000 0 8px 15px 2px; */
}

@-webkit-keyframes mover {
    0% {
        transform: translateY(0);
    }
    100% {
        transform: translateY(-20px);
    }
}
@keyframes mover {
    0% {
        transform: translateY(0);
    }
    100% {
        transform: translateY(-20px);
    }
}

.register .register-form {
    padding: 1% 1% 1% 1%;
    margin-top: 1%;

    /* border: 1px solid green; */
}
.btnRegister {
    float: right;
    margin-top: 10%;
    border: none;
    border-radius: 1.5rem;
    padding: 2%;
    background: #0062cc;
    color: #fff;
    font-weight: 600;
    width: 50%;
    cursor: pointer;
}
.register .nav-tabs {
    margin-top: 3%;
    border: none;
    background: #0062cc;
    border-radius: 1.5rem;
    width: 28%;
    float: right;
}
.register .nav-tabs .nav-link {
    padding: 2%;
    height: 34px;
    font-weight: 600;
    color: #fff;
    border-top-right-radius: 1.5rem;
    border-bottom-right-radius: 1.5rem;
}
.register .nav-tabs .nav-link:hover {
    border: none;
}
.register .nav-tabs .nav-link.active {
    width: 100px;
    color: #0062cc;
    border: 2px solid #0062cc;
    border-top-left-radius: 1.5rem;
    border-bottom-left-radius: 1.5rem;
}
.register-heading {
    text-align: center;
    margin-top: 5%;
    margin-bottom: -15%;
    color: #495057;
}

.btn-light {
    border: 1px solid #cfcfcf;
}
.btn-light:hover {
    background: #4c748c;
}

#txtpassword {
    padding-left: 70px;
}

.register-form input[type="text"] {
    font-size: medium;
    border: 1px solid #040036;
    opacity: 1;
}
.register-form input[type="password"] {
    font-size: medium;
    border: 1px solid #040036;
    opacity: 1;
}
.register-form button {
    font-size: medium;
    opacity: 1;
}

.close_btn {
    position: absolute;
    top: 5px;
    right: 10px;
    display: block;
    cursor: pointer;
    font-size: 24px;

    /* border: 1px solid green; */
    padding: 5px;
}

.event_info {
    position: fixed;
    bottom: 0;
    width: 40%;
}

.center_logo {
    display: block;
    margin-left: auto;
    margin-right: auto;
    width: 50%;
}

.btnletsgo {
    margin-left: auto;
    margin-right: auto;
    background-color: #ebcb17;
    border: none;
    color: #610089;
    padding: 10px 25px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 14px;
    border-radius: 3rem;
}

@media screen and (max-height: 900px) {
    .register-heading {
        text-align: center;
        margin-top: 3%;
        margin-bottom: -15%;
        color: #495057;
        font-size: 2.7rem;
    }

    .data_use_clause .clause {
        font-size: 11px !important;
    }

    .data_use_clause .check_agree {
        font-size: 11px !important;
    }

    .register {
        padding: 5% 1% 3%;
    }

    .register-form input[type="text"] {
        font-size: small;
    }
    .register-form input[type="password"] {
        font-size: small;
    }
    .register-form button {
        font-size: small;
    }
}

@media screen and (max-height: 800px) {
    .register-heading {
        text-align: center;
        margin-top: 3%;
        margin-bottom: -15%;
        color: #495057;
        font-size: 2.5rem;
    }

    .data_use_clause .clause {
        font-size: 10px !important;
    }

    .data_use_clause .check_agree {
        font-size: 10px !important;
    }

    .register {
        /* padding: 3% 1% 3%; */
    }

    .register-form input[type="text"] {
        font-size: small;
    }
    .register-form input[type="password"] {
        font-size: small;
    }
    .register-form button {
        font-size: small;
    }
}

@media screen and (max-height: 500px) {
    .register-heading {
        text-align: center;
        margin-top: 3%;
        margin-bottom: -15%;
        color: #495057;
        font-size: 2rem;
    }

    .data_use_clause .clause {
        font-size: 9px !important;
    }

    .data_use_clause .check_agree {
        font-size: 9px !important;
    }

    .register {
        /* padding: 3% 1% 3%; */
    }

    .register-form input[type="text"] {
        font-size: small;
    }
    .register-form input[type="password"] {
        font-size: small;
    }
    .register-form button {
        font-size: small;
    }
}

@media screen and (max-width: 767px) {
    .register-right h3 {
        font-size: xx-large;
    }

    .register-right p {
        font-weight: normal;
    }

    .clause {
        font-size: 11px;
    }
    .col-md-4 {
        max-width: 66.66%;
    }
}

@media screen and (max-width: 280px) {
    .register-right h3 {
        font-size: x-large;
    }
    #txtpassword {
        padding-left: 62px;
    }

    .clause {
        font-size: 9px !important;
    }
}

/* data use clause */
.data_use_clause {
    width: 90%;
    align-items: center;
}

.btn_holder {
    /* border: 1px solid red; */
    width: 50%;
}

.clause {
    font-size: 17px !important;
    text-align: justify;
    font-weight: 100;
}

.check_agree {
    font-size: 17px !important;
    text-align: justify;
    font-weight: 100;
}

@media screen and (max-width: 750px) {
    .data_use_clause .clause {
        font-size: 11px !important;
    }

    .data_use_clause .check_agree {
        font-size: 11px !important;
    }
}

@media screen and (max-width: 320px) {
    .data_use_clause .clause {
        font-size: 9px !important;
    }

    .data_use_clause .check_agree {
        font-size: 9px !important;
    }
}

@media screen and (max-width: 360px) {
    .data_use_clause .clause {
        font-size: 9px !important;
    }

    .data_use_clause .check_agree {
        font-size: 9px !important;
    }
}
</style>
