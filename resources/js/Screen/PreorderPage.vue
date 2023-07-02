<template>
    <side-bar preorder="active"></side-bar>
    <main id="main">
        <!-- ======= Menu Section ======= -->
        <section class="preorder">
            <div class="container">
                <div class="section-title">
                    <h2>Services</h2>
                    <h3>Check our <span>Services</span></h3>
                </div>
                <div class="col-lg-12 mb-5">
                    <div class="col-lg-5">
                        <div class="input-group">
                            <input
                                v-model="searchTerm"
                                placeholder="Search...."
                                type="search"
                                class="form-control"
                            />
                            <button type="button" class="btn btn-danger">
                                <b-icon-search class="icon" />
                            </button>
                        </div>
                    </div>
                </div>
                <div align="center" v-if="errored">
                    <h4>
                        <br />
                        <br />
                        We're sorry, we're not able to retrieve this information
                        at the moment, please try back later
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
                            class="row row-cols-lg-3 row-cols-md-1 gy-5"
                            v-if="filteredSearch"
                        >
                            <div
                                v-for="preorder in filteredSearch"
                                :key="preorder.id"
                            >
                                <preorder-item
                                    :name="preorder.judul"
                                    :description="preorder.deskripsi"
                                    :img="preorder.gambar"
                                    :id="preorder.id"
                                ></preorder-item>
                            </div>
                        </div>
                        <div v-if="filteredSearch.length === 0" align="center">
                            <br />
                            <br />
                            <br />
                            <br />
                            <h4>Data Preoder tidak ditemukan</h4>
                            <br />
                            <br />
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Starter Menu Content -->
        </section>
        <!-- End Menu Section -->

        <!-- Modal -->
    </main>
    <footer-web></footer-web>
    <to-top-button></to-top-button>
</template>

<script>
import axios from "axios";
export default {
    name: "PreorderPage",
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
            .get("preorder")
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
        filteredSearch() {
            return this.info.filter((preorder) =>
                preorder.judul
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
