<template>
    <!-- ======= Top Bar ======= -->
    <section id="topbar" class="d-flex align-items-center">
        <div
            class="container d-flex justify-content-center justify-content-md-between"
        ></div>
    </section>
    <header id="header" class="d-flex align-items-center">
        <div
            class="container d-flex align-items-center justify-content-between"
        >
            <h1 class="logo">
                <a href="index.html">WaJurPe<span>.</span></a>
            </h1>
            <!-- Uncomment below if you prefer to use an image logo -->
            <!-- <a href="index.html" class="logo"><img src="assets/img/logo.png" alt=""></a>-->

            <nav id="navbar" class="navbar">
                <ul>
                    <li>
                        <a class="nav-link scrollto active" href="#hero"
                            >Home</a
                        >
                    </li>

                    <li>
                        <router-link
                            href="#kantin"
                            to="/dagangan"
                            class="nav-link scrollto"
                            >Dagangan</router-link
                        >
                    </li>
                    <li>
                        <router-link
                            href="#event"
                            to="/preorder"
                            class="nav-link scrollto"
                            >Preorder</router-link
                        >
                    </li>
                    <li v-if="isAuthenticated">
                        <router-link to="/item-saya" class="nav-link scrollto"
                            >Item Saya</router-link
                        >
                    </li>
                    <li v-if="isAuthenticated">
                        <router-link
                            to="/daftar"
                            href="#daftar"
                            class="nav-link scrollto"
                            >Daftarkan Item</router-link
                        >
                    </li>
                    <li v-if="!isAuthenticated">
                        <router-link
                            href="#daftar"
                            to="/login"
                            class="nav-link scrollto"
                            >Sign in</router-link
                        >
                    </li>
                    <li class="dropdown" v-if="isAuthenticated">
                        <a href="#"
                            ><span>Akun</span>
                            <b-icon-chevron-down class="icon"
                        /></a>
                        <ul>
                            <li>
                                <p>
                                    Sign in as : <span>{{ user.nama }}</span>
                                </p>
                            </li>
                            <li>
                                <a href="#" @click="navigateToEdit">Edit</a>
                            </li>
                            <li><a @click="logout">Sign out</a></li>
                        </ul>
                    </li>
                    <li v-if="isAuthenticated">
                        <router-link
                            to="/admin"
                            class="nav-link scrollto"
                            v-if="user.role == 'admin'"
                            >Admin</router-link
                        >
                    </li>
                </ul>
                <i class="mobile-nav-toggle"><b-icon-list /></i>
            </nav>
            <!-- .navbar -->
        </div>
    </header>
    <!-- End Header -->
</template>

<script>
import { computed } from "vue";
import { useStore } from "vuex";
export default {
    name: "navbar-topbar",
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
            isAuthenticated,
            logout,
            user,
        };
    },
    mounted() {
        const select = (el, all = false) => {
            el = el.trim();
            if (all) {
                return [...document.querySelectorAll(el)];
            } else {
                return document.querySelector(el);
            }
        };

        /**
         * Easy event listener function
         */
        const on = (type, el, listener, all = false) => {
            let selectEl = select(el, all);
            if (selectEl) {
                if (all) {
                    selectEl.forEach((e) => e.addEventListener(type, listener));
                } else {
                    selectEl.addEventListener(type, listener);
                }
            }
        };
        /**
         * Easy on scroll event listener
         */
        const onscroll = (el, listener) => {
            el.addEventListener("scroll", listener);
        };

        /**
         * Navbar links active state on scroll
         */
        let navbarlinks = select("#navbar .scrollto", true);
        const navbarlinksActive = () => {
            let position = window.scrollY + 200;
            navbarlinks.forEach((navbarlink) => {
                if (!navbarlink.hash) return;
                let section = select(navbarlink.hash);
                if (!section) return;
                if (
                    position >= section.offsetTop &&
                    position <= section.offsetTop + section.offsetHeight
                ) {
                    navbarlink.classList.add("active");
                } else {
                    navbarlink.classList.remove("active");
                }
            });
        };
        window.addEventListener("load", navbarlinksActive);
        onscroll(document, navbarlinksActive);

        /**
         * Scrolls to an element with header offset
         */
        const scrollto = (el) => {
            let header = select("#header");
            let offset = header.offsetHeight;

            if (!header.classList.contains("header-scrolled")) {
                offset -= 16;
            }

            let elementPos = select(el).offsetTop;
            window.scrollTo({
                top: elementPos - offset,
                behavior: "smooth",
            });
        };

        /**
         * Header fixed top on scroll
         */
        let selectHeader = select("#header");
        if (selectHeader) {
            let headerOffset = selectHeader.offsetTop;
            let nextElement = selectHeader.nextElementSibling;
            const headerFixed = () => {
                if (headerOffset - window.scrollY <= 0) {
                    selectHeader.classList.add("fixed-top");
                    nextElement.classList.add("scrolled-offset");
                } else {
                    selectHeader.classList.remove("fixed-top");
                    nextElement.classList.remove("scrolled-offset");
                }
            };
            window.addEventListener("load", headerFixed);
            onscroll(document, headerFixed);
        }
        /**
         * Mobile nav toggle
         */
        on("click", ".mobile-nav-toggle", function () {
            select("#navbar").classList.toggle("navbar-mobile");
            this.classList.toggle("bi-list");
            this.classList.toggle("bi-x");
        });

        /**
         * Mobile nav dropdowns activate
         */
        on(
            "click",
            ".navbar .dropdown > a",
            function (e) {
                if (select("#navbar").classList.contains("navbar-mobile")) {
                    e.preventDefault();
                    this.nextElementSibling.classList.toggle("dropdown-active");
                }
            },
            true
        );

        /**
         * Scroll with ofset on page load with hash links in the url
         */
        window.addEventListener("load", () => {
            if (window.location.hash) {
                if (select(window.location.hash)) {
                    scrollto(window.location.hash);
                }
            }
        });
    },
    methods: {
        navigateToEdit() {
            this.$router.push({
                name: "profile",
            });
        },
    },
};
</script>
