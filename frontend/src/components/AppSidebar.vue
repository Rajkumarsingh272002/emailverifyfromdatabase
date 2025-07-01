<template>
  <div
    :class="['bg-dark text-white p-3', isSidebarVisible ? 'd-block' : 'd-none']"
    style="width: 240px; min-height: 100vh"
  >
    <div class="nav flex-column">
      <router-link to="/dashboardshow" class="nav-link text-white"
        ><i class="fas fa-tachometer-alt me-2"></i>Dashboard</router-link
      >
      <router-link to="/dashboardshow/profile" class="nav-link text-white"
        ><i class="fas fa-user me-2"></i>Profile</router-link
      >
      <router-link to="/dashboardshow/changePassword" class="nav-link text-white"
        ><i class="fas fa-key me-2"></i>Change Password</router-link
      >
      <router-link to="/logout" class="nav-link text-white"
        ><i class="fas fa-sign-out-alt me-2"></i>Logout</router-link
      >
    </div>
  </div>
</template>

<script setup>
import { inject } from 'vue'
const isSidebarVisible = inject('isSidebarVisible')
</script>
