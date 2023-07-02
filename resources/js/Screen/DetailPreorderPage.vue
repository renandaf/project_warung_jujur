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
                            style="padding-top: 10px"
                        >
                            <img
                                :src="info.gambar"
                                width="420"
                                height="480"
                                alt="gambar"
                            />
                            <br />
                            <br />
                            <h3>{{ info.judul }}</h3>
                            <br />
                            <a :href="'https://wa.me/' + info.no_hp">
                                <button
                                    style="
                                        background-color: #ce1212;
                                        border: none;
                                    "
                                    class="btn btn-danger"
                                >
                                    Pesan sekarang
                                </button></a
                            >
                        </div>
                    </swiper-slide>
                    <swiper-slide v-if="info.deskripsi" align="left">
                        <br />

                        <div class="container" style="padding: 0 250px">
                            <h1 style="color: #ffffff; text-align: center">
                                Deskripsi
                            </h1>
                            <br />
                            <p style="white-space: pre-line; color: #cfcfcf">
                                {{ info.deskripsi }}
                            </p>
                        </div>
                        <br />
                        <br />
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
    components: {
        Swiper,
        SwiperSlide,
    },
    props: ["id"],
    mounted() {
        axios
            .get("preorder/" + this.$route.params.id)
            .then((response) => {
                this.info = response.data.data;
            })
            .catch((error) => {
                console.log(error.response.data);
                this.errored = true;
            })
            .finally(() => (this.loading = false));
    },
    methods: {
        handleImageError(event) {
            event.target.src = require(`@/assets/img/default.png`); // Replace with your fallback image URL or import statement
        },
        back() {
            this.$router.go(-1);
        },
    },
};
</script>
