import { createApp } from 'vue'
import App from './App.vue'
import "bootstrap/dist/css/bootstrap.min.css"
import "bootstrap"
import 'aos/dist/aos.css'
import 'swiper/css';
import 'swiper/css/pagination';
import 'swiper/css/navigation';
import { register } from 'swiper/element/bundle';
import { BootstrapIconsPlugin } from 'bootstrap-icons-vue';
import VueSilentbox from 'vue-silentbox'
import router from './router'
import KantinItem from "@/components/KantinItem.vue"
import WebFooter from "@/components/Footer.vue"
import ToTopButton from "@/components/ToTopButton.vue"
import SideBar from "@/components/SideBar.vue"
import PreorderItem from "@/components/PreorderItem.vue"
import ProfilPreorder from "@/components/ProfilPreorder.vue"
import ProfilDagangan from "@/components/ProfilDagangan.vue"
import store from './store';
import Vuex from 'vuex';
import axios from 'axios';


axios.defaults.withCredentials = true
axios.defaults.baseURL = 'http://localhost:8000/api/';

const app = createApp(App, {
    Vuex
}).use(router);
app.component('kantin-item', KantinItem);
app.component('footer-web', WebFooter);
app.component('to-top-button', ToTopButton);
app.component('side-bar', SideBar);
app.component('preorder-item', PreorderItem)
app.component('preorder-item-saya', ProfilPreorder)
app.component('dagangan-item-saya', ProfilDagangan)

register();
app.use(store)
app.use(VueSilentbox)
app.use(BootstrapIconsPlugin)
app.mount('#app')


