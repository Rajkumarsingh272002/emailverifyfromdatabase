<template>
  <!--part 1 humberger button with toogle-->
  <nav class="navbar navbar-expand navbar-dark bg-dark">
    <button class="btn btn-link text-white" @click="toggleSidebar">
      <i class="fas fa-bars"></i>
    </button>

    <!--part2 humberger button with toogle nav-brand(for User Panel)-->
    <a class="navbar-brand ps-3" href="#">User Panel</a>

    <!--part3-->
    <ul class="navbar-nav ms-auto me-3">
      <div id="welcome">
        <h6 :style="{ color: 'white' }">Welcome: {{ auth.user.username }}</h6>
      </div>
      <!--part3-1-->
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
          <i class="fas fa-user fa-fw"></i>
        </a>
        <!--part3-2-->
        <ul class="dropdown-menu dropdown-menu-end">
          <li>
            <router-link class="dropdown-item" to="/dashboardshow/profile">Profile</router-link>
          </li>
          <li>
            <router-link class="dropdown-item" to="/dashboardshow/changePassword"
              >Change Password</router-link
            >
          </li>
          <li><hr class="dropdown-divider" /></li>
          <li><router-link class="dropdown-item" to="/logout">Logout</router-link></li>
        </ul>
      </li>
    </ul>
  </nav>
</template>

<style scoped>
#welcome {
  border-radius: 4px;
  background-color: blue;
  margin-right: 5px;
  margin-top: 10px;
  padding: 5px;
}
#welcome h6 {
  font-size: 15px;
}

/* ✅ Responsive font for small screens */
@media (max-width: 360px) {
  #welcome h6 {
    background-color: green;
    font-size: 10px;
    padding: 3px;
  }
}
</style>

<script setup>
import { useRouter } from 'vue-router'
import { useAuthStore } from '@/storePinia/authStore'
import { inject } from 'vue'
const toggleSidebar = inject('toggleSidebar2')
const auth = useAuthStore()

/*this is used handlerlout
function handleerlogout() {
  const auth = useAuthStore()
  const router = useRouter()
  auth.logout()
  router.push({ name: 'Login' })
  / *
  {
  path: '/',
  name: 'Login',
  component: login
}
  * /
}*/
</script>
