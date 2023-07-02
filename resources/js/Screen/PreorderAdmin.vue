<template>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 rounded shadow">
                    <div class="card-body">
                        <div class="row justify-content-around">
                            <div class="col">
                                <h4 v-if="filter == ''">DATA SEMUA PREORDER</h4>
                                <h4 v-if="filter == 'diajukan'">
                                    DATA REQUEST PREORDER
                                </h4>
                            </div>
                            <div class="col" align="right">
                                <button
                                    @click="request"
                                    v-if="filter == ''"
                                    class="btn btn-md btn-success mr-4"
                                >
                                    Request
                                </button>
                                <button
                                    @click="all"
                                    v-if="filter == 'diajukan'"
                                    class="btn btn-md btn-success mr-4"
                                >
                                    Semua preorder
                                </button>
                            </div>
                        </div>
                        <hr />
                        <table
                            class="table table-striped table-bordered mt-4 text-center table-hover"
                        >
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">NAMA</th>
                                    <th scope="col">NO HP</th>
                                    <th scope="col">DESKRIPSI</th>
                                    <th scope="col">AVAILABLE</th>
                                    <th scope="col">PEMILIK</th>
                                    <th scope="col">STATUS</th>
                                    <th scope="col">ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="preorder in filteredSearch"
                                    :key="preorder.id"
                                    style="cursor: pointer"
                                >
                                    <td @click="navigateToDetail(preorder.id)">
                                        {{ preorder.judul }}
                                    </td>
                                    <td @click="navigateToDetail(preorder.id)">
                                        {{ preorder.no_hp }}
                                    </td>
                                    <td @click="navigateToDetail(preorder.id)">
                                        {{ preorder.deskripsi }}
                                    </td>
                                    <td @click="navigateToDetail(preorder.id)">
                                        {{ preorder.available }}
                                    </td>
                                    <td @click="navigateToDetail(preorder.id)">
                                        {{ preorder.user_id }}
                                    </td>
                                    <td
                                        v-if="preorder.status == 'diterima'"
                                        style="
                                            background-color: rgba(
                                                20,
                                                211,
                                                20,
                                                0.944
                                            );
                                            color: white;
                                        "
                                    >
                                        {{ preorder.status }}
                                    </td>
                                    <td
                                        v-else-if="preorder.status == 'ditolak'"
                                        style="
                                            background-color: rgba(
                                                216,
                                                21,
                                                21,
                                                0.944
                                            );
                                            color: white;
                                        "
                                    >
                                        {{ preorder.status }}
                                    </td>
                                    <td v-else>
                                        {{ preorder.status }}
                                    </td>
                                    <td class="text-left">
                                        <span
                                            v-if="preorder.status == 'diajukan'"
                                        >
                                            <button
                                                @click="diterima(preorder.id)"
                                                class="btn btn-sm btn-success mr-1"
                                            >
                                                TERIMA
                                            </button>
                                            |
                                            <button
                                                @click="ditolak(preorder.id)"
                                                class="btn btn-sm btn-warning mr-1"
                                            >
                                                TOLAK
                                            </button>
                                            |
                                        </span>
                                        <button
                                            @click="preorderDelete(preorder.id)"
                                            class="btn btn-sm btn-danger ml-1"
                                        >
                                            DELETE
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import { onMounted, ref } from "vue";

export default {
    data() {
        return {
            filter: "",
        };
    },
    computed: {
        filteredSearch() {
            return this.preorders.filter((preorder) =>
                preorder.status.toLowerCase().includes(this.filter)
            );
        },
    },
    setup() {
        //reactive state
        let preorders = ref([]);
        //mounted
        onMounted(() => {
            //get API from Laravel Backend
            axios
                .get("all/preorder")
                .then((response) => {
                    //assign state posts with response data
                    preorders.value = response.data.data;
                })
                .catch((error) => {
                    console.log(error.response.data);
                });
        });

        //method delete
        function preorderDelete(id) {
            //delete data post by ID
            confirm("Apakah yakin ingin menghapus preorder?")
                ? axios
                      .delete(`preorder/${id}`)
                      .then(() => {
                          alert("Preorder berhasil dihapus");
                          location.reload();
                      })
                      .catch((error) => {
                          console.log(error.response.data);
                      })
                : "";
        }
        function diterima(id) {
            //delete data post by ID
            confirm("Apakah yakin ingin menerima preorder?")
                ? axios
                      .put(`preorder/status/${id}`, {
                          status: "diterima",
                      })
                      .then(() => {
                          alert("Permintaan berhasil diterima");
                          location.reload();
                      })
                      .catch((error) => {
                          console.log(error.response.data);
                      })
                : "";
        }

        function ditolak(id) {
            //delete data post by ID
            const catatan = prompt("Masukkan alasan menolak preorder?");
            axios
                .put(`preorder/status/${id}`, {
                    status: "ditolak",
                    catatan: catatan,
                })
                .then(() => {
                    alert("Permintaan berhasil ditolak");
                    location.reload();
                })
                .catch((error) => {
                    console.log(error.response.data);
                });
        }

        //return
        return {
            preorders,
            preorderDelete,
            diterima,
            ditolak,
        };
    },
    methods: {
        request() {
            this.filter = "diajukan";
        },
        all() {
            this.filter = "";
        },
        navigateToDetail(id) {
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
