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
                <div class="preorder-gambar col-lg-8" align="center">
                    <img
                        :src="info.gambar"
                        width="410"
                        height="470"
                        alt="gambar"
                        @error="handleImageError"
                    />

                    <br />
                    <h4 class="my-2">{{ info.judul }}</h4>
                    <p style="color: #a29b9b">
                        {{ info.deskripsi || "Tidak ada deskripsi" }}
                    </p>
                    <a :href="'https://wa.me/' + info.no_hp">
                        <button
                            style="background-color: #ce1212; border: none"
                            class="btn btn-danger"
                        >
                            Pesan sekarang
                        </button></a
                    >
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
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
