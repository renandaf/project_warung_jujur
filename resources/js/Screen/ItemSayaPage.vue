<template>
    <side-bar profile="active"></side-bar>
    <main id="main">
        <section class="profile">
            <div class="container">
                <br />
                <div
                    class="section-title"
                    data-aos="fade-up"
                    data-aos-delay="200"
                    data-aos-duration="1200"
                >
                    <h2>dagangan</h2>
                    <h3><span>Dagangan </span>Anda</h3>
                </div>

                <div
                    data-aos="fade-up"
                    data-aos-delay="200"
                    data-aos-duration="1200"
                    align="center"
                    v-if="errored1"
                >
                    <h4>
                        <br />
                        <br />
                        We're sorry, we're not able to retrieve this information
                        at the moment, please try back later
                        <br />
                        <br />
                    </h4>
                </div>
                <div
                    data-aos="fade-up"
                    data-aos-delay="200"
                    data-aos-duration="1200"
                    v-else
                >
                    <div align="center" v-if="loading1">
                        <br />
                        <br />
                        <h4>Loading...</h4>
                        <br />
                        <br />
                    </div>
                    <div v-else>
                        <div v-if="!isEmpty1">
                            <div
                                class="table text-center row row-cols-md-1 row-cols-lg-3 justify-content-center row-gap-5"
                                data-aos="fade-up"
                                data-aos-delay="400"
                                data-aos-duration="1200"
                            >
                                <dagangan-item-saya
                                    v-for="dagangan in info1"
                                    :key="dagangan.id"
                                    :img="dagangan.gambar"
                                    :qr="dagangan.qr"
                                    :name="dagangan.nama"
                                    :description="dagangan.deskripsi"
                                    :price="dagangan.harga"
                                    :id="dagangan.id"
                                ></dagangan-item-saya>
                            </div>
                        </div>
                        <div v-else align="center">
                            <br />
                            <br />
                            <h4>Anda belum memiliki dagangan</h4>
                            <br />
                            <br />
                        </div>
                    </div>
                </div>

                <br />
                <br />
                <div
                    class="section-title"
                    data-aos="fade-up"
                    data-aos-delay="200"
                    data-aos-duration="1200"
                >
                    <h2>preorder</h2>
                    <h3><span>Preorder </span>Anda</h3>
                </div>

                <div
                    data-aos="fade-up"
                    data-aos-delay="200"
                    data-aos-duration="1200"
                    align="center"
                    v-if="errored2"
                >
                    <h4>
                        <br />
                        <br />
                        We're sorry, we're not able to retrieve this information
                        at the moment, please try back later
                        <br />
                        <br />
                    </h4>
                </div>
                <div
                    data-aos="fade-up"
                    data-aos-delay="200"
                    data-aos-duration="1200"
                    v-else
                >
                    <div align="center" v-if="loading2">
                        <br />
                        <br />
                        <h4>Loading...</h4>
                        <br />
                        <br />
                    </div>
                    <div v-else>
                        <div v-if="!isEmpty2">
                            <div
                                class="table text-center row row-cols-md-1 row-cols-sm-1 row-cols-lg-3 justify-content-center row-gap-5"
                                data-aos="fade-up"
                                data-aos-delay="400"
                                data-aos-duration="1200"
                            >
                                <preorder-item-saya
                                    v-for="preorder in info2"
                                    :key="preorder.id"
                                    :name="preorder.judul"
                                    :description="preorder.deskripsi"
                                    :img="preorder.gambar"
                                    :id="preorder.id"
                                ></preorder-item-saya>
                            </div>
                        </div>
                        <div v-else align="center">
                            <br />
                            <br />
                            <br />
                            <br />
                            <h4>Anda belum memiliki preorder</h4>
                            <br />
                            <br />
                        </div>
                    </div>
                </div>
            </div>

            <br />
        </section>
    </main>
</template>

<script>
import axios from "axios";
export default {
    name: "ProfilePage",
    data() {
        return {
            info1: null,
            loading1: true,
            errored1: false,
            isEmpty1: false,
            info2: null,
            loading2: true,
            errored2: false,
            isEmpty2: false,
        };
    },
    mounted() {
        axios
            .get("user/dagangan")
            .then((response) => {
                if (!response.data.data || response.data.data.length == 0) {
                    this.isEmpty1 = true;
                }
                this.info1 = response.data.data;
            })
            .catch((error) => {
                console.log(error.response.data);
                this.errored1 = true;
            })
            .finally(() => (this.loading1 = false));
        axios
            .get("user/preorder")
            .then((response) => {
                if (!response.data.data || response.data.data.length == 0) {
                    this.isEmpty2 = true;
                }
                this.info2 = response.data.data;
            })
            .catch((error) => {
                console.log(error.response.data);
                this.errored2 = true;
            })
            .finally(() => (this.loading2 = false));
    },
};
</script>

<style>
@import "@/assets/style/main.css";
</style>
