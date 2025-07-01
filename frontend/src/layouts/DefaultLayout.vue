<template>
  <div>
    <AppHeader />
    <div class="d-flex">
      <AppSidebar />
      <div :class="[isSidebarVisible ? 'flex-grow-1 ms-0' : 'w-100']" class="transition-all">
        <main class="p-4 bg-white min-vh-100"><router-view /><!--component: Dashboard--></main>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, provide } from 'vue'
import AppHeader from '@/components/AppHeader.vue'
import AppSidebar from '@/components/AppSidebar.vue'

const isSidebarVisible = ref(true)
const toggleSidebar = () => {
  isSidebarVisible.value = !isSidebarVisible.value
}

provide('isSidebarVisible', isSidebarVisible)
provide('toggleSidebar2', toggleSidebar)
</script>

<style>
.transition-all {
  transition: all 0.3s ease;
}
</style>
