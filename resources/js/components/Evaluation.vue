<template>
    <div class="container mt-3">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Event Feedback</h3>
                <p class="font-weight-bold">
                    Thank you for attending our 2nd Postgraduate Course. We hope
                    you take time to answer the evaluation form.
                </p>
                <p class="font-weight-bold mt-3">
                    We want to hear your feedback to help us improve. Please
                    fill this quick survey and let us know your thoughts.
                </p>
            </div>
        </div>
        <div class="progress mt-1">
            <div
                class="progress-bar progress-bar-striped progress-bar-animated"
                role="progressbar"
                :aria-valuenow="progress"
                aria-valuemin="0"
                aria-valuemax="100"
                :style="
                    `width: ${
                        current_step === questionnaires.length ? 100 : progress
                    }%;`
                "
            >
                {{ current_step === questionnaires.length ? 100 : progress }}%
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div v-for="(item, index) in questionnaires" :key="index">
                    <div v-if="current_step === index + 1">
                        <p class="card-text">
                            {{ item.question }}
                        </p>
                        <div
                            style="display: flex; flex-direction: row"
                            class="mt-2"
                        >
                            <div v-if="item.subQuestion" class="mr-3">
                                {{ item.subQuestion }}:
                            </div>
                            <div
                                class="form-check form-check-inline"
                                v-for="(item, index) in 4"
                                :key="index"
                            >
                                <input
                                    class="form-check-input"
                                    type="radio"
                                    name="exampleRadios"
                                    :id="item"
                                    :value="item"
                                    v-model="radio_answers[current_step]"
                                />
                                <label class="form-check-label" :for="item">
                                    {{ item }}
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button
                    class="btn btn-primary"
                    type="button"
                    @click="onClickNext"
                    v-if="current_step < questionnaires.length"
                >
                    Next
                </button>
                <button class="btn btn-success" type="button" v-else>
                    Submit
                </button>
                <pre>{{ radio_answers }}</pre>
            </div>
        </div>
        <!--
        -->
    </div>
