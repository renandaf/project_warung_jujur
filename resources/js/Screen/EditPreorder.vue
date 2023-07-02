<template>
    <!-- ======= Book A Table Section ======= -->
    <section id="daftar" class="book-a-table">
        <div class="container" data-aos="fade-up">
            <div class="section-title">
                <h3>Check our <span>Services</span></h3>
            </div>

            <div
                class="tab-content"
                data-aos="fade-up"
                data-aos-delay="300"
                data-aos-duration="1500"
            >
                <div class="tab-pane fade active show" id="dagangan">
                    <Form
                        @submit="submit"
                        class="php-email-form"
                        data-aos="fade-up"
                        data-aos-delay="100"
                        data-aos-duration="1500"
                    >
                        <div class="row g-0 justify-content-center">
                            <div
                                align="center"
                                class="col-lg-3 preorder-img"
                                data-aos="zoom-out"
                                data-aos-delay="200"
                                data-aos-duration="1500"
                            >
                                <div v-if="imageUrl">
                                    <img
                                        :src="imageUrl"
                                        alt="Uploaded Image"
                                        class="img-preorder"
                                    />
                                    <p>{{ formData.gambar1.name }}</p>
                                    <p>
                                        {{ getFileSize(formData.gambar1.size) }}
                                    </p>
                                </div>
                                <div v-if="!imageUrl">
                                    <img
                                        :src="formData.gambar"
                                        alt="contoh Image"
                                        class="img-preorder"
                                    />
                                    <br />
                                    <br />
                                </div>

                                <span
                                    style="background-color: #ce1212"
                                    class="btn btn-file"
                                >
                                    Upload
                                    <Field
                                        type="file"
                                        @change="handleFileUpload"
                                        accept="image/*"
                                        name="gambar"
                                        :rules="fileSize"
                                    />
                                </span>
                                <br />
                                <ErrorMessage name="gambar" class="error" />
                            </div>

                            <div class="col-lg-5 reservation-form-bg">
                                <div class="form-group mt-3">
                                    <label class="mb-1">Judul</label>
                                    <Field
                                        v-model="formData.judul"
                                        type="text"
                                        name="judul"
                                        class="form-control"
                                        id="name"
                                        placeholder="Judul preorder"
                                        :rules="required"
                                    />
                                    <ErrorMessage name="judul" class="error" />
                                </div>
                                <div class="form-group mt-3">
                                    <label class="mb-1">Nomor HP</label>
                                    <Field
                                        v-model="formData.no_hp"
                                        type="text"
                                        name="no_hp"
                                        class="form-control"
                                        placeholder="No Handphone"
                                        :rules="required"
                                    />
                                    <ErrorMessage name="no_hp" class="error" />
                                </div>

                                <div class="form-group mt-3">
                                    <label class="mb-1">Deskripsi</label>
                                    <Field
                                        v-model="formData.deskripsi"
                                        as="textarea"
                                        class="form-control"
                                        name="deskripsi_p"
                                        rows="5"
                                        placeholder="Deskripsi"
                                    ></Field>
                                </div>
                                <div class="form-group mt-3">
                                    <label class="mb-1">Ketersediaan</label>
                                    <Field
                                        v-model="formData.available"
                                        name="available"
                                        as="select"
                                        id="select"
                                        style="
                                            font-weight: 350;
                                            border-radius: 0%;
                                        "
                                        class="form-select form-control"
                                    >
                                        <option disabled>Ketersediaan</option>
                                        <option value="tersedia">
                                            tersedia
                                        </option>
                                        <option value="tidak tersedia">
                                            tidak tersedia
                                        </option>
                                    </Field>
                                </div>
                                <div class="form-group mt-3">
                                    <label class="mb-1">Status</label>
                                    <input
                                        v-if="formData.status == 'ditolak'"
                                        style="
                                            background-color: #e72d2d;
                                            color: #fff;
                                        "
                                        readonly
                                        v-model="formData.status"
                                        class="form-control"
                                        name="status"
                                    />
                                    <input
                                        v-if="formData.status == 'diterima'"
                                        style="
                                            background-color: #25cd25;
                                            color: #fff;
                                        "
                                        readonly
                                        v-model="formData.status"
                                        class="form-control"
                                        name="status"
                                    />
                                    <input
                                        v-if="formData.status == 'diajukan'"
                                        readonly
                                        v-model="formData.status"
                                        class="form-control"
                                        name="status"
                                    />
                                </div>
                                <div
                                    v-if="formData.catatan != null"
                                    class="form-group mt-3"
                                >
                                    <label class="mb-1">Catatan</label>
                                    <textarea
                                        readonly
                                        v-model="formData.catatan"
                                        class="form-control"
                                        name="catatan"
                                    />
                                </div>
                                <br />
                                <div class="text-center">
                                    <button
                                        type="submit"
                                        style="border-radius: 5px"
                                    >
                                        Edit
                                    </button>
                                </div>
                            </div>
                            <!-- End Reservation Form -->
                        </div>
                    </Form>
                </div>
            </div>
        </div>
    </section>
    <!-- End Book A Table Section -->
</template>

<script>
import axios from "axios";
import { Form, Field, ErrorMessage } from "vee-validate";
import { ref, onMounted } from "vue";
import { useRoute } from "vue-router";
export default {
    name: "DaftarPage",
    props: ["id"],
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
        const route = useRoute();
        const formData = ref({
            judul: "",
            no_hp: "",
            deskripsi: "",
            gambar: null,
            gambar1: null,
            available: "",
            status: "",
            catatan: "",
        });

        const getData = () => {
            const id = route.params.id;
            axios
                .get(`preorder/${id}`)
                .then((response) => {
                    formData.value = response.data.data;
                })
                .catch(() => {
                    alert("Anda tidak memiliki akses untuk item ini");
                    router.push({
                        name: "item-saya",
                    });
                });
        };
        onMounted(getData);

        return {
            formData,
        };
    },

    methods: {
        submit() {
            const id = this.$route.params.id;
            const formData = new FormData();
            formData.append("_method", "put");
            formData.append("judul", this.formData.judul);
            formData.append("no_hp", this.formData.no_hp);
            if (this.formData.deskripsi) {
                formData.append("deskripsi", this.formData.deskripsi);
            }
            formData.append("available", this.formData.available);
            if (this.formData.gambar1) {
                formData.append("gambar", this.formData.gambar1);
            }
            axios
                .post(`preorder/${id}`, formData, {
                    headers: {
                        "Content-Type": "multipart/form-data",
                    },
                })
                .then(() => {
                    alert("Perubahan Data preorder berhasil diajukan");
                    location.reload();
                })
                .catch((error) => {
                    alert(
                        "Data preorder gagal diubah : " + error.response.data
                    );
                    console.log(error.response.data);
                });
        },
        getFileSize(bytes) {
            const sizes = ["Bytes", "KB", "MB", "GB", "TB"];
            if (bytes === 0) return "0 Byte";
            const i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
            return `${Math.round(bytes / Math.pow(1024, i), 2)} ${sizes[i]}`;
        },
        handleFileUpload(event) {
            const file = event.target.files[0];
            this.imageUrl = URL.createObjectURL(file);
            this.formData.gambar1 = file;
        },
        required(value) {
            if (!value) {
                return "*Data ini wajib diisi";
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
