<template>
    <div class="container p-1">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Register</div>
                    <div class="card-body">
                        <div class="alert" :class="success" role="alert" v-if="message">{{ message }}</div>
                        <form method="POST" @submit.prevent="register">

                            <!-- first / last name -->
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label for="first_name" class=" col-form-label text-md-right">First
                                        Name</label>
                                    <div class="">
                                        <input id="first_name" type="text" name="first_name"
                                               v-model="customer.first_name"
                                               class="form-control "
                                               value=""
                                               placeholder="John"
                                               autocomplete="first_name" autofocus>
                                        <span class="text-danger">{{
                                                (err.first_name !== "") ? err.first_name : ''
                                            }}</span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label for="last_name" class="col-form-label text-md-right">Last
                                        Name</label>
                                    <div class="">
                                        <input id="last_name" type="text" name="last_name" v-model="customer.last_name"
                                               class="form-control "
                                               value=""
                                               placeholder="Doe"
                                               autocomplete="last_name" autofocus>
                                        <span class="text-danger">{{
                                                (err.last_name !== "") ? err.last_name : ''
                                            }}</span>
                                    </div>
                                </div>
                            </div>

                            <!-- postal code and contact  -->
                            <div class="form-group row">
                                <div class="col-lg-12">
                                    <label for="phone" class="col-form-label text-md-right">Contact No</label>
                                    <div class="">
                                        <input id="phone" type="text" name="phone" v-model="customer.phone"
                                               class="form-control "
                                               value=""
                                               placeholder="1234567890"
                                               autocomplete="phone" autofocus>
                                        <span class="text-danger">{{
                                                (err.phone !== "") ? err.phone : ''
                                            }}</span>
                                    </div>
                                </div>
                            </div>

                            <!-- email and username-->
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label for="email" class="col-form-label text-md-right">Email Address</label>
                                    <div class="">
                                        <input @keyup="createUserName" id="email" type="email" name="email"
                                               v-model="customer.email"
                                               class="form-control "
                                               value=""
                                               placeholder="johndoe@gmail.com"
                                               autocomplete="email" autofocus>
                                        <span class="text-danger">{{
                                                (err.email !== "") ? err.email : ''
                                            }}</span>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <label for="user_name" class=" col-form-label">User Name <b class="text-danger">Use
                                        for login</b></label>
                                    <div class="">
                                        <input id="user_name" type="text" v-model="customer.user_name"
                                               class="form-control " name="user_name"
                                               autocomplete="user_name" disabled>
                                    </div>
                                </div>
                            </div>


                            <!-- password -->
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label for="password" class=" col-form-label text-md-right">Password</label>

                                    <div class="">
                                        <input id="password" type="password" v-model="customer.password"
                                               class="form-control "
                                               name="password"
                                               placeholder="johndoe"
                                               autocomplete="current-password">
                                        <span class="text-danger">{{
                                                (err.password !== "") ? err.password : ''
                                            }}</span>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <label for="confirmPassword" class=" col-form-label text-md-right">Confirm
                                        Password</label>

                                    <div class="">
                                        <input id="confirmPassword" type="password" v-model="customer.confirmPassword"
                                               class="form-control " name="confirmPassword"
                                               placeholder="johndoe"
                                               autocomplete="current-password">
                                        <span class="text-danger">{{
                                                (err.confirmPassword !== "") ? err.confirmPassword : ''
                                            }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-3">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        Register
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    name: "register",
    data() {
        return {
            customer: {
                first_name: '',
                last_name: '',
                phone: '',
                email: '',
                user_name: '',
                password: '',
                confirmPassword: '',
            },
            err: {
                first_name: '',
                last_name: '',
                phone: '',
                email: '',
                password: '',
                confirmPassword: '',
                statue: 1,
            },
            message: '',
            success: 'alert-danger',
            countries: [],
            states: [],
            cities: [],
        }
    },

    methods: {
        register() {
            this.validate();
            if (this.err.status === 0) {
                this.message = '';
                this.$store
                    .dispatch('register', {
                        first_name: this.customer.first_name,
                        last_name: this.customer.last_name,
                        phone: this.customer.phone,
                        email: this.customer.email,
                        user_name: this.customer.user_name,
                        password: this.customer.password,
                    })
                    .then((response) => {
                        this.success = "alert-danger";
                        if (response.data.status === "error") {
                            this.message = response.data.error;
                        } else if (response.data.status === "success") {
                            this.success = "alert-success";
                            this.message = response.data.message;
                            this.clear();
                            setTimeout(function () {
                                location.href = "/login";
                            }, 500);
                        } else {
                            this.message = "something is wrong";
                        }
                    })
                    .catch(err => {
                        console.log(err)
                    })
            }
        },
        validate: function () {
            let pwd = "";
            for (const [key, value] of Object.entries(this.customer)) {
                if (value === "") {
                    this.err[key] = $("label[for=" + key + "]").text() + " is required";
                } else if (value !== "" && this.err[key] !== "") {
                    this.err[key] = "";
                    this.err["status"] = 0;
                } else if (value !== "" && key === "phone") {
                    if (value.length > 10 || value.length < 10){
                        this.err[key] = $("label[for=" + key + "]").text() + " is must be in 10 digits";
                        if (typeof value != 'number') {
                            this.err[key] = $("label[for=" + key + "]").text() + " is must be in digits";
                        }
                    }
                } else if ((key === "password" || key === "confirmPassword") && value !== "") {
                    if (key === "password")
                        pwd = value;
                    if (value.length > 16 || value.length < 8) {
                        this.err[key] = $("label[for=" + key + "]").text() + " is must be in 8 to 16 character";
                    }
                    if (pwd !== "" && pwd !== value) {
                        this.err[key] = $("label[for=" + key + "]").text() + " and password must be same";
                    }
                }
            }
        },
        createUserName: function () {
            this.customer.user_name = "user." + this.customer.email.split("@")[0];
        },
        clear: function () {
            for (const argument of arguments) {
                for (const [key, value] of Object.entries(this.customer)) {
                    this.customer[key] = "";
                }
            }
        }
    },
}
</script>

<style scoped>
.container {
    color: #ADEFD1FF;
}

.card {
    background-color: #00203FFF;
}

.btn {
    background-color: #F2AA4CFF;
    border-color: #F2AA4CFF;
    color: #101820ff;
}

#user_name {
    cursor: not-allowed;
}
</style>
