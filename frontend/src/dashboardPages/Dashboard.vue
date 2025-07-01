<template>
  <div>
    <h1 class="mt-4">Dashboard</h1>
    <hr />
    <div class="row">
      <div class="card bg-primary text-white mb-4 col-8">
        <div class="card-body">Welcome Back => {{ auth.user.username }}</div>
        <div class="card-footer d-flex align-items-center justify-content-between">
          <router-link to="/dashboardshow/profile" class="small text-white stretched-link"
            >View Profile</router-link
          >
          <div class="small text-white"><i class="fas fa-angle-right"></i></div>
        </div>
      </div>
    </div>
  </div>
</template>
<script setup>
import { useAuthStore } from '../storePinia/authStore'
const auth = useAuthStore()
</script>
