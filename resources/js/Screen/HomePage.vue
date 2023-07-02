<template>
    <navbar></navbar>
    <!-- ======= Hero Section ======= -->
    <section id="hero" class="d-flex align-items-center">
        <div class="container" data-aos="zoom-out">
            <h1>Welcome to <span>BizLand</span></h1>
            <h2>
                We are team of talented designers making websites with Bootstrap
            </h2>
            <div class="d-flex">
                <router-link
                    v-if="!isAuthenticated"
                    to="/login"
                    class="btn-get-started scrollto"
                    >Mulai sekarang</router-link
                >
                <router-link
                    v-if="isAuthenticated"
                    to="/daftar"
                    class="btn-get-started scrollto"
                    >Daftarkan dagangan</router-link
                >
            </div>
        </div>
    </section>
    <!-- End Hero Section -->
    <!-- ======= Featured Services Section ======= -->
    <section id="about" class="featured-services">
        <div class="container" data-aos="fade-up">
            <div class="row justify-content-center">
                <div class="col-md-3 d-flex align-items-stretch mb-5 mb-lg-0">
                    <div
                        class="icon-box"
                        data-aos="fade-up"
                        data-aos-delay="200"
                    >
                        <div class="icon">
                            <b-icon-newspaper class="icons" />
                        </div>
                        <h4 class="title">
                            <a href="">Sed ut perspiciatis</a>
                        </h4>
                        <p class="description">
                            Duis aute irure dolor in reprehenderit in voluptate
                            velit esse cillum dolore
                        </p>
                    </div>
                </div>

                <div class="col-md-3 d-flex align-items-stretch mb-5 mb-lg-0">
                    <div
                        class="icon-box"
                        data-aos="fade-up"
                        data-aos-delay="300"
                    >
                        <div class="icon">
                            <b-icon-newspaper class="icons" />
                        </div>
                        <h4 class="title"><a href="">Magni Dolores</a></h4>
                        <p class="description">
                            Excepteur sint occaecat cupidatat non proident, sunt
                            in culpa qui officia
                        </p>
                    </div>
                </div>

                <div class="col-md-3 d-flex align-items-stretch mb-5 mb-lg-0">
                    <div
                        class="icon-box"
                        data-aos="fade-up"
                        data-aos-delay="400"
                    >
                        <div class="icon">
                            <b-icon-newspaper class="icons" />
                        </div>
                        <h4 class="title"><a href="">Nemo Enim</a></h4>
                        <p class="description">
                            At vero eos et accusamus et iusto odio dignissimos
                            ducimus qui blanditiis
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Featured Services Section -->

    <main id="main">
        <!-- ======= Menu Section ======= -->
        <div class="container menu" data-aos-duration="1500" data-aos="fade-up">
            <div align="center">
                <br />
                <div v-if="!isEmpty">
                    <div class="section-title">
                        <h2>Services</h2>
                        <h3>Check our <span>Services</span></h3>
                        <p>
                            Ut possimus qui ut temporibus culpa velit eveniet
                            modi omnis est adipisci expedita at voluptas atque
                            vitae autem.
                        </p>
                    </div>
                    <br />
                    <div
                        align="center"
                        class="tab-content col-lg-12 col-md-12"
                        data-aos="fade-up"
                        data-aos-delay="300"
                        data-aos-duration="1500"
                    >
                        <swiper
                            :autoplay="{
                                delay: 4000,
                                disableOnInteraction: false,
                            }"
                            :watchSlidesProgress="true"
                            :space-between="70"
                            :navigation="true"
                            :breakpoints="{
                                320: {
                                    slidesPerView: 1,
                                },

                                1200: {
                                    slidesPerView: 3,
                                },
                            }"
                            :center-insufficient-slides="true"
                        >
                            <swiper-slide
                                v-for="(dagangan, index) in info"
                                :key="index"
                                class="menu-item my-3"
                                id="home-item"
                            >
                                <a
                                    @click="navigateToDetail(dagangan.id)"
                                    v-if="index < 8"
                                    ><img
                                        style="height: 280px"
                                        :src="dagangan.gambar"
                                        class="img-fluid my-2"
                                        alt=""
                                    />
                                    <h4>{{ dagangan.nama }}</h4>
                                    <p class="ingredients">
                                        {{
                                            dagangan.deskripsi ||
                                            "Tidak ada deskripsi"
                                        }}
                                    </p>
                                    <p class="price">
                                        {{ formattedPrice(dagangan.harga) }}
                                    </p>
                                </a>
                            </swiper-slide>
                        </swiper>
                        <br /><br /><br /><br />
                    </div>
                </div>
            </div>
        </div>

        <!-- End Menu Section -->

        <!-- ======= Events Section ======= -->

        <div id="event" class="events" data-aos="fade-up">
            <div v-if="!isEmpty2">
                <div class="section-title">
                    <h2>Services</h2>
                    <h3>Check our <span>Services</span></h3>
                    <p>
                        Ut possimus qui ut temporibus culpa velit eveniet modi
                        omnis est adipisci expedita at voluptas atque vitae
                        autem.
                    </p>
                </div>
                <swiper
                    :autoplay="{
                        delay: 4000,
                        disableOnInteraction: false,
                    }"
                    :breakpoints="{
                        320: {
                            slidesPerView: 1,
                        },

                        1200: {
                            slidesPerView: 3,
                        },
                    }"
                    :center-insufficient-slides="true"
                    :speed="600"
                    :pagination="{ clickable: true }"
                    data-aos="fade-up"
                    data-aos-delay="100"
                >
                    <swiper-slide
                        v-for="(preorder, index2) in info2"
                        :key="index2"
                        class="event-item d-flex flex-column justify-content-end"
                    >
                        <a @click="navigateToDetail2(preorder.id)">
                            <img
                                :src="preorder.gambar"
                                alt="event item"
                                class="event-img"
                            />
                            <div class="price align-self-start">
                                {{ preorder.judul }}
                            </div>
                            <p class="description">
                                {{
                                    preorder.deskripsi || "Tidak ada deskripsi"
                                }}
                            </p>
                        </a>
                    </swiper-slide>
                </swiper>
            </div>
        </div>

        <!-- End Events Section -->
        <!-- ======= Book A Table Section ======= -->
        <section id="daftar" class="book-a-table">
            <div class="container" data-aos="fade-up">
                <div class="section-title">
                    <h2>Services</h2>
                    <h3>Check our <span>Services</span></h3>
                    <p>
                        Ut possimus qui ut temporibus culpa velit eveniet modi
                        omnis est adipisci expedita at voluptas atque vitae
                        autem.
                    </p>
                    <br /><br />
                    <router-link
                        v-if="!isAuthenticated"
                        to="/login"
                        class="btn-get-started scrollto"
                        >Mulai sekarang</router-link
                    >
                    <router-link
                        v-if="isAuthenticated"
                        to="/daftar"
                        class="btn-get-started scrollto"
                        >Daftarkan dagangan</router-link
                    >
                </div>
            </div>
        </section>
        <!-- End Book A Table Section -->
    </main>
    <!-- End #main -->
    <footer-web></footer-web>
    <to-top-button></to-top-button>
