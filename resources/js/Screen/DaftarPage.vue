<template>
    <side-bar daftar="active"></side-bar>
    <!-- ======= Book A Table Section ======= -->
    <section id="daftar" class="book-a-table">
        <div class="container" data-aos="fade-up">
            <div class="section-title">
                <h2>Services</h2>
                <h3>Check our <span>Services</span></h3>
                <p>
                    Ut possimus qui ut temporibus culpa velit eveniet modi omnis
                    est adipisci expedita at voluptas atque vitae autem.
                </p>
            </div>

            <ul
                class="nav nav-tabs d-flex justify-content-center"
                data-aos="fade-up"
                data-aos-delay="200"
            >
                <div class="d-flex justify-content-center tab-form">
                    <li class="nav-item">
                        <a
                            class="nav-link active show"
                            data-bs-toggle="tab"
                            data-bs-target="#dagangan"
                        >
                            <h4>Dagangan</h4>
                        </a>
                    </li>
                    <!-- End tab nav item -->

                    <li class="nav-item">
                        <a
                            class="nav-link"
                            data-bs-toggle="tab"
                            data-bs-target="#preorder"
                        >
                            <h4>Preorder</h4> </a
                        ><!-- End tab nav item -->
                    </li>
                </div>
                <!-- End tab nav item -->
            </ul>

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
                        @submit="submit1"
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
                                    <p>{{ gambar.name }}</p>
                                    <p>{{ getFileSize(gambar.size) }}</p>
                                </div>
                                <div v-if="!imageUrl">
                                    <img
                                        src="@/assets/img/default.png"
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
                                            v-model="nama"
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
                                            v-model="harga"
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
                                        v-model="deskripsi"
                                        class="form-control"
                                        name="deskripsi"
                                        rows="5"
                                        placeholder="Deskripsi"
                                    ></Field>
                                    <ErrorMessage
                                        name="deskripsi"
                                        class="error"
                                    />
                                </div>

                                <div class="form-group mt-3">
                                    <label class="mb-1">Kode QR</label>
                                    <Field
                                        v-model="qr_code"
                                        class="form-control"
                                        name="qr_code"
                                        placeholder="Kode QR"
                                    />
                                    <ErrorMessage
                                        name="qr_code"
                                        class="error"
                                    />
                                </div>
                                <div class="form-group mt-3">
                                    <label class="mb-1">Jenis dagangan</label>
                                    <Field
                                        v-model="jenis"
                                        name="jenis"
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
                                    <ErrorMessage name="jenis" class="error" />
                                </div>
                                <br />
                                <br />
                                <div class="text-center">
                                    <button
                                        type="submit"
                                        style="border-radius: 5px"
                                    >
                                        Daftar
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
                                    <p>{{ qr.name }}</p>
                                    <p>{{ getFileSize(qr.size) }}</p>
                                </div>
                                <div v-if="!imageUrl2">
                                    <img
                                        src="@/assets/img/default.png"
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

                <div class="tab-pane fade" id="preorder">
                    <Form
                        @submit="submit2"
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
                                <div v-if="imageUrl3">
                                    <img
                                        :src="imageUrl3"
                                        alt="Uploaded Image"
                                        class="img-preorder"
                                    />
                                    <p>{{ gambar_p.name }}</p>
                                    <p>{{ getFileSize(gambar_p.size) }}</p>
                                </div>
                                <div v-if="!imageUrl3">
                                    <img
                                        src="@/assets/img/default.png"
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
                                        @change="handleFileUpload3"
                                        accept="image/*"
                                        :rules="fileSize"
                                        name="gambar_p"
                                    />
                                </span>
                                <br />
                                <ErrorMessage name="gambar_p" class="error" />
                            </div>

                            <div class="col-lg-5 reservation-form-bg">
                                <div class="form-group mt-3">
                                    <label class="mb-1">Judul</label>
                                    <Field
                                        v-model="judul"
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
                                        v-model="no_hp"
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
                                        v-model="deskripsi_p"
                                        as="textarea"
                                        class="form-control"
                                        name="deskripsi_p"
                                        rows="5"
                                        placeholder="Deskripsi"
                                    ></Field>
                                    <ErrorMessage
                                        name="deskripsi_p"
                                        class="error"
                                    />
                                </div>
                                <br />
                                <div class="text-center">
                                    <button
                                        type="submit"
                                        style="border-radius: 5px"
                                    >
                                        Daftar
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
import { ref } from "vue";
import axios from "axios";
import { Form, Field, ErrorMessage } from "vee-validate";
export default {
    name: "DaftarPage",
    components: {
        Form,
        Field,
        ErrorMessage,
    },
    setup() {
        const nama = ref("");
        const harga = ref(0);
        const deskripsi = ref("");
        const jenis = ref("makanan");
        const qr_code = ref("");
        const gambar = ref(null);
        const qr = ref(null);

        const judul = ref("");
        const deskripsi_p = ref("");
        const no_hp = ref("");
        const gambar_p = ref(null);

        return {
            nama,
            harga,
            deskripsi,
            jenis,
            qr_code,
            judul,
            deskripsi_p,
            no_hp,
            gambar,
            gambar_p,
            qr,
        };
    },
    data() {
        return {
            imageUrl: null,
            imageUrl2: null,
            imageUrl3: null,
        };
    },
    methods: {
        submit1() {
            const formData = new FormData();
            formData.append("nama", this.nama);
            formData.append("harga", this.harga);
            formData.append("deskripsi", this.deskripsi);
            formData.append("jenis_dagangan", this.jenis);
            formData.append("qr_code", this.qr_code);
            if (this.gambar) {
                formData.append("gambar", this.gambar);
            }
            if (this.qr) {
                formData.append("qr", this.qr);
            }

            axios
                .post("dagangan", formData, {
                    headers: {
                        "Content-Type": "multipart/form-data",
                    },
                })
                .then(() => {
                    alert("Data dagangan berhasil diajukan");
                    location.reload();
                })
                .catch((error) => {
                    alert(
                        "Data dagangan gagal diajukan : " +
                            error.response.data.message
                    );
                });
        },
        submit2() {
            const formData = new FormData();
            formData.append("judul", this.judul);
            formData.append("deskripsi", this.deskripsi_p);
            if (this.gambar_p) {
                formData.append("gambar", this.gambar_p);
            }
            formData.append("no_hp", this.no_hp);
            axios
                .post("preorder", formData, {
                    headers: {
                        "Content-Type": "multipart/form-data",
                    },
                })
                .then(() => {
                    alert("Data preorder berhasil diajukan");
                    location.reload();
                })
                .catch((error) => {
                    alert(
                        "Data preorder gagal diajukan : " + error.response.data
                    );
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
            this.gambar = file;
        },
        handleFileUpload2(event) {
            const file = event.target.files[0];
            this.imageUrl2 = URL.createObjectURL(file);
            this.qr = file;
        },
        handleFileUpload3(event) {
            const file = event.target.files[0];
            this.imageUrl3 = URL.createObjectURL(file);
            this.gambar_p = file;
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
