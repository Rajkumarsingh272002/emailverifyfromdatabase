<script setup>
import { useAuthStore } from '@/storePinia/authStore'
import { useRouter, useRoute } from 'vue-router'
import { onMounted, ref, computed } from 'vue'
const auth = useAuthStore()
/*
when do update using by (profileUpdateProcessing.js). here on (profileUpdate.vue) we add query-parameter from url
on dashboardshow/profile using useRoute() can accessign parameter and show success message
*/
const route = useRoute()
const successMessage = computed(() => {
  return route.query.success === 'true' ? 'Updated successfully' : ''
})
</script>
<template>
  <h5 class="card-title mb-3 fs-1 text">{{ auth.user.username }}</h5>
  <div class="card" style="width: 100%">
    <div class="card-body">
      <p class="card-text">
        <Router-link to="/dashboardshow/profileUpdate">Edit</Router-link>
        <span
          v-if="successMessage"
          class="setSpanCenter alert alert-success"
          :class="{ setSpanCenter: true }"
        >
          {{ successMessage }}
        </span>
      </p>
      <table class="table">
        <tbody>
          <tr>
            <th scope="col">Id</th>
            <td>{{ auth.user.id }}</td>
          </tr>
          <tr>
            <th scope="col">Username</th>
            <td>{{ auth.user.username }}</td>
          </tr>
          <tr>
            <th scope="row">Email</th>
            <td>{{ auth.user.email }}</td>
          </tr>
          <tr>
            <th scope="row">Mobile</th>
            <td class="ps-4">{{ auth.user.mobile }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>
<style scoped>
th {
  border-right: 1px solid red;
  padding-right: 50px !important; /* Force padding with !important */
}
td {
  padding-left: 40px !important; /* Force padding with !important */
}
.setSpanCenter {
  margin-left: 30%;
  padding-bottom: 10px;
  padding-top: 5px;
}
</style>
