<template>
    <side-bar></side-bar>
    <div class="contents order-2 order-md-1 login">
        <div class="container">
            <div
                class="row align-items-center justify-content-center"
                align="center"
            >
                <Form @submit="submit">
                    <div class="col-md-7">
                        <div v-if="!imageUrl">
                            <img
                                style="border-radius: 50%; height: 185px"
                                :src="user.gambar"
                                alt="Image"
                                class="img-fluid"
                                width="185"
                            />
                            <br />
                            <br />
                        </div>
                        <div v-if="imageUrl">
                            <img
                                style="border-radius: 50%; height: 185px"
                                :src="imageUrl"
                                alt="Image"
                                class="img-fluid"
                                width="180"
                            />
                            <br />
                            <br />
                        </div>
                        <span
                            style="background-color: #ce1212; color: whitesmoke"
                            class="btn btn-file"
                        >
                            Upload
                            <Field
                                :rules="fileSize"
                                type="file"
                                @change="handleFileUpload"
                                accept="image/*"
                                name="gambar"
                            />
                        </span>
                        <br />
                        <ErrorMessage name="gambar" class="error" />
                    </div>
                    <div class="col-md-7" align="left">
                        <div class="form-group first">
                            <label for="nama">Nama Lengkap</label>
                            <Field
                                v-model="nama"
                                name="nama"
                                type="text"
                                class="form-control"
                                placeholder="Masukkan Nama Lengkap"
                                :rules="validateNama"
                            />
                            <ErrorMessage name="nama" class="error" />
                        </div>
                        <br />
                        <div class="form-group">
                            <label for="email">Email</label>

                            <Field
                                v-model="email"
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
                            <label for="password">New Password</label>

                            <Field
                                id="password"
                                v-model="password"
                                name="password"
                                type="password"
                                class="form-control"
                                placeholder="Masukkan Password baru"
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
                                value="Edit Profil"
                                class="btn btn-block col-6"
                            />
                            <br />
                            <br />
                        </div>
                    </div>
                </Form>
            </div>
        </div>
    </div>
</template>

<script>
import { ref } from "vue";
import { Form, Field, ErrorMessage } from "vee-validate";
import { computed } from "vue";
import { useStore } from "vuex";
import axios from "axios";

export default {
    name: "RegisterPage",
    components: {
        Form,
        Field,
        ErrorMessage,
    },
    data() {
        return {
            imageUrl: null,
        };
    },
    setup() {
        const store = useStore();
        const user = computed(() => store.getters.getUser);
        const nama = ref(user.value.nama);
        const email = ref(user.value.email);
        const password = ref("");
        const gambar = ref(user.value.gambar);
        const role = ref(user.value.role);

        return {
            nama,
            email,
            password,
            gambar,
            user,
            role,
            store,
        };
    },
    methods: {
        submit() {
            const formData = new FormData();
            formData.append("_method", "put");
            formData.append("nama", this.nama);
            formData.append("email", this.email);
            formData.append("role", this.role);

            if (this.password) {
                formData.append("password", this.password);
            }
            if (this.gambar) {
                formData.append("gambar", this.gambar);
            }
            axios
                .post("edit", formData, {
                    headers: {
                        "Content-Type": "multipart/form-data",
                    },
                })
                .then(() => {
                    this.store.dispatch("getUser").catch((error) => {
                        console.error(error);
                    });
                    alert("Data user berhasil diubah");
                    location.reload();
                })
                .catch((error) => {
                    console.log(error);
                    alert("Data user gagal diubah");
                });
        },
        handleFileUpload(event) {
            const file = event.target.files[0];
            this.imageUrl = URL.createObjectURL(file);
            this.gambar = file;
        },
        showPassword() {
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        },
        validateNama(value) {
            if (!value) {
                return "*Data nama wajib diisi";
            }

            return true;
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
            if (value != 0 && value.length < 6) {
                return "*Password minimal memiliki 6 karakter";
            }

            return true;
        },
        fileSize(value) {
            if (value && value.size > 2000000) {
                return "*File tidak boleh lebih besar dari 2MB";
            }
            return true;
        },
    },
};
</script>

<style>
@import "@/assets/style/login.css";
</style>