</template>

<script>
import { Swiper, SwiperSlide } from "swiper/vue";
import navbar from "../components/Navbar.vue";
import { EffectCreative } from "swiper";
import axios from "axios";
import { computed } from "vue";
import { useStore } from "vuex";

export default {
    name: "HomePage",
    data() {
        return {
            info: null,
            isEmpty: false,
            index: 0,
            info2: null,
            isEmpty2: false,
            index2: 0,
        };
    },
    mounted() {
        axios
            .get("dagangan")
            .then((response) => {
                if (!response.data.data || response.data.data.length == 0) {
                    this.isEmpty = true;
                }
                this.info = response.data.data;
            })
            .catch((error) => {
                console.log(error.response.data);
            });
        axios
            .get("preorder")
            .then((response) => {
                if (!response.data.data || response.data.data.length == 0) {
                    this.isEmpty2 = true;
                }
                this.info2 = response.data.data;
            })
            .catch((error) => {
                console.log(error.response.data);
                this.errored = true;
            })
            .finally(() => (this.loading2 = false));
    },
    setup() {
        const store = useStore();
        const isAuthenticated = computed(() => store.getters.isAuthenticated);
        return {
            modules: [EffectCreative],
            isAuthenticated,
        };
    },
    components: {
        Swiper,
        SwiperSlide,
        navbar,
    },
    methods: {
        formattedPrice(value) {
            const formatter = new Intl.NumberFormat("id-ID", {
                style: "currency",
                currency: "IDR",
                minimumFractionDigits: 0,
                maximumFractionDigits: 0,
            });
            return formatter.format(value);
        },

        getItemsLength() {
            console.log(this.info.length);
            return this.info.length;
        },
        navigateToDetail(id) {
            // Programmatically navigate to the Detail component
            this.$router.push({
                name: "detail-dagangan",
                params: {
                    id: id,
                },
            });
        },
        navigateToDetail2(id) {
            this.$router.push({
                name: "detail-preorder",
                params: {
                    id: id,
                },
            });
        },
    },
};
</script>
<style>
@import "@/assets/style/main.css";
</style>
