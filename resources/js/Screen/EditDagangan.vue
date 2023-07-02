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
                        class="php-email-form"
                        data-aos="fade-up"
                        data-aos-delay="100"
                        data-aos-duration="1500"
                        @submit="submit"
                    >
                        <div class="row g-0">
                            <div
                                align="center"
                                class="col-lg-3 reservation-img"
                                data-aos="zoom-out"
                                data-aos-delay="200"
                                data-aos-duration="1500"
                            >
                                <div v-if="imageUrl">
                                    <img :src="imageUrl" alt="Uploaded Image" />
                                    <p>{{ formData.gambar1.name }}</p>
                                    <p>
                                        {{ getFileSize(formData.gambar1.size) }}
                                    </p>
                                </div>
                                <div v-if="!imageUrl">
                                    <img
                                        :src="formData.gambar"
                                        alt="contoh Image"
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

                            <div class="col-lg-6 reservation-form-bg">
                                <div class="row gy-4">
                                    <div class="col-lg-6 col-md-6">
                                        <label class="mb-1">Nama</label>
                                        <Field
                                            v-model="formData.nama"
                                            type="text"
                                            name="nama"
                                            class="form-control"
                                            id="name"
                                            placeholder="Nama Produk"
                                            :rules="required"
                                        />
                                        <ErrorMessage
                                            name="nama"
                                            class="error"
                                        />
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <label class="mb-1">Harga</label>
                                        <Field
                                            v-model="formData.harga"
                                            type="number"
                                            class="form-control"
                                            name="harga"
                                            placeholder="Harga (Dalam Rupiah)"
                                            :rules="required"
                                        />
                                        <ErrorMessage
                                            name="harga"
                                            class="error"
                                        />
                                    </div>
                                </div>
                                <div class="form-group mt-3">
                                    <label class="mb-1">Deskripsi</label>
                                    <Field
                                        v-model="formData.deskripsi"
                                        class="form-control"
                                        name="deskripsi"
                                        rows="5"
                                        placeholder="Deskripsi"
                                    ></Field>
                                </div>
                                <div class="form-group mt-3">
                                    <label class="mb-1">Kode QR</label>
                                    <Field
                                        v-model="formData.qr_code"
                                        class="form-control"
                                        name="qr_code"
                                        placeholder="Kode QR"
                                    />
                                </div>
                                <div class="form-group mt-3">
                                    <label class="mb-1">Jenis dagangan</label>
                                    <Field
                                        v-model="formData.jenis_dagangan"
                                        name="jenis_dagangan"
                                        as="select"
                                        id="select"
                                        style="
                                            font-weight: 350;
                                            border-radius: 0%;
                                        "
                                        class="form-select form-control"
                                    >
                                        <option disabled>Jenis dagangan</option>
                                        <option value="makanan">makanan</option>
                                        <option value="minuman">minuman</option>
                                        <option value="lainnya">lainnya</option>
                                    </Field>
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
                            <div
                                align="center"
                                class="col-lg-3 reservation-img qr"
                                data-aos="zoom-out"
                                data-aos-delay="200"
                                data-aos-duration="1500"
                            >
                                <div v-if="imageUrl2">
                                    <img
                                        :src="imageUrl2"
                                        alt="Uploaded Image"
                                    />
                                    <p>{{ formData.qr1.name }}</p>
                                    <p>{{ getFileSize(formData.qr1.size) }}</p>
                                </div>
                                <div v-if="!imageUrl2">
                                    <img
                                        :src="formData.qr"
                                        alt="contoh Image"
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
                                        @change="handleFileUpload2"
                                        accept="image/*"
                                        name="qr"
                                        :rules="fileSize"
                                    />
                                </span>
                                <br />
                                <ErrorMessage name="qr" class="error" />
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
import { useRoute, useRouter } from "vue-router";
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
            imageUrl2: null,
            imageUrl3: null,
        };
    },
    setup() {
        const route = useRoute();
        const router = useRouter();
        const formData = ref({
            nama: "",
            harga: "",
            deskripsi: "",
            jenis_dagangan: "",
            qr_code: "",
            gambar: null,
            gambar1: null,
            qr1: null,
            qr: null,
            available: "",
            status: "",
            catatan: "",
        });

        const getData = () => {
            const id = route.params.id;
            axios
                .get(`dagangan/${id}`)
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
            formData.append("nama", this.formData.nama);
            formData.append("harga", this.formData.harga);
            if (this.formData.deskripsi) {
                formData.append("deskripsi", this.formData.deskripsi);
            }
            if (this.formData.jenis_dagangan) {
                formData.append("jenis_dagangan", this.formData.jenis_dagangan);
            }
            if (this.formData.qr_code) {
                formData.append("qr_code", this.formData.qr_code);
            }
            formData.append("available", this.formData.available);
            if (this.formData.gambar1) {
                formData.append("gambar", this.formData.gambar1);
            }
            if (this.formData.qr1) {
                formData.append("qr", this.formData.qr1);
            }
            axios
                .post(`dagangan/${id}`, formData, {
                    headers: {
                        "Content-Type": "multipart/form-data",
                    },
                })
                .then(() => {
                    alert("Perubahan Data dagangan berhasil diajukan");
                    location.reload();
                })
                .catch((error) => {
                    alert(
                        "Data dagangan gagal diubah : " + error.response.data
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
        handleFileUpload2(event) {
            const file = event.target.files[0];
            this.imageUrl2 = URL.createObjectURL(file);
            this.formData.qr1 = file;
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
