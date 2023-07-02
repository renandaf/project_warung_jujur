<template>
    <div class="contents order-2 order-md-1 login">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-md-7">
                    <div class="section-title">
                        <h3>Sign in <span>Wajurpe</span>.</h3>
                        <p>Silahkan masukkan data login anda</p>
                    </div>
                    <Form @submit="submit">
                        <div class="form-group">
                            <label for="email">Email</label>

                            <Field
                                v-model="data.email"
                                name="email"
                                type="email"
                                class="form-control"
                                placeholder="Masukkan Email"
                                :rules="validateEmail"
                            />
                            <ErrorMessage name="email" class="error" />
                        </div>
                        <br />
                        <div class="form-group last mb-3">
                            <label for="password">Password</label>

                            <Field
                                id="password"
                                v-model="data.password"
                                name="password"
                                type="password"
                                class="form-control"
                                placeholder="Masukkan Password"
                                :rules="validatePassword"
                            />
                            <input
                                type="checkbox"
                                :onclick="showPassword"
                                style="margin-left: 10px"
                            />
                            Show password
                            <br />
                            <ErrorMessage name="password" class="error" />
                        </div>

                        <br />
                        <div class="link" align="center">
                            <input
                                style="
                                    background-color: #ce1212;
                                    color: whitesmoke;
                                "
                                type="submit"
                                value="Sign in"
                                class="btn btn-block col-6"
                            />
                            <br />
                            <br />
                            <h6>
                                Belum pernah daftar?
                                <router-link class="a" to="/register"
                                    >Sign up</router-link
                                >
                            </h6>
                        </div>
                    </Form>
                    <br />
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { reactive } from "vue";
import { Form, Field, ErrorMessage } from "vee-validate";
import { useRouter } from "vue-router";
import { useStore } from "vuex";

export default {
    name: "LoginPage",
    components: {
        Form,
        Field,
        ErrorMessage,
    },
    setup() {
        const data = reactive({
            email: "",
            password: "",
        });

        const router = useRouter();
        const store = useStore();
        const submit = async () => {
            store
                .dispatch("login", data)
                .then(() => {
                    store.dispatch("getUser").then(() => {
                        alert("login berhasil");
                        router.push("/");
                    });
                })
                .catch((error) => {
                    alert("login gagal : " + error);
                });
        };

        return {
            data,
            submit,
        };
    },
    methods: {
        showPassword() {
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        },
        validateEmail(value) {
            if (!value) {
                return "*Data email wajib diisi";
            }

            const regex = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i;
            if (!regex.test(value)) {
                return "*Email anda tidak valid";
            }
            return true;
        },
        validatePassword(value) {
            if (!value) {
                return "*Data password wajib diisi";
            } else if (value.length < 6) {
                return "*Password minimal memiliki 6 karakter";
            }

            return true;
        },
    },
};
</script>

<style>
@import "@/assets/style/main.css";
</style>
