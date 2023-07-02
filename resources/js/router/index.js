import { createRouter, createWebHistory } from 'vue-router'
import HomePage from "../Screen/HomePage.vue";
import DaganganPage from "../Screen/DaganganPage.vue"
import LoginPage from "../Screen/LoginPage.vue"
import DaftarPage from "../Screen/DaftarPage.vue"
import PreorderPage from "../Screen/PreorderPage.vue"
import DetailPage from "../Screen/DetailPage.vue"
import RegisterPage from "../Screen/RegisterPage.vue"
import ItemSayaPage from "../Screen/ItemSayaPage.vue"
import DetailPreorder from "../Screen/DetailPreorderPage.vue"
import EditDagangan from "../Screen/EditDagangan.vue"
import EditPreorder from "../Screen/EditPreorder.vue"
import ProfilePage from '../Screen/EditProfile.vue'
import AdminPage from '../Screen/AdminPage.vue'
import DaganganAdmin from '../Screen/DaganganAdmin.vue'
import PreorderAdmin from '../Screen/PreorderAdmin.vue'
import store from '../store';


const routes = [
  {
    path: '/',
    name: 'home',
    component: HomePage,

  },
  {
    path: '/admin',
    name: 'admin',
    component: AdminPage,
    meta: { requiresAuth: true, requiresAdmin: true }
  },
  {
    path: '/admin/dagangan',
    name: 'admin-dagangan',
    component: DaganganAdmin,
    meta: { requiresAuth: true, requiresAdmin: true }
  },
  {
    path: '/admin/preorder',
    name: 'admin-preorder',
    component: PreorderAdmin,
    meta: { requiresAuth: true, requiresAdmin: true }
  },
  {
    path: '/dagangan',
    name: 'dagangan',
    component: DaganganPage
  },
  {
    path: '/preorder',
    name: 'preorder',
    component: PreorderPage
  },
  {
    path: '/login',
    name: 'login',
    component: LoginPage,
  },
  {
    path: '/daftar',
    name: 'daftar',
    component: DaftarPage,
    meta: { requiresAuth: true }
  },
  {
    path: '/detail/dagangan/:id',
    name: 'detail-dagangan',
    component: DetailPage,
  },
  {
    path: '/detail/preorder/:id',
    name: 'detail-preorder',
    component: DetailPreorder
  },
  {
    path: '/register',
    name: 'register',
    component: RegisterPage
  },
  {
    path: '/item-saya',
    name: 'item-saya',
    component: ItemSayaPage,
    meta: { requiresAuth: true }
  },
  {
    path: '/profile',
    name: 'profile',
    component: ProfilePage,
    meta: { requiresAuth: true }
  },
  {
    path: '/dagangan/edit/:id',
    name: 'edit-dagangan',
    component: EditDagangan,
    meta: { requiresAuth: true }
  },
  {
    path: '/preorder/edit/:id',
    name: 'edit-preorder',
    component: EditPreorder,
    meta: { requiresAuth: true }
  },
]

const router = createRouter({
  history: createWebHistory(),
  routes,
  scrollBehavior: function (to, _from, savedPosition) {
    if (savedPosition) {
      return savedPosition;
    }
    if (to.hash) {
      return { el: to.hash, behavior: "smooth" };
    } else {
      window.scrollTo(0, 0);
    }
  }
})

router.beforeEach((to, from, next) => {
  if (to.meta.requiresAuth && !store.getters.isAuthenticated) {
    // User is not authenticated, redirect to login
    next('/login');
  } else {
    // Continue to the requested route
    next();
  }
});

router.beforeEach((to, from, next) => {
  if (to.meta.requiresAdmin && store.getters.getUser.role != 'admin') {
    // User is not authenticated, redirect to login
    next('/');
  } else {
    // Continue to the requested route
    next();
  }
});

export default router
