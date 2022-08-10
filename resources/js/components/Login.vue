<template>
    <div class="background full">
        <Transition>
            <div class="video-container" id="videoBG" v-if="show">
                <video
                    :autoplay="videoAutoplay"
                    muted
                    loop
                    :src="videoSrc"
                    ref="videoRef"
                ></video>
            </div>
        </Transition>
        <div class="content" v-if="!isLoginSuccess">
            <div class="event_info">
                <div class="card mt-3">
                    <div class="text-center text-light small mt-3">
                        <p>
                            <img
                                style="padding: 0 10px; width: 70%;"
                                src="images/header.png"
                                class="card-img-top"
                                alt="..."
                            />
                        </p>
                    </div>

                    <div class="border_bot">
                        &nbsp;
                    </div>

                    <div class="card-body">
                        <h5 class="card-title text-center mt-3">
                            2<sup>nd</sup> POSTGRADUATE COURSE
                        </h5>

                        <h1 class="text-center text-light">
                            TAILORING<br />
                            THE OPTIMAL MANAGEMENT<br />
                            OF OB-GYN CONDITIONS
                        </h1>

                        <p class="event_date_box mt-3 text-light">
                            AUGUST 11 - 12, 2022<br />
                            04:00 PM - 07:00 PM
                        </p>

                        <!-- disable login button for now 
                        <a
                            href="#"
                            class="btn btn_pink btn-block mt-5"
                            @click="handleRegisterClicked()"
                            >REGISTER</a
                        >-->
                        <a
                            href="#"
                            class="btn btn_pink btn-block mt-5"
                            @click="showLogin()"
                            >LOGIN</a
                        >

                        <p class="text-center">
                            <span class="lead"
                                >NOT YET REGISTERED?
                                <a
                                    href="#"
                                    class="btn"
                                    @click="handleRegisterClicked"
                                    >CLICK HERE</a
                                ></span
                            >
                        </p>

                        <p class="concerns mt-3 text-light">
                            Any concerns or inquiries, please text the following numbers:<br>
                            Dr. Aceveda at 09065103974 or <br>
                            Tondo Medical center OBGYN at 09812464532.
                        </p>
                    </div>

                    <div class="border_bot">
                        &nbsp;
                    </div>

                    <div>
                        <div class="event_info_footer">
                            <h1 class="lead text-center text-light">
                                <a
                                    href="#"
                                    class="btn"
                                    @click="handleChangeEventInfoModal(1)"
                                    >PROGRAM</a
                                >
                            </h1>

                            <h1 class="lead float-left">
                                <a
                                    href="#"
                                    class="btn"
                                    @click="handleChangeEventInfoModal(2)"
                                    >SPEAKERS</a
                                >
                            </h1>
                            <h1 class="lead float-right">
                                <a
                                    href="#"
                                    class="btn"
                                    @click="handleChangeEventInfoModal(3)"
                                    >CONTACT US</a
                                >
                            </h1>
                        </div>
                    </div>

                    <h1 class="text-center text-light">
                        <a
                            style="padding: 4px 7px; background: #ff00ff; border-radius: 50%; color: #fff;"
                            href="https://tmc.doh.gov.ph/"
                            class="btn "
                            target="_new"
                            ><i class="fa fa-globe fa-lg" aria-hidden="true">
                            </i>
                        </a>
                        <a
                            style="padding: 4px 9px; background: #ff00ff; border-radius: 50%; color: #fff"
                            href="https://www.facebook.com/tondomed"
                            class="btn "
                            target="_new"
                            ><i
                                class="fa fa-facebook-square"
                                aria-hidden="true"
                            ></i>
                        </a>
                        <a
                            style="padding: 4px 9px; background: #ff00ff; border-radius: 50%; color: #fff"
                            class="btn "
                            @click="handleVideoClicked"
                            ><i
                                class="fa fa-youtube-play"
                                aria-hidden="true"
                            ></i>
                            <!-- href="https://youtu.be/SbKw4dRlCRw" -->
                        </a>
                    </h1>

                    <!-- event info-->
                    <Transition>
                        <div v-if="eventInfo">
                            <Modal
                                :value="eventInfo"
                                :modalSize="'modal-xl'"
                                :vh="true"
                            >
                                <template v-slot:title>
                                    <h3
                                        class="display-4 mt-3 text-dark"
                                        style="font-size: 2em; text-align: center;"
                                    >
                                        {{ eventInfo.name }}
                                    </h3>
                                    <br />
                                </template>
                                <br />
                                <template v-slot:body>
                                    <div
                                        class="embed-responsive embed-responsive-16by9"
                                        style="height: 100%;"
                                    >
                                        <iframe
                                            class="embed-responsive-item"
                                            :src="
                                                `https://docs.google.com/viewerng/viewer?url=${eventInfo.path}&embedded=true`
                                            "
                                            allowfullscreen
                                        ></iframe>
                                    </div>
                                </template>
                                <template v-slot:footer>
                                    <button
                                        class="btn btn-primary btn-lg"
                                        type="button"
                                        @click="eventInfo = ''"
                                    >
                                        Done
                                    </button>
                                </template>
                            </Modal>
                        </div>
                    </Transition>
                </div>
            </div>
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
                                src="/images/71st_logo.png"
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
                                style="color: #FFF; font-weight: 300"
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

        <Transition>
            <div>
                <Modal :value="showRegistrationModal" :modalSize="'modal-lg'">
                    <template v-slot:title>
                        <img
                            style="width: 10vw;"
                            src="/images/71st_logo.png"
                            alt=""
                            class="center_logo mt-3 d-none d-md-block"
                        />
                        <h3
                            class="display-4 mt-3 text-dark"
                            style="font-size: 2em; text-align: center;"
                        >
                            Registration
                        </h3>
                        <br />
                    </template>
                    <br />
                    <template v-slot:body>
                        <Registration
                            @handleSuccessRegistration="
                                handleSuccessRegistration
                            "
                            @handleCancelClicked="handleCancelClicked"
                        />
                    </template>
                </Modal>
            </div>
        </Transition>

        <Transition>
            <div>
                <Modal :value="showVideoModal" :modalSize="'modal-lg'">
                    <!-- <template v-slot:title>
                        <img
                            style="width: 10vw;"
                            src="/images/71st_logo.png"
                            alt=""
                            class="center_logo mt-3 d-none d-md-block"
                        />
                        <h3
                            class="display-4 mt-3 text-dark"
                            style="font-size: 2em; text-align: center;"
                        >
                            Department of OB Gyn of Tondo Medical Center
                        </h3>
                        <br />
                    </template>
                    <br /> -->
                    <template v-slot:body>
                        <iframe
                            width="100%"
                            height="486"
                            :src="utube"
                            title="Department of OB Gyn of Tondo Medical Center"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen
                        >
                        </iframe>
                    </template>

                    <template v-slot:footer>
                        <button
                            class="btn btn-danger"
                            type="button"
                            @click="handleVideoClose"
                        >
                            Close
                        </button>
                    </template>
                </Modal>
            </div>
        </Transition>

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
                                            placeholder="Enter email address"
                                            v-model="text_email"
                                            required
                                        />
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

                                        <!-- remove forgot password -->
                                        <!-- <div class="form-group float-right">
                                            <router-link
                                                :to="'/password-remind'"
                                                class=" text-light"
                                                style="font-style: italic; opacity: 0.4;"
                                                >Forgot Password?</router-link
                                            >
                                        </div> -->
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- remove privacy_clause -->
                        <!-- <div class="d-flex justify-content-center">
                            <div class="data_use_clause">
                                <p
                                    class="clause text-light lead"
                                    v-html="privacy_clause"
                                ></p>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Timer from "./Timer.vue";