</template>
<script>
export default {
    data() {
        return {
            radio_answers: {},
            current_step: 1,
            questionnaires: [
                {
                    id: 1,
                    question: "How satisfied were you with the event?",
                    subQuestion: null
                },
                {
                    id: 2,
                    question:
                        "How relevant and helpful do you think it was for your job?",
                    subQuestion: null
                },
                {
                    id: 3,
                    question: "How satisfied were you with the logistics?",
                    subQuestion: "Registration"
                },
                {
                    id: 4,
                    question: "How satisfied were you with the logistics?",
                    subQuestion: "Virtual Platform"
                },
                {
                    id: 5,
                    question: "How satisfied were you with the logistics?",
                    subQuestion: "Topics"
                },
                {
                    id: 6,
                    question:
                        "Walfrido W. Sumpaico, MD -  Breaking News: Newest predictors of preeclampsia",
                    subQuestion: "I learned a lot from the speaker"
                },
                {
                    id: 7,
                    question:
                        "Walfrido W. Sumpaico, MD -  Breaking News: Newest predictors of preeclampsia",
                    subQuestion:
                        "The lecture was organized with excellent visual aids/presentation."
                },
                {
                    id: 8,
                    question:
                        "Walfrido W. Sumpaico, MD -  Breaking News: Newest predictors of preeclampsia",
                    subQuestion: "The content objectives were met"
                },
                {
                    id: 9,
                    question:
                        "Walfrido W. Sumpaico, MD -  Breaking News: Newest predictors of preeclampsia",
                    subQuestion: "The lecture is relevant to my practice"
                },
                {
                    id: 10,
                    question:
                        "Catherine Joie Carelle R. Ong, MD -  Pre-term birth prevention",
                    subQuestion: "I learned a lot from the speaker"
                },
                {
                    id: 11,
                    question:
                        "Catherine Joie Carelle R. Ong, MD -  Pre-term birth prevention",
                    subQuestion:
                        "The lecture was organized with excellent visual aids/presentation."
                },
                {
                    id: 12,
                    question:
                        "Catherine Joie Carelle R. Ong, MD -  Pre-term birth prevention",
                    subQuestion: "The content objectives were met"
                },
                {
                    id: 13,
                    question:
                        "Catherine Joie Carelle R. Ong, MD -  Pre-term birth prevention",
                    subQuestion: "The lecture is relevant to my practice"
                },
                {
                    id: 14,
                    question:
                        "Katherine Angelo-Dela Cruz, MD - Updated CDC STI Guidelines 2021",
                    subQuestion: "I learned a lot from the speaker"
                },
                {
                    id: 15,
                    question:
                        "Katherine Angelo-Dela Cruz, MD - Updated CDC STI Guidelines 2021",
                    subQuestion:
                        "The lecture was organized with excellent visual aids/presentation."
                },
                {
                    id: 16,
                    question:
                        "Katherine Angelo-Dela Cruz, MD - Updated CDC STI Guidelines 2021",
                    subQuestion: "The content objectives were met"
                },
                {
                    id: 17,
                    question:
                        "Katherine Angelo-Dela Cruz, MD - Updated CDC STI Guidelines 2021",
                    subQuestion: "The lecture is relevant to my practice"
                },
                {
                    id: 18,
                    question:
                        "Allen Gideon R. Tan, MD - PCOS in the Adolescent",
                    subQuestion: "I learned a lot from the speaker"
                },
                {
                    id: 19,
                    question:
                        "Allen Gideon R. Tan, MD - PCOS in the Adolescent",
                    subQuestion:
                        "The lecture was organized with excellent visual aids/presentation."
                },
                {
                    id: 20,
                    question:
                        "Allen Gideon R. Tan, MD - PCOS in the Adolescent",
                    subQuestion: "The content objectives were met"
                },
                {
                    id: 21,
                    question:
                        "Allen Gideon R. Tan, MD - PCOS in the Adolescent",
                    subQuestion: "The lecture is relevant to my practice"
                },
                {
                    id: 22,
                    question:
                        "Irene. M. Tagayuna, MD - New Cervical Cancer Screening Guidelines and Transitioning into HPV Test",
                    subQuestion: "I learned a lot from the speaker"
                },
                {
                    id: 23,
                    question:
                        "Irene. M. Tagayuna, MD - New Cervical Cancer Screening Guidelines and Transitioning into HPV Test",
                    subQuestion:
                        "The lecture was organized with excellent visual aids/presentation."
                },
                {
                    id: 24,
                    question:
                        "Irene. M. Tagayuna, MD - New Cervical Cancer Screening Guidelines and Transitioning into HPV Test",
                    subQuestion: "The content objectives were met"
                },
                {
                    id: 25,
                    question:
                        "Irene. M. Tagayuna, MD - New Cervical Cancer Screening Guidelines and Transitioning into HPV Test",
                    subQuestion: "The lecture is relevant to my practice"
                },
                {
                    id: 26,
                    question:
                        "Andrea C. Santiago, MD - Management of Pelvic Organ Prolapse: A Case-Based Approach",
                    subQuestion: "I learned a lot from the speaker"
                },
                {
                    id: 27,
                    question:
                        "Andrea C. Santiago, MD - Management of Pelvic Organ Prolapse: A Case-Based Approach",
                    subQuestion:
                        "The lecture was organized with excellent visual aids/presentation."
                },
                {
                    id: 28,
                    question:
                        "Andrea C. Santiago, MD - Management of Pelvic Organ Prolapse: A Case-Based Approach",
                    subQuestion: "The content objectives were met"
                },
                {
                    id: 29,
                    question:
                        "Andrea C. Santiago, MD - Management of Pelvic Organ Prolapse: A Case-Based Approach",
                    subQuestion: "The lecture is relevant to my practice"
                },
                {
                    id: 30,
                    question:
                        "Darlene Minette C. Zamora, MD - Accidental injuries in Children",
                    subQuestion: "I learned a lot from the speaker"
                },
                {
                    id: 31,
                    question:
                        "Darlene Minette C. Zamora, MD - Accidental injuries in Children",
                    subQuestion:
                        "The lecture was organized with excellent visual aids/presentation."
                },
                {
                    id: 32,
                    question:
                        "Darlene Minette C. Zamora, MD - Accidental injuries in Children",
                    subQuestion: "The content objectives were met"
                },
                {
                    id: 33,
                    question:
                        "Darlene Minette C. Zamora, MD - Accidental injuries in Children",
                    subQuestion: "The lecture is relevant to my practice"
                }
            ]
        };
    },
    methods: {
        handleBackToLobby() {
            this.$router.push({ name: "home" });
        },
        onClickNext: function() {
            this.current_step++;
        },
        onClickBack: function() {
            this.current_step--;
        },
        onClickFirst: function() {
            this.current_step = 1;
        }
    },
    computed: {
        progress() {
            return (
                Math.round(100 / this.questionnaires.length) * this.current_step
            );
        }
    }
};
</script>
<style scoped>
div.background {
    top: 0;
    left: 0;
    position: fixed;
}

div.full {
    width: 100%;
    height: 100%;
}
div >>> .progress-bar {
    -webkit-transition: width 0.5s ease-in-out;
    -moz-transition: width 0.5s ease-in-out;
    -o-transition: width 0.5s ease-in-out;
    transition: width 0.5s ease-in-out;
}
</style>
