<template>
    <div class="detail" align="center">
        <div align="center" v-if="errored" style="margin-top: 200px">
            <h4 style="color: #cfcfcf">
                We're sorry, we're not able to retrieve this information at the
                moment, please try back later
            </h4>
        </div>
        <div v-else>
            <div align="center" v-if="loading" style="margin-top: 300px">
                <h1 style="color: #cfcfcf">Loading...</h1>
            </div>
            <div v-else>
                <div class="close" align="right">
                    <button class="button" @click="back">
                        <b-icon-x></b-icon-x>
                    </button>
                </div>
                <swiper
                    :navigation="{ clickable: true }"
                    :pagination="{ clickable: true }"
                    :breakpoints="{
                        320: {
                            spaceBetween: 200,
                        },
                        640: {
                            spaceBetween: 200,
                        },
                    }"
                    data-aos="fade"
                    data-aos-duration="800"
                >
                    <swiper-slide>
                        <div
                            class="preorder-gambar col-lg-8"
                            align="center"
                            style="padding-top: 40px"
                        >
                            <img
                                :src="info.gambar"
                                width="400"
                                height="400"
                                alt="gambar"
                            />
                            <br />
                            <br />
                            <h3>{{ info.nama }}</h3>
                            <h4>{{ formattedPrice }}</h4>
                            <p style="color: #a29b9b">
                                {{ info.deskripsi || "Tidak ada deskripsi" }}
                            </p>
                            <br />
                            <br />
                        </div>
                    </swiper-slide>
                    <swiper-slide
                        v-if="
                            info.qr !=
                            'http://localhost:8000/storage/qr/default.png'
                        "
                    >
                        <div
                            class="preorder-gambar col-lg-8"
                            align="center"
                            style="padding-top: 100px; margin-top: -50px"
                        >
                            <img
                                :src="info.qr"
                                width="420"
                                height="420"
                                alt="gambar"
                            />

                            <br />
                            <br />
                            <h4>
                                Kode QR :
                                {{ info.qr_code || "Kosong" }}
                            </h4>
                        </div>
                    </swiper-slide>
                </swiper>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import { Swiper, SwiperSlide } from "swiper/vue";
export default {
    name: "ModalItem",
    data() {
        return {
            info: null,
            loading: true,
            errored: false,
        };
    },
    props: ["id"],
    mounted() {
        axios
            .get("dagangan/" + this.$route.params.id)
            .then((response) => {
                this.info = response.data.data;
            })
            .catch((error) => {
                console.log(error.response.data);
                this.errored = true;
            })
            .finally(() => (this.loading = false));
    },
    components: {
        Swiper,
        SwiperSlide,
    },
    methods: {
        back() {
            this.$router.go(-1);
        },
    },
    computed: {
        formattedPrice() {
            const formatter = new Intl.NumberFormat("id-ID", {
                style: "currency",
                currency: "IDR",
                minimumFractionDigits: 0,
                maximumFractionDigits: 0,
            });
            return formatter.format(this.info.harga);
        },
    },
};
</script>
