<template>
    <aside class="sidebar">
        <div class="toggle">
            <div class="kotak-burger">
                <a
                    href="#"
                    class="burger js-menu-toggle"
                    data-toggle="collapse"
                    data-target="#main-navbar"
                >
                    <span></span>
                </a>
            </div>
        </div>
        <div class="side-inner">
            <br /><br />
            <div class="profile" v-if="isAuthenticated">
                <img
                    style="border-radius: 50%; width: 120px; height: 120px"
                    :src="user.gambar"
                    alt="Image"
                    class="img-fluid"
                />
                <h3 class="name">{{ user.nama }}</h3>
                <span class="country">{{ user.email }}</span>
                <div style="height: 8px"></div>
                <a
                    class="link"
                    style="text-decoration: underline !important"
                    href="#"
                    @click="navigateToEdit"
                    >Edit Akun
                </a>
            </div>
            <div class="profile" v-if="!isAuthenticated">
                <img
                    src="@/assets/img/profile.png"
                    alt="Image"
                    class="img-fluid"
                />
                <h3 class="guest">Guest</h3>
            </div>

            <div class="nav-menu">
                <ul>
                    <li>
                        <router-link class="link" to="/">
                            <span class="icon-notifications mr-3"></span> Home
                        </router-link>
                    </li>
                    <li>
                        <router-link class="link" :id="kantin" to="/dagangan">
                            <span class="icon-notifications mr-3"></span>
                            Dagangan
                        </router-link>
                    </li>
                    <li>
                        <router-link class="link" :id="preorder" to="/preorder">
                            <span class="icon-notifications mr-3"></span>
                            Preorder
                        </router-link>
                    </li>
                    <li v-if="isAuthenticated">
                        <router-link class="link" :id="profile" to="/item-saya">
                            <span class="icon-notifications mr-3"></span> Item
                            saya
                        </router-link>
                    </li>
                    <li v-if="isAuthenticated">
                        <router-link class="link" :id="daftar" to="/daftar">
                            <span class="icon-notifications mr-3"></span>
                            Daftarkan Item
                        </router-link>
                    </li>
                    <li v-if="isAuthenticated">
                        <router-link
                            :id="admin"
                            to="/admin"
                            class="link"
                            v-if="user.role == 'admin'"
                            >Admin</router-link
                        >
                    </li>
                    <li v-if="isAuthenticated">
                        <a class="link" @click="logout">
                            <span class="icon-sign-out mr-3"></span> Sign out
                        </a>
                    </li>

                    <li v-if="!isAuthenticated">
                        <router-link class="link" to="/login">
                            <span class="icon-sign-out mr-3"></span> Sign in
                        </router-link>
                    </li>
                </ul>
            </div>
        </div>
    </aside>
</template>

<script>
import { computed } from "vue";
import { useStore } from "vuex";
import $ from "jquery";
export default {
    name: "SideBar",
    props: {
        name: {
            type: String,
        },
        kantin: {
            type: String,
        },
        preorder: {
            type: String,
        },
        profile: {
            type: String,
        },
        daftar: {
            type: String,
        },
        admin: {
            type: String,
        },
    },
    setup() {
        const store = useStore();
        const isAuthenticated = computed(() => store.getters.isAuthenticated);
        const user = computed(() => store.getters.getUser);
        const logout = async () => {
            confirm("Apakah anda yakin ingin Sign out?")
                ? store
                      .dispatch("logout")
                      .then(() => {
                          alert("Sign out berhasil");
                          location.reload();
                      })
                      .catch((error) => {
                          alert("Sign out gagal : " + error);
                      })
                : "";
        };
        return {
            user,
            isAuthenticated,
            logout,
        };
    },
    methods: {
        navigateToEdit() {
            this.$router.push({
                name: "profile",
            });
        },
    },
    mounted() {
        "use strict";
        $(".js-menu-toggle").click(function (e) {
            var $this = $(this);

            if ($("body").hasClass("show-sidebar")) {
                $("body").removeClass("show-sidebar");
                $this.removeClass("active");
            } else {
                $("body").addClass("show-sidebar");
                $this.addClass("active");
            }

            e.preventDefault();
        });

        $(".link").click(function (e) {
            var container = $(".sidebar");
            if (
                !container.is(e.target) &&
                container.has(e.target).length === 0
            ) {
                if ($("body").hasClass("show-sidebar")) {
                    $("body").removeClass("show-sidebar");
                    $("body").find(".js-menu-toggle").removeClass("active");
                }
            }
        });

        // click outisde offcanvas
        $(document).mouseup(function (e) {
            var container = $(".sidebar");
            if (
                !container.is(e.target) &&
                container.has(e.target).length === 0
            ) {
                if ($("body").hasClass("show-sidebar")) {
                    $("body").removeClass("show-sidebar");
                    $("body").find(".js-menu-toggle").removeClass("active");
                }
            }
        });
    },
};
</script>

<style>
@import "@/assets/style/sidebar.css";
</style>
