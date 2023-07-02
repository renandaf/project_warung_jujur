<template>
    <side-bar kantin="active"></side-bar>
    <main id="main">
        <!-- ======= Menu Section ======= -->
        <section id="menu" class="menu">
            <div class="container">
                <div class="section-title">
                    <h2>Services</h2>
                    <h3>Check our <span>Services</span></h3>
                </div>

                <ul
                    class="nav nav-tabs d-flex justify-content-between"
                    data-aos="fade-up"
                    data-aos-delay="200"
                >
                    <div class="d-flex col-lg-5">
                        <li class="nav-item">
                            <a
                                class="nav-link active show"
                                data-bs-toggle="tab"
                                data-bs-target="#semua"
                                @click="clearSearchInput"
                            >
                                <h4>Semua</h4>
                            </a>
                        </li>
                        <!-- End tab nav item -->

                        <li class="nav-item">
                            <a
                                class="nav-link"
                                data-bs-toggle="tab"
                                data-bs-target="#makanan"
                                @click="clearSearchInput"
                            >
                                <h4>Makanan</h4> </a
                            ><!-- End tab nav item -->
                        </li>

                        <li class="nav-item">
                            <a
                                class="nav-link"
                                data-bs-toggle="tab"
                                data-bs-target="#minuman"
                                @click="clearSearchInput"
                            >
                                <h4>Minuman</h4>
                            </a>
                        </li>
                        <!-- End tab nav item -->

                        <li class="nav-item">
                            <a
                                class="nav-link"
                                data-bs-toggle="tab"
                                data-bs-target="#lainnya"
                                @click="clearSearchInput"
                            >
                                <h4>Lainnya</h4>
                            </a>
                        </li>
                    </div>
                    <div class="col-lg-5 tab-div">
                        <div class="input-group">
                            <input
                                v-model="searchTerm"
                                placeholder="Search...."
                                type="search"
                                class="form-control"
                            />

                            <button
                                type="submit"
                                class="btn btn-danger"
                                data-bs-toggle="tab"
                                data-bs-target="#search"
                            >
                                <b-icon-search class="icon" />
                            </button>
                        </div>
                    </div>
                    <!-- End tab nav item -->
                </ul>

                <div
                    class="tab-content"
                    data-aos="fade-up"
                    data-aos-delay="300"
                    data-aos-duration="1500"
                >
                    <div class="tab-pane fade active show" id="semua">
                        <div align="center" v-if="errored">
                            <h4>
                                <br />
                                <br />
                                We're sorry, we're not able to retrieve this
                                information at the moment, please try back later
                                <br />
                                <br />
                            </h4>
                        </div>
                        <div v-else>
                            <div align="center" v-if="loading">
                                <br />
                                <br />
                                <h4>Loading...</h4>
                                <br />
                                <br />
                            </div>
                            <div v-else>
                                <div
                                    class="row gy-5 row-cols-lg-3 row-cols-md-1 row-cols-sm-1"
                                    v-if="!isEmpty"
                                >
                                    <div
                                        v-for="dagangan in info"
                                        :key="dagangan.id"
                                    >
                                        <kantin-item
                                            :img="dagangan.gambar"
                                            :name="dagangan.nama"
                                            :description="dagangan.deskripsi"
                                            :price="dagangan.harga"
                                            :id="dagangan.id"
                                        ></kantin-item>
                                    </div>
                                </div>
                                <div v-else align="center">
                                    <br />
                                    <br />
                                    <h4>Data dagangan kosong</h4>
                                    <br />
                                    <br />
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Starter Menu Content -->
                </div>
                <div
                    class="tab-content"
                    data-aos="fade-up"
                    data-aos-delay="300"
                    data-aos-duration="1500"
                >
                    <div class="tab-pane fade" id="makanan">
                        <div align="center" v-if="errored">
                            <h4>
                                <br />
                                <br />
                                We're sorry, we're not able to retrieve this
                                information at the moment, please try back later
                                <br />
                                <br />
                            </h4>
                        </div>
                        <div v-else>
                            <div align="center" v-if="loading">
                                <br />
                                <br />
                                <h4>Loading...</h4>
                                <br />
                                <br />
                            </div>
                            <div v-else>
                                <div
                                    class="row gy-5 row-cols-lg-3 row-cols-md-1 row-cols-sm-1"
                                    v-if="filteredItemsMakanan"
                                >
                                    <div
                                        v-for="dagangan in filteredItemsMakanan"
                                        :key="dagangan.id"
                                    >
                                        <kantin-item
                                            :img="dagangan.gambar"
                                            :name="dagangan.nama"
                                            :description="dagangan.deskripsi"
                                            :price="dagangan.harga"
                                            :id="dagangan.id"
                                        ></kantin-item>
                                    </div>
                                </div>
                                <div
                                    v-if="filteredItemsMakanan.length === 0"
                                    align="center"
                                >
                                    <br />
                                    <br />
                                    <h4>Data dagangan tidak ada</h4>
                                    <br />
                                    <br />
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Starter Menu Content -->
                </div>
                <div
                    class="tab-content"
                    data-aos="fade-up"
                    data-aos-delay="300"
                    data-aos-duration="1500"
                >
                    <div class="tab-pane fade" id="minuman">
                        <div align="center" v-if="errored">
                            <h4>
                                <br />
                                <br />
                                We're sorry, we're not able to retrieve this
                                information at the moment, please try back later
                                <br />
                                <br />
                            </h4>
                        </div>
                        <div v-else>
                            <div align="center" v-if="loading">
                                <br />
                                <br />
                                <h4>Loading...</h4>
                                <br />
                                <br />
                            </div>
                            <div v-else>
                                <div
                                    class="row gy-5 row-cols-lg-3 row-cols-md-1 row-cols-sm-1"
                                    v-if="filteredItemsMinuman"
                                >
                                    <div
                                        v-for="dagangan in filteredItemsMinuman"
                                        :key="dagangan.id"
                                    >
                                        <kantin-item
                                            :img="dagangan.gambar"
                                            :name="dagangan.nama"
                                            :description="dagangan.deskripsi"
                                            :price="dagangan.harga"
                                            :id="dagangan.id"
                                        ></kantin-item>
                                    </div>
                                </div>
                                <div
                                    v-if="filteredItemsMinuman.length === 0"
                                    align="center"
                                >
                                    <br />
                                    <br />
                                    <br />
                                    <br />
                                    <h4>Data dagangan tidak ada</h4>
                                    <br />
                                    <br />
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Starter Menu Content -->
                </div>
                <div
                    class="tab-content"
                    data-aos="fade-up"
                    data-aos-delay="300"
                    data-aos-duration="1500"
                >
                    <div class="tab-pane fade" id="lainnya">
                        <div align="center" v-if="errored">
                            <h4>
                                <br />
                                <br />
                                We're sorry, we're not able to retrieve this
                                information at the moment, please try back later
                                <br />
                                <br />
                            </h4>
                        </div>
                        <div v-else>
                            <div align="center" v-if="loading">
                                <br />
                                <br />
                                <h4>Loading...</h4>
                                <br />
                                <br />
                            </div>
                            <div v-else>
                                <div
                                    class="row gy-5 row-cols-lg-3 row-cols-md-1 row-cols-sm-1"
                                    v-if="!filteredItemsLainnya"
                                >
                                    <div
                                        v-for="dagangan in filteredItemsLainnya"
                                        :key="dagangan.id"
                                    >
                                        <kantin-item
                                            :img="dagangan.gambar"
                                            :name="dagangan.nama"
                                            :description="dagangan.deskripsi"
                                            :price="dagangan.harga"
                                            :id="dagangan.id"
                                        ></kantin-item>
                                    </div>
                                </div>
                                <div
                                    v-if="filteredItemsLainnya.length === 0"
                                    align="center"
                                >
                                    <br />
                                    <br />
                                    <h4>Data dagangan tidak ada</h4>
                                    <br />
                                    <br />
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Starter Menu Content -->
                </div>
                <div
                    class="tab-content"
                    data-aos="fade-up"
                    data-aos-delay="300"
                    data-aos-duration="1500"
                >
                    <div class="tab-pane fade" id="search">
                        <div align="center" v-if="errored">
                            <h4>
                                <br />
                                <br />
                                We're sorry, we're not able to retrieve this
                                information at the moment, please try back later
                                <br />
                                <br />
                            </h4>
                        </div>
                        <div v-else>
                            <div align="center" v-if="loading">
                                <br />
                                <br />
                                <h4>Loading...</h4>
                                <br />
                                <br />
                            </div>
                            <div v-else>
                                <div
                                    class="row gy-5 row-cols-lg-3 row-cols-md-1 row-cols-sm-1"
                                    v-if="filteredSearch"
                                >
                                    <div
                                        v-for="dagangan in filteredSearch"
                                        :key="dagangan.id"
                                    >
                                        <kantin-item
                                            :img="dagangan.gambar"
                                            :name="dagangan.nama"
                                            :description="dagangan.deskripsi"
                                            :price="dagangan.harga"
                                            :id="dagangan.id"
                                        ></kantin-item>
                                    </div>
                                </div>
                                <div
                                    v-if="filteredSearch.length === 0"
                                    align="center"
                                >
                                    <br />
                                    <br />
                                    <h4>Data dagangan tidak ditemukan</h4>
                                    <br />
                                    <br />
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Starter Menu Content -->
                </div>
            </div>
        </section>
        <!-- End Menu Section -->
    </main>
    <footer-web></footer-web>
    <to-top-button></to-top-button>
</template>

<script>
import axios from "axios";
export default {
    name: "DaganganPage",
    data() {
        return {
            info: null,
            loading: true,
            errored: false,
            isEmpty: false,
            searchTerm: "",
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
                this.errored = true;
            })
            .finally(() => (this.loading = false));
    },
    computed: {
        clearSearchInput() {
            this.searchTerm = "";
        },
        filteredItemsLainnya() {
            return this.info.filter(
                (dagangan) => dagangan.jenis_dagangan === "lainnya"
            );
        },
        filteredItemsMinuman() {
            return this.info.filter(
                (dagangan) => dagangan.jenis_dagangan === "minuman"
            );
        },
        filteredItemsMakanan() {
            return this.info.filter(
                (dagangan) => dagangan.jenis_dagangan === "makanan"
            );
        },
        filteredSearch() {
            return this.info.filter((dagangan) =>
                dagangan.nama
                    .toLowerCase()
                    .includes(this.searchTerm.toLowerCase())
            );
        },
    },
};
</script>

<style>
@import "@/assets/style/main.css";
</style>
