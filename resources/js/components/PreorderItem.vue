<template>
    <a @click="navigateToDetail" id="preorder-item">
        <div class="event-item d-flex flex-column justify-content-end col-11">
            <img :src="img" alt="default img" class="event-img" />
            <div class="title-bg">
                <div class="price align-self-start">{{ name }}</div>
                <!-- <p style="white-space: pre-line" class="description">
                    {{ description || "Tidak ada deskripsi" }}
                </p> -->
            </div>
        </div>
    </a>
</template>

<script>
export default {
    name: "PreorderItem",

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
        id: {
            required: true,
        },
    },

    methods: {
        navigateToDetail() {
            this.$router.push({
                name: "detail-preorder",
                params: {
                    id: this.id,
                },
            });
        },
    },
};
</script>
