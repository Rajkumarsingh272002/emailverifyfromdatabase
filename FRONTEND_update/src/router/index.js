import { createRouter, createWebHistory } from 'vue-router'
import DefaultLayout from '@/layouts/DefaultLayout.vue'
import Dashboard from '@/dashboardPages/Dashboard.vue'
import registerd from '../pages/registerd.vue'
import login from '../pages/login.vue'
import { useAuthStore } from '@/storePinia/authStore'
import profile from '@/dashboardPages/profile.vue'
import profileUpdate from '@/dashboardPages/profileUpdate.vue'
import changePassword from '@/dashboardPages/changePassword.vue'
const routes = [
  {
    path: '/registered',
    name: 'registered',
    component: registerd,
  },
  { path: '/', name: 'Login', component: login },

  {
    path: '/dashboardshow',
    component: DefaultLayout,
    meta: { requiresAuth: true }, //Add meta: { requiresAuth: true } only on protected routes
    children: [
      //{ path: '', redirect: '/dashboard' },//
      { path: '', component: Dashboard },
      { path: 'profile', component: profile },
      { path: 'profileUpdate', component: profileUpdate },
      { path: '/dashboardshow/changePassword', component: changePassword },
    ],
  },

  {
    path: '/logout',
    name: 'logout',
    beforeEnter: (to, from, next) => {
      const auth = useAuthStore()
      auth.logout()
      next({ name: 'Login' }) // properly redirect after logout
    },
  },
]

const router = createRouter({
  history: createWebHistory(),
  routes, // <-- yeh array hai
})

// ✅ Navigation Guard router pe lagta hai:
router.beforeEach((to, from, next) => {
  // 👇 Store ko yahan call karo taaki context mil jaye
  const auth = useAuthStore()
  // Agar route me `meta.requiresAuth` hai aur user login nahi hai
  if (to.meta.requiresAuth && !auth.isAuthenticated) {
    next({ name: 'Login' }) // Login page pe redirect karo
  } else {
    next() // warna allow karo//// 👇 User login hai, route par jaane do
  }
})

export default router
