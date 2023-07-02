<template>
    <div class="col swiper-img slide">
        <swiper :speed="600" :loop="true" :slides-per-view="1" class="slide">
            <swiper-slide class="slide">
                <img
                    style="border-radius: 8px"
                    :src="img"
                    alt="img"
                    class="img"
                />
            </swiper-slide>
            <swiper-slide class="slide">
                <img
                    style="border-radius: 8px"
                    :src="qr"
                    alt="qr img"
                    class="img"
                />
            </swiper-slide>
        </swiper>
        <h4>{{ name }}</h4>
        <p class="price">{{ formattedPrice }}</p>
        <p class="ingredients">{{ description || "Tidak ada deskripsi" }}</p>
        <div>
            <button class="btn btn-danger px-4" @click="navigateToEdit">
                Edit
            </button>
            |
            <button class="btn btn-danger px-3" @click="hapusItem">
                Hapus
            </button>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import { Swiper, SwiperSlide } from "swiper/vue";
export default {
    name: "ProfilDagangan",
    components: {
        Swiper,
        SwiperSlide,
    },
    props: {
        img: {
            type: String,
        },
        qr: {
            type: String,
        },
        name: {
            type: String,
            required: true,
        },
        description: {
            type: String,
        },
        price: {
            type: Number,
            required: true,
        },
        id: {
            required: true,
        },
    },
    methods: {
        navigateToEdit() {
            // Programmatically navigate to the Detail component
            this.$router.push({
                name: "edit-dagangan",
                params: {
                    id: this.id,
                },
            });
        },
        hapusItem() {
            confirm("Apakah anda yakin ingin meenghapus item?")
                ? axios
                      .delete("dagangan/" + this.id)
                      .then(() => {
                          alert("Item berhasil dihapus");
                          location.reload();
                      })
                      .catch(() => {
                          alert("Item gagal dihapus");
                      })
                : "";
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
            return formatter.format(this.price);
        },
    },
};
</script>
