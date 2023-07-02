<template>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 rounded shadow">
                    <div class="card-body">
                        <div class="row justify-content-around">
                            <div class="col">
                                <h4 v-if="filter == ''">DATA SEMUA DAGANGAN</h4>
                                <h4 v-if="filter == 'diajukan'">
                                    DATA REQUEST DAGANGAN
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
                                    Semua dagangan
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
                                    <th scope="col">HARGA</th>
                                    <th scope="col">DESKRIPSI</th>
                                    <th scope="col">AVAILABLE</th>
                                    <th scope="col">PEMILIK</th>
                                    <th scope="col">JENIS DAGANGAN</th>
                                    <th scope="col">STATUS</th>
                                    <th scope="col">ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="dagangan in filteredSearch"
                                    :key="dagangan.id"
                                    style="cursor: pointer"
                                >
                                    <td @click="navigateToDetail(dagangan.id)">
                                        {{ dagangan.nama }}
                                    </td>
                                    <td @click="navigateToDetail(dagangan.id)">
                                        Rp.{{ dagangan.harga }}
                                    </td>
                                    <td @click="navigateToDetail(dagangan.id)">
                                        {{ dagangan.deskripsi }}
                                    </td>
                                    <td @click="navigateToDetail(dagangan.id)">
                                        {{ dagangan.available }}
                                    </td>
                                    <td @click="navigateToDetail(dagangan.id)">
                                        {{ dagangan.user_id }}
                                    </td>
                                    <td @click="navigateToDetail(dagangan.id)">
                                        {{ dagangan.jenis_dagangan }}
                                    </td>
                                    <td
                                        v-if="dagangan.status == 'diterima'"
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
                                        {{ dagangan.status }}
                                    </td>
                                    <td
                                        v-else-if="dagangan.status == 'ditolak'"
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
                                        {{ dagangan.status }}
                                    </td>
                                    <td v-else>
                                        {{ dagangan.status }}
                                    </td>
                                    <td class="text-left">
                                        <span
                                            v-if="dagangan.status == 'diajukan'"
                                        >
                                            <button
                                                @click="diterima(dagangan.id)"
                                                class="btn btn-sm btn-success mr-1"
                                            >
                                                TERIMA
                                            </button>
                                            |
                                            <button
                                                @click="ditolak(dagangan.id)"
                                                class="btn btn-sm btn-warning mr-1"
                                            >
                                                TOLAK
                                            </button>
                                            |
                                        </span>
                                        <button
                                            @click="daganganDelete(dagangan.id)"
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
import { ref } from "vue";

export default {
    data() {
        return {
            filter: "",
        };
    },
    computed: {
        filteredSearch() {
            return this.dagangans.filter((dagangan) =>
                dagangan.status.toLowerCase().includes(this.filter)
            );
        },
    },
    setup() {
        //reactive state
        let dagangans = ref([]);
        //mounted

        //get API from Laravel Backend
        axios
            .get("all/dagangan")
            .then((response) => {
                //assign state posts with response data
                dagangans.value = response.data.data;
            })
            .catch((error) => {
                console.log(error.response.data);
            });

        //method delete
        function daganganDelete(id) {
            //delete data post by ID
            confirm("Apakah yakin ingin menghapus dagangan?")
                ? axios
                      .delete(`dagangan/${id}`)
                      .then(() => {
                          alert("Dagangan berhasil dihapus");
                          location.reload();
                      })
                      .catch((error) => {
                          console.log(error.response.data);
                      })
                : "";
        }
        function diterima(id) {
            //delete data post by ID
            confirm("Apakah yakin ingin menerima dagangan?")
                ? axios
                      .put(`dagangan/status/${id}`, {
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
            const catatan = prompt("Masukkan alasan menolak dagangan?");
            axios
                .put(`dagangan/status/${id}`, {
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
            dagangans,
            daganganDelete,
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
                name: "detail-dagangan",
                params: {
                    id: id,
                },
            });
        },
    },
};
</script>