import Modal from "./Modal";
import Registration from "./Registration";
export default {
    components: {
        Timer,
        Modal,
        Registration
    },
    created() {
        this.init();
        const venue1 = "images/Venue1.mp4";
        const venue2 = "images/Venue2.mp4";
        if (localStorage.getItem("access_token")) {
            this.$router.push("/");
        }
        // console.log(this.$store.getters.pois)
    },
    data() {
        return {
            eventInfo: null,
            eventInfos: [
                {
                    id: 1,
                    name: "Program",
                    path: window.location.origin + "/documents/tmc-program.pdf"
                },
                {
                    id: 2,
                    name: "Speakers",
                    path: window.location.origin + "/documents/tmc-speakers.pdf"
                },
                {
                    id: 3,
                    name: "Contact us",
                    path: window.location.origin + "/documents/tmc-contact.pdf"
                }
            ],
            showRegistrationModal: false,
            showVideoModal: false,
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
                'Note: You will be entitled to join the 2nd Postgraduate Course raffle draw if you are able to visit all the booths. However, please refrain from visiting the booths or any particular booth if you do not wish to share your contact details to them.  Virtual booth visit happens when you click <banner class=\' text-success\'><i class="fa fa-sign-in" aria-hidden="true"></i></banner> icon on the booth.',
            agreement:
                "I accept that when I visit the booths inside the virtual venue, my contact details will be accessible to the event sponsors and that I may be reached for promotion of their products.",
            agree: false,
            videoAutoplay: true,
            videos: ["images/Venue1.mp4", "images/Venue2.mp4"],
            videoSrc: "images/Venue1.mp4",

            welcomeMessage: "Welcome to our 2nd Postgraduate Course",
            letsGoButtonClicked: false,
            utube: null
        };
    },
    watch: {},

    methods: {
        handleChangeEventInfoModal(infoId) {
            const info = this.eventInfos.find(e => e.id === infoId);
            this.eventInfo = info;
        },
        handleCancelClicked() {
            this.showRegistrationModal = !this.showRegistrationModal;
        },
        handleSuccessRegistration(e) {
            this.showRegistrationModal = !e;
        },
        handleRegisterClicked() {
            this.showRegistrationModal = true;
        },
        handleVideoClicked() {
            this.showVideoModal = true;
            this.utube =
                "https://www.youtube.com/embed/SbKw4dRlCRw?autoplay=0&rel=0";
        },
        handleVideoClose() {
            this.showVideoModal = false;
            this.utube = "";
        },
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
            fd.append("email_address", this.text_email);
            // fd.append("password", this.text_password);
            let { data } = await axios.post("/api/login", fd);
            if (data.status === "ok") {
                // this.show = !this.show;
                this.isLoginSuccess = true;
                this.$emit("isLoginSuccess", this.isLoginSuccess);
                this.$store.commit("changeUser", data.user);
                // this.$store.commit("updateAudioSource", "/bgm/landing.mp3");

                localStorage.setItem("access_token", data.access_token);
                localStorage.setItem("sceneId", "lobby");
                localStorage.setItem("bgmStatus", true);
                // setTimeout(() => {
                //     this.show = !this.show;
                // }, 500);
                //
                // this.videoSrc = this.videos.at(1);
                // this.videoAutoplay = !this.videoAutoplay;
                // this.$refs.videoRef.play();
                // this.videoSrc = this.videos.at(1);

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
            // this.$refs.videoRef.play();
            // this.$refs.videoRef.loop = false;
            this.$router.push("/");
        },
        videoEnded() {
            this.$router.push("/");
            this.$store.commit("updateBgmStart", true);
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
.hover {
    --s: 0.2em; /* the thickness of the line */
    --c: #ff00ff; /* the color */

    color: #0000;
    padding-bottom: var(--s);
    background: linear-gradient(90deg, var(--c) 50%, #000 0)
            calc(100% - var(--_p, 0%)) / 200% 100%,
        linear-gradient(var(--c) 0 0) 0% 100% / var(--_p, 0%) var(--s) no-repeat;
    -webkit-background-clip: text, padding-box;
    background-clip: text, padding-box;
    transition: 0.5s;
}
.hover:hover {
    --_p: 100%;
}
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
    top: 0;
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

/* new styles */
.event_info .card {
    background: linear-gradient(#45007c, #8801a3) !important;
    /* background: linear-gradient(#45007c, #45007c) !important; */
    /* opacity: 0.9; */
    border-radius: 0;
    width: 450px;
}

.event_info .card-title {
    color: #ff00ff;
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen,
        Ubuntu, Cantarell, "Open Sans", "Helvetica Neue", sans-serif;
    font-size: 1.8rem;
    font-weight: 600;
    line-height: 1.5;
}

.event_info .card-body h1 {
    font-size: 1.8rem;
    font-weight: 300;
    line-height: 1.5;
}

.event_date_box {
    text-align: center;
    border: 1px solid #fff;
    padding: 0.2em;
    font-size: 1.2rem;
    font-weight: 600;
    line-height: 1.2;
    margin: 0 6rem;
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen,
        Ubuntu, Cantarell, "Open Sans", "Helvetica Neue", sans-serif;
}

.concerns{
    text-align: center;
    border: 1px solid #fff;
    padding: 0.2em;
    font-size: 1.2rem;
    font-weight: 300;
    line-height: 1.2;
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen,
        Ubuntu, Cantarell, "Open Sans", "Helvetica Neue", sans-serif;
}

.border_bot {
    margin: 0 20px;
    border-bottom: 2px solid #ccc;
}

.btn_pink {
    color: #fff;
    padding: 0.3em 0;
    border: 1px solid #770077;
    font-size: 2.4rem;
    font-weight: 600;
    border-radius: 0.1em;
    background: #ff3bff;
}
.lead {
    font-size: 1.32875rem;
    font-weight: 600;
    color: #fff;
}

.lead a {
    font-size: 1.32875rem;
    font-weight: 600;
    color: #ff00ff;
}

.event_info_footer {
    padding: 0 2.188rem 3rem;
}

.event_info_footer a {
    font-size: 1.32875rem;
    font-weight: 600;
    color: #fff;
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

/* new media */
@media screen and (min-width: 280px) and (max-width: 415px) {
    .event_info .card-title {
        font-size: 0.5rem;
    }

    .event_info .card-body h1 {
        font-size: 0.88rem;
        line-height: 1.1;
    }

    .event_date_box {
        text-align: center;
        border: 1px solid #fff;
        /* padding: 2.1999999999999993em; */
        font-size: 0.5rem;
        font-weight: 600;
        line-height: 1.2;
        margin: 0;
    }
    .concerns{
        text-align: center;
        border: 1px solid #fff;
        /* padding: 2.1999999999999993em; */
        font-size: 0.5rem;
        font-weight: 300;
    }

    .btn_pink {
        font-size: 1rem;
        margin-top: 1rem !important;
    }

    .lead {
        font-size: 0.55rem;
    }

    .lead a {
        font-size: 0.55rem;
        position: relative;
    }

    .event_info_footer {
        padding: 0;
    }

    .event_info .card {
        width: 220px;
    }
}

@media screen and (min-height: 599px) and (max-height: 720px) {
    .event_info .card {
        width: 320px;
    }

    .event_info .card-title {
        font-size: 0.5rem;
    }

    .event_info .card-body h1 {
        font-size: 0.88rem;
        line-height: 1.1;
    }

    .event_date_box {
        text-align: center;
        border: 1px solid #fff;
        font-size: 0.5rem;
        font-weight: 600;
        line-height: 1.2;
        margin: 0;
    }
    .concerns {
        text-align: center;
        border: 1px solid #fff;
        font-size: 0.5rem;
        font-weight: 300;
    }

    .btn_pink {
        font-size: 1rem;
        margin-top: 1rem !important;
    }

    .lead {
        font-size: 0.55rem;
    }

    .lead a {
        font-size: 0.55rem;
        position: relative;
    }

    .event_info_footer {
        padding: 0;
    }
}

@media (max-width: 320px) {
    .event_info .card {
        width: 220px;
    }
}

@media screen and (min-width: 980px) and (max-width: 1281px) {
    .event_info .card {
        width: 300px;
    }

    .event_info .card-title {
        font-size: 1.2rem;
    }

    .event_info .card-body h1 {
        font-size: 1.2rem;
        line-height: 1.3;
    }

    .event_date_box {
        text-align: center;
        border: 1px solid #fff;
        font-size: 0.9rem;
        font-weight: 600;
        line-height: 1.2;
        margin: 0 3rem;
    }
    .concerns {
        text-align: center;
        border: 1px solid #fff;
        font-size: 0.9rem;
        font-weight: 300;
    }

    .btn_pink {
        font-size: 1.3rem;
        margin-top: 3rem !important;
    }

    .lead {
        font-size: 0.95rem;
    }

    .lead a {
        font-size: 0.95rem;
        position: relative;
    }

    .event_info_footer {
        padding: 0;
    }

    .video-container video {
        height: 85%;
    }
}

@media screen and (max-width:1024px) and (-webkit-min-device-pixel-ratio:0){
    .concerns {
        text-align: center;
        border: 1px solid #fff;
        font-size: 0.7rem;
        font-weight: 300;
    }

    .event_info .card-title {
        font-size: 0.8rem;
    }

    .event_info .card-body h1 {
        font-size: 0.88rem;
        line-height: 1.1;
    }

    .event_date_box {
        text-align: center;
        border: 1px solid #fff;
        font-size: 0.5rem;
        font-weight: 600;
        line-height: 1.2;
        margin: 0;
    }

    .btn_pink {
        font-size: 1rem;
        margin-top: 1rem !important;
    }

    .lead {
        font-size: 0.55rem;
    }

    .lead a {
        font-size: 0.55rem;
        position: relative;
    }

    .event_info_footer {
        padding: 0;
    }
}

/* @media screen and (min-width: 851px){
    .video-container video{
        height: 85% !important;
    }
} */
.marqee {
    background-color: rgb(255 255 255 / 40%);
    /* color: #212529;  */
    color: blue;
    font-size: 1.2rem;
    position: absolute;
    bottom: 50px;
    left: 0;
}
</style>
