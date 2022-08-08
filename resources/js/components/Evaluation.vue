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
                    <div v-if="current_step === item.id">
                        <p class="card-text">
                            {{ item.question }}
                        </p>

                        <!-- id#1 -->
                        <div v-if="item.id === 1">
                            <div
                                v-for="(subQuestion,
                                index) in item.subQuestions"
                                :key="index"
                                style="display: flex; flex-direction: row"
                                class="mt-2"
                            >
                                <div class="col-md col-sm-12">
                                    <div
                                        class="form-check form-check-inline "
                                        v-for="(item, index) in 4"
                                        :key="index"
                                    >
                                        <input
                                            class="form-check-input"
                                            type="radio"
                                            :name="
                                                `radio-${subQuestion.id}${item}`
                                            "
                                            :id="
                                                `radio-${subQuestion.id}${item}`
                                            "
                                            :value="item"
                                            v-model="
                                                radio_answers[subQuestion.id]
                                            "
                                        />
                                        <label
                                            class="form-check-label"
                                            :for="
                                                `radio-${subQuestion.id}${item}`
                                            "
                                        >
                                            {{ item }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- id#2 -->
                        <div v-if="item.id === 2">
                            <div
                                v-for="(subQuestion,
                                index) in item.subQuestions"
                                :key="index"
                                style="display: flex; flex-direction: row"
                                class="mt-2"
                            >
                                <div class="col-md col-sm-12">
                                    <div
                                        class="form-check form-check-inline "
                                        v-for="(item, index) in 4"
                                        :key="index"
                                    >
                                        <input
                                            class="form-check-input"
                                            type="radio"
                                            :name="
                                                `radio-${subQuestion.id}${item}`
                                            "
                                            :id="
                                                `radio-${subQuestion.id}${item}`
                                            "
                                            :value="item"
                                            v-model="
                                                radio_answers[subQuestion.id]
                                            "
                                        />
                                        <label
                                            class="form-check-label"
                                            :for="
                                                `radio-${subQuestion.id}${item}`
                                            "
                                        >
                                            {{ item }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- id#3 -->
                        <div v-if="item.id === 3">
                            <div
                                v-for="(subQuestion,
                                index) in item.subQuestions"
                                :key="index"
                                style="display: flex; flex-direction: row"
                                class="mt-2"
                            >
                                <div class="mr-3 col-md-2 col-sm-12">
                                    {{ subQuestion.question }}:
                                </div>
                                <div class="col-md col-sm-12">
                                    <div
                                        class="form-check form-check-inline "
                                        v-for="(item, index) in 4"
                                        :key="index"
                                    >
                                        <input
                                            class="form-check-input"
                                            type="radio"
                                            :name="
                                                `radio-${subQuestion.id}${item}`
                                            "
                                            :id="
                                                `radio-${subQuestion.id}${item}`
                                            "
                                            :value="item"
                                            v-model="
                                                radio_answers[subQuestion.id]
                                            "
                                        />
                                        <label
                                            class="form-check-label"
                                            :for="
                                                `radio-${subQuestion.id}${item}`
                                            "
                                        >
                                            {{ item }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- id#4 -->
                        <div v-if="item.id === 4">
                            <div
                                v-for="(subQuestion,
                                index) in item.subQuestions"
                                :key="index"
                                style="display: flex; flex-direction: row"
                                class="mt-2"
                            >
                                <div class="mr-3 col-md-5 col-xs-12">
                                    {{ subQuestion.question }}:
                                </div>
                                <div class="col-md col-xs-12">
                                    <div
                                        class="form-check form-check-inline "
                                        v-for="(item, index) in 4"
                                        :key="index"
                                    >
                                        <input
                                            class="form-check-input"
                                            type="radio"
                                            :name="
                                                `radio-${subQuestion.id}${item}`
                                            "
                                            :id="
                                                `radio-${subQuestion.id}${item}`
                                            "
                                            :value="item"
                                            v-model="
                                                radio_answers[subQuestion.id]
                                            "
                                        />
                                        <label
                                            class="form-check-label"
                                            :for="
                                                `radio-${subQuestion.id}${item}`
                                            "
                                        >
                                            {{ item }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- id#5 -->
                        <div v-if="item.id === 5">
                            <div
                                v-for="(subQuestion,
                                index) in item.subQuestions"
                                :key="index"
                                style="display: flex; flex-direction: row"
                                class="mt-2"
                            >
                                <div class="mr-3 col-md-5 col-xs-12">
                                    {{ subQuestion.question }}:
                                </div>
                                <div class="col-md col-xs-12">
                                    <div
                                        class="form-check form-check-inline "
                                        v-for="(item, index) in 4"
                                        :key="index"
                                    >
                                        <input
                                            class="form-check-input"
                                            type="radio"
                                            :name="
                                                `radio-${subQuestion.id}${item}`
                                            "
                                            :id="
                                                `radio-${subQuestion.id}${item}`
                                            "
                                            :value="item"
                                            v-model="
                                                radio_answers[subQuestion.id]
                                            "
                                        />
                                        <label
                                            class="form-check-label"
                                            :for="
                                                `radio-${subQuestion.id}${item}`
                                            "
                                        >
                                            {{ item }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- id#6 -->
                        <div v-if="item.id === 6">
                            <div
                                v-for="(subQuestion,
                                index) in item.subQuestions"
                                :key="index"
                                style="display: flex; flex-direction: row"
                                class="mt-2"
                            >
                                <div class="mr-3 col-md-5 col-xs-12">
                                    {{ subQuestion.question }}:
                                </div>
                                <div class="col-md col-xs-12">
                                    <div
                                        class="form-check form-check-inline "
                                        v-for="(item, index) in 4"
                                        :key="index"
                                    >
                                        <input
                                            class="form-check-input"
                                            type="radio"
                                            :name="
                                                `radio-${subQuestion.id}${item}`
                                            "
                                            :id="
                                                `radio-${subQuestion.id}${item}`
                                            "
                                            :value="item"
                                            v-model="
                                                radio_answers[subQuestion.id]
                                            "
                                        />
                                        <label
                                            class="form-check-label"
                                            :for="
                                                `radio-${subQuestion.id}${item}`
                                            "
                                        >
                                            {{ item }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- id#7 -->
                        <div v-if="item.id === 7">
                            <div
                                v-for="(subQuestion,
                                index) in item.subQuestions"
                                :key="index"
                                style="display: flex; flex-direction: row"
                                class="mt-2"
                            >
                                <div class="mr-3 col-md-5 col-xs-12">
                                    {{ subQuestion.question }}:
                                </div>
                                <div class="col-md col-xs-12">
                                    <div
                                        class="form-check form-check-inline "
                                        v-for="(item, index) in 4"
                                        :key="index"
                                    >
                                        <input
                                            class="form-check-input"
                                            type="radio"
                                            :name="
                                                `radio-${subQuestion.id}${item}`
                                            "
                                            :id="
                                                `radio-${subQuestion.id}${item}`
                                            "
                                            :value="item"
                                            v-model="
                                                radio_answers[subQuestion.id]
                                            "
                                        />
                                        <label
                                            class="form-check-label"
                                            :for="
                                                `radio-${subQuestion.id}${item}`
                                            "
                                        >
                                            {{ item }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- id#8 -->
                        <div v-if="item.id === 8">
                            <div
                                v-for="(subQuestion,
                                index) in item.subQuestions"
                                :key="index"
                                style="display: flex; flex-direction: row"
                                class="mt-2"
                            >
                                <div class="mr-3 col-md-5 col-xs-12">
                                    {{ subQuestion.question }}:
                                </div>
                                <div class="col-md col-xs-12">
                                    <div
                                        class="form-check form-check-inline "
                                        v-for="(item, index) in 4"
                                        :key="index"
                                    >
                                        <input
                                            class="form-check-input"
                                            type="radio"
                                            :name="
                                                `radio-${subQuestion.id}${item}`
                                            "
                                            :id="
                                                `radio-${subQuestion.id}${item}`
                                            "
                                            :value="item"
                                            v-model="
                                                radio_answers[subQuestion.id]
                                            "
                                        />
                                        <label
                                            class="form-check-label"
                                            :for="
                                                `radio-${subQuestion.id}${item}`
                                            "
                                        >
                                            {{ item }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- id#9 -->
                        <div v-if="item.id === 9">
                            <div
                                v-for="(subQuestion,
                                index) in item.subQuestions"
                                :key="index"
                                style="display: flex; flex-direction: row"
                                class="mt-2"
                            >
                                <div class="mr-3 col-md-5 col-xs-12">
                                    {{ subQuestion.question }}:
                                </div>
                                <div class="col-md col-xs-12">
                                    <div
                                        class="form-check form-check-inline "
                                        v-for="(item, index) in 4"
                                        :key="index"
                                    >
                                        <input
                                            class="form-check-input"
                                            type="radio"
                                            :name="
                                                `radio-${subQuestion.id}${item}`
                                            "
                                            :id="
                                                `radio-${subQuestion.id}${item}`
                                            "
                                            :value="item"
                                            v-model="
                                                radio_answers[subQuestion.id]
                                            "
                                        />
                                        <label
                                            class="form-check-label"
                                            :for="
                                                `radio-${subQuestion.id}${item}`
                                            "
                                        >
                                            {{ item }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- id#10-->
                        <div v-if="item.id === 10">
                            <div
                                v-for="(subQuestion,
                                index) in item.subQuestions"
                                :key="index"
                                style="display: flex; flex-direction: row"
                                class="mt-2"
                            >
                                <div class="mr-3 col-md-5 col-xs-12">
                                    {{ subQuestion.question }}:
                                </div>
                                <div class="col-md col-xs-12">
                                    <div
                                        class="form-check form-check-inline "
                                        v-for="(item, index) in 4"
                                        :key="index"
                                    >
                                        <input
                                            class="form-check-input"
                                            type="radio"
                                            :name="
                                                `radio-${subQuestion.id}${item}`
                                            "
                                            :id="
                                                `radio-${subQuestion.id}${item}`
                                            "
                                            :value="item"
                                            v-model="
                                                radio_answers[subQuestion.id]
                                            "
                                        />
                                        <label
                                            class="form-check-label"
                                            :for="
                                                `radio-${subQuestion.id}${item}`
                                            "
                                        >
                                            {{ item }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- id#11-->
                        <div v-if="item.id === 11" class="form-group">
                            <input
                                class="form-control"
                                type="text"
                                v-model="radio_answers[item.subQuestions[0].id]"
                            />
                        </div>
                        <!-- id#12-->
                        <div v-if="item.id === 12" class="form-group">
                            <input
                                class="form-control"
                                type="text"
                                v-model="radio_answers[item.subQuestions[0].id]"
                            />
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button
                    class="btn btn-danger"
                    type="button"
                    @click="onClickBack"
                    v-if="current_step < questionnaires.length"
                    :disabled="current_step <= 1"
                >
                    Back
                </button>
                <button
                    class="btn btn-primary"
                    type="button"
                    @click="onClickNext"
                    v-if="current_step < questionnaires.length"
                    :disabled="handleDisable"
                >
                    Next
                </button>
                <button
                    class="btn btn-success"
                    type="button"
                    v-else
                    @click="handleSubmit"
                >
                    Submit
                </button>
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
                    subQuestions: [{ id: 1, question: "" }]
                },
                {
                    id: 2,
                    question:
                        "How relevant and helpful do you think it was for your job?",
                    subQuestions: [{ id: 2, question: "" }]
                },
                {
                    id: 3,
                    question: "How satisfied were you with the logistics?",
                    subQuestions: [
                        { id: 3, question: "Registration" },
                        { id: 4, question: "Virtual Platform" },
                        { id: 5, question: "Topics" }
                    ]
                },
                {
                    id: 4,
                    question:
                        "Walfrido W. Sumpaico, MD -  Breaking News: Newest predictors of preeclampsia",
                    subQuestions: [
                        { id: 6, question: "I learned a lot from the speaker" },
                        {
                            id: 7,
                            question:
                                "The lecture was organized with excellent visual aids/presentation."
                        },
                        { id: 8, question: "The content objectives were met" },
                        {
                            id: 9,
                            question: "The lecture is relevant to my practice"
                        }
                    ]
                },
                {
                    id: 5,
                    question:
                        "Catherine Joie Carelle R. Ong, MD -  Pre-term birth prevention",
                    subQuestions: [
                        {
                            id: 10,
                            question: "I learned a lot from the speaker"
                        },
                        {
                            id: 11,
                            question:
                                "The lecture was organized with excellent visual aids/presentation."
                        },
                        { id: 12, question: "The content objectives were met" },
                        {
                            id: 13,
                            question: "The lecture is relevant to my practice"
                        }
                    ]
                },

                {
                    id: 6,
                    question:
                        "Katherine Angelo-Dela Cruz, MD - Updated CDC STI Guidelines 2021",
                    subQuestions: [
                        {
                            id: 14,
                            question: "I learned a lot from the speaker"
                        },
                        {
                            id: 15,
                            question:
                                "The lecture was organized with excellent visual aids/presentation."
                        },
                        { id: 16, question: "The content objectives were met" },
                        {
                            id: 17,
                            question: "The lecture is relevant to my practice"
                        }
                    ]
                },
                {
                    id: 7,
                    question:
                        "Allen Gideon R. Tan, MD - PCOS in the Adolescent",
                    subQuestions: [
                        {
                            id: 18,
                            question: "I learned a lot from the speaker"
                        },
                        {
                            id: 19,
                            question:
                                "The lecture was organized with excellent visual aids/presentation."
                        },
                        { id: 20, question: "The content objectives were met" },
                        {
                            id: 21,
                            question: "The lecture is relevant to my practice"
                        }
                    ]
                },
                {
                    id: 8,
                    question:
                        "Irene. M. Tagayuna, MD - New Cervical Cancer Screening Guidelines and Transitioning into HPV Test",
                    subQuestions: [
                        {
                            id: 22,
                            question: "I learned a lot from the speaker"
                        },
                        {
                            id: 23,
                            question:
                                "The lecture was organized with excellent visual aids/presentation."
                        },
                        { id: 24, question: "The content objectives were met" },
                        {
                            id: 25,
                            question: "The lecture is relevant to my practice"
                        }
                    ]
                },
                {
                    id: 9,
                    question:
                        "Andrea C. Santiago, MD - Management of Pelvic Organ Prolapse: A Case-Based Approach",
                    subQuestions: [
                        {
                            id: 26,
                            question: "I learned a lot from the speaker"
                        },
                        {
                            id: 27,
                            question:
                                "The lecture was organized with excellent visual aids/presentation."
                        },
                        { id: 28, question: "The content objectives were met" },
                        {
                            id: 29,
                            question: "The lecture is relevant to my practice"
                        }
                    ]
                },
                {
                    id: 10,
                    question:
                        "Darlene Minette C. Zamora, MD - Accidental injuries in Children",
                    subQuestions: [
                        {
                            id: 30,
                            question: "I learned a lot from the speaker"
                        },
                        {
                            id: 31,
                            question:
                                "The lecture was organized with excellent visual aids/presentation."
                        },
                        { id: 32, question: "The content objectives were met" },
                        {
                            id: 33,
                            question: "The lecture is relevant to my practice"
                        }
                    ]
                },
                {
                    id: 11,
                    question: "What is your overall feedback for the event?",
                    subQuestions: [{ id: 34, question: "" }]
                },
                {
                    id: 12,
                    question: "Name (to appear on the Certificate)",
                    subQuestions: [{ id: 35, question: "" }]
                }
            ]
        };
    },
    methods: {
        async handleSubmit() {
            const api = "api/v1/booths/44/questionnaire/answer/submit";
            const fd = new FormData();
            fd.append("answers", this.radio_answers);
            try {
                const { data } = await axios.post(api, fd);
                console.log(data);
            } catch ({ response }) {
                alert(response.statusText);
            }
        },
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
        },
        handleDisable() {
            let step = this.questionnaires.find(
                q => q.id === this.current_step
            );

            // step.subQuestions.flatMap(q =>
            //     console.log(this.radio_answers[q.id])
            // );
            // if (step.subQuestions.some(q => this.radio_answers[q.id]))
            //     return false;
            // else return true;
            for (let i of step.subQuestions) {
                if (this.radio_answers[i.id] === undefined) {
                    return true;
                } else {
                    return false;
                }
            }
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
