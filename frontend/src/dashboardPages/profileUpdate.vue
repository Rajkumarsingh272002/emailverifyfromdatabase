<script setup>
import { useAuthStore } from '@/storePinia/authStore'
import { onMounted, ref, computed } from 'vue'
import { updateprofile } from '../composableFunction/profileUpdateProcessing.js'
import { useRouter, useRoute } from 'vue-router'
const router = useRouter()
const auth = useAuthStore()

const id = ref('')
const username = ref('')
const email = ref('')
const mobile = ref('')
onMounted(() => {
  id.value = auth.user.id
  username.value = auth.user.username
  email.value = auth.user.email
  mobile.value = auth.user.mobile
})
//destructure of profileUpdateProcessing
const { updateProfile, try_error, try_error1 } = updateprofile(
  id,
  username,
  email,
  mobile,
  router,
  auth,
)
//function handle
function handleProfileUpdate() {
  console.log('call handleProfileUpdate')
  updateProfile()
}
</script>
<template>
  <h5 class="card-title mb-3 fs-1 text">{{ auth.user.username }}</h5>
  <form @submit.prevent="handleProfileUpdate">
    <div class="card" style="width: 100%">
      <div class="card-body">
        <!-- त्रुटियों को प्रदर्शित करें -->
        <div v-if="try_error.length" class="alert alert-danger">
          <ul>
            <li v-for="(error, index) in try_error" :key="index">{{ error }}</li>
          </ul>
        </div>

        <table class="table">
          <tbody>
            <tr>
              <th scope="col">Id</th>
              <td>
                {{ auth.user.id }}
              </td>
            </tr>
            <tr>
              <th scope="col">Username</th>
              <td>
                <input
                  v-model="username"
                  type="text"
                  class="form-control"
                  aria-label="Username"
                  aria-describedby="basic-addon1"
                />
              </td>
            </tr>
            <tr>
              <th scope="row">Email</th>
              <td>
                <input
                  v-model="email"
                  type="email"
                  class="form-control"
                  aria-label="Username"
                  aria-describedby="basic-addon1"
                />
              </td>
            </tr>
            <tr>
              <th scope="row">Mobile</th>
              <td>
                <input
                  v-model="mobile"
                  type="number"
                  class="form-control"
                  aria-label="Username"
                  aria-describedby="basic-addon1"
                  maxlength="10"
                />
              </td>
            </tr>

            <!-- for update button-->
            <tr>
              <th id="setLineforUpdate"></th>
              <td>
                <button
                  class="btn btn-primary d-flex justify-content-center"
                  name="submit"
                  type="submit"
                >
                  Update
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </form>
</template>
<style scoped>
th {
  border-right: 1px solid red;
  padding-right: 50px !important; /* Force padding with !important */
}
td {
  padding-left: 40px !important; /* Force padding with !important */
}
.d-flex {
  transform: translateX(50%);
  margin: 10px 10px;
}
#setLineforUpdate {
  border-right: none;
}
</style>
