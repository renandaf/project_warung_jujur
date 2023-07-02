<template>
    <a @click="navigateToDetail()">
        <div class="col menu-item">
            <a
                ><img
                    :src="img"
                    class="menu-img img-fluid"
                    alt="gambar makanan"
            /></a>
            <h4>{{ name }}</h4>
            <p class="ingredients">
                {{ description || "Tidak ada deskripsi" }}
            </p>
            <p class="price">{{ formattedPrice }}</p>
        </div>
    </a>
</template>

<script>
export default {
    name: "KantinItem",
    props: {
        img: {
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
    methods: {
        navigateToDetail() {
            // Programmatically navigate to the Detail component
            this.$router.push({
                name: "detail-dagangan",
                params: {
                    id: this.id,
                },
            });
        },
    },
};
</script>
