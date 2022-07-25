<template>
    <div class="">
        <div
            class="alert alert-success"
            role="alert"
            v-if="successRegistration"
        >
            Registered successfully.
        </div>
        <div class="alert alert-danger" role="alert" v-if="errors[0]">
            <ul>
                <li v-for="(item, index) in errors[0]" :key="index">
                    {{ item }}
                </li>
            </ul>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card border-primary mb-3">
                    <div class="card-body">
                        <form method="POST" @submit.prevent="handleSubmit">
                            <div class="row">
                                <div class="col-md-4 col-sm-12 ">
                                    <div class="form-group">
                                        <input
                                            type="text"
                                            class="form-control"
                                            placeholder="First Name *"
                                            v-model="text_fname"
                                            required
                                        />
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-12 ">
                                    <div class="form-group">
                                        <input
                                            type="text"
                                            class="form-control"
                                            placeholder="Middle Name *"
                                            v-model="text_mname"
                                            required
                                        />
                                    </div>
                                </div>

                                <div class="col-md-4 col-sm-12 ">
                                    <div class="form-group">
                                        <input
                                            type="text"
                                            class="form-control"
                                            placeholder="Last Name *"
                                            v-model="text_lname"
                                            required
                                        />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <input
                                            type="text"
                                            class="form-control"
                                            placeholder="PRC ID (if applicatble)"
                                            v-model="prc_id"
                                        />
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <input
                                            type="text"
                                            class="form-control"
                                            placeholder="Hospital Affiliation *"
                                            v-model="hospital_affiliation"
                                            required
                                        />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <input
                                                type="email"
                                                class="form-control"
                                                placeholder="Email address *"
                                                v-model="text_email"
                                                required
                                            />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <input
                                                type="email"
                                                class="form-control"
                                                placeholder="Confirm Email address
                                            *"
                                                v-model="text_cemail"
                                                required
                                            />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <input
                                                type="text"
                                                class="form-control"
                                                placeholder="Name on the Certificate *"
                                                v-model="text_name_on_cert"
                                                required
                                            />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <select
                                            id="my-select"
                                            class="custom-select"
                                            v-model="select_position"
                                            required
                                        >
                                            <option value=""
                                                >Choose Position...</option
                                            >
                                            <option value="Consultant">
                                                Consultant</option
                                            >
                                            <option value="Fellow-in-training">
                                                Fellow-in-training</option
                                            >
                                            <option value="Resident-in-Training">
                                                Resident-in-Training</option
                                            >
                                            <option
                                                value="Medical Clerk/Medical Intern"
                                            >
                                                Medical Clerk/Medical Intern</option
                                            >
                                            <option
                                                value="Nurse"
                                            >
                                                Nurse</option
                                            >
                                             <option
                                                value="Allied Health Care Worker"
                                            >
                                                Allied Health Care Worker</option
                                            >
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <div class="form-check">
                                            <input
                                                class="form-check-input"
                                                type="checkbox"
                                                v-model="disclaimer_checkbox"
                                                id="disclaimer1"
                                                value="disclaimer1"
                                                required
                                            />
                                            <label
                                                class="form-check-label"
                                                for="disclaimer1"
                                            >
                                                <small
                                                    >I understand that all
                                                    information I have provided
                                                    will be processed by the
                                                    account owner and host in
                                                    accordance to the Data
                                                    Privacy Act of 2012 <a class="ra_link" href="https://www.privacy.gov.ph/data-privacy-act/" target="_new">(RA
                                                    10173)</a></small
                                                >
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button
                                class="btn btn-primary"
                                type="submit"
                                :disabled="submitting"
                            >
                                Register
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    mounted() {
        // console.log(this.$store.getters.user)
    },
    data() {
        return {
            submitting: false,
            text_fname: "",
            text_mname: "",
            text_lname: "",
            prc_id: "",
            hospital_affiliation: "",
            text_email: "",
            text_cemail: "",
            text_name_on_cert: "",
            select_position: "",
            disclaimer_checkbox: [],

            errors: [],
            successRegistration: false
        };
    },
    watch: {},

    methods: {
        clearInputs() {
            this.text_fname = "";
            this.text_mname = "";
            this.text_lname = "";
            this.prc_id = "";
            this.hospital_affiliation = "";
            this.text_email = "";
            this.text_cemail = "";
            this.text_name_on_cert = "";
            this.select_position = "";
            this.disclaimer_checkbox = [];

            this.errors = [];
        },
        handleCancelClicked() {
            this.$emit("handleCancelClicked");
        },
        async handleSubmit() {
            this.submitting = true;
            this.errors = [];
            let api_token = this.$store.getters.api_token;
            let url = "/api/registration";
            // if(this.errors){
            //     return false
            // }
            let fd = new FormData();
            fd.append("first_name", this.text_fname);
            fd.append("middle_name", this.text_mname);
            fd.append("last_name", this.text_lname);
            fd.append("prc_id", this.prc_id);
            fd.append("hospital_affiliation", this.hospital_affiliation);
            fd.append("email_address", this.text_email);
            fd.append("email_address_confirmation", this.text_cemail);
            fd.append("name_on_cert", this.text_name_on_cert);
            fd.append("position", this.select_position);
            try {
                let { data } = await axios.post(url, fd);
                if (data === "success") {
                    this.successRegistration = true;
                    this.clearInputs();
                    setTimeout(
                        () => this.$emit("handleSuccessRegistration", true),
                        2000
                    );
                    this.submitting = false;
                }
            } catch (err) {
                this.errors.push(err.response.data.errors.email_address);
                this.submitting = false;
                // alert(response.statusText);
            }
        }
    }
};
</script>

<style scoped>
.ra_link{
    text-decoration: none;
    color: blue;
    cursor: pointer;
}
</style>
