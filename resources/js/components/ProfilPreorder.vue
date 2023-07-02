<template>
    <div class="col">
        <img
            :src="img"
            alt="item preorder"
            style="height: 280px; width: 250px; margin-bottom: 10px"
        />
        <br />
        <h4>{{ name }}</h4>
        <br />
        <!-- <p class="ingredients">{{ description || "Tidak ada deskripsi" }}</p> -->
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
export default {
    name: "ProfilPreorder",
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
        navigateToEdit() {
            // Programmatically navigate to the Detail component
            this.$router.push({
                name: "edit-preorder",
                params: {
                    id: this.id,
                },
            });
        },
        hapusItem() {
            confirm("Apakah anda yakin ingin meenghapus item?")
                ? axios
                      .delete("preorder/" + this.id)
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
};
</script>
