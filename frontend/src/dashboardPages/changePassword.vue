<script setup>
import { useAuthStore } from '@/storePinia/authStore'
import { onMounted, ref, computed } from 'vue'
import { updateprofile } from '../composableFunction/profileUpdateProcessing.js'
import { changepassword } from '../composableFunction/changePassword.js'
import { useRouter, useRoute } from 'vue-router'
import { onBeforeRouteLeave, onBeforeRouteUpdate } from 'vue-router'
import { errorMessages } from 'vue/compiler-sfc'
const router = useRouter()
const auth = useAuthStore()

const id = ref(auth.user.id)
const currentPassword = ref('')
const newPassword = ref('')
const confirmPassword = ref('')

const newPasswordError = ref(null)
const newPasswordError1 = ref(null)

const confirmPassworderror = ref(null)
const confirmPassworderror1 = ref(null)

//destructure composable function
const { changePasswordmethod } = changepassword(id, currentPassword, newPassword, confirmPassword)

async function changePasswords() {
  if (validation() || !validation()) {
    const confirmed = window.confirm('क्या आप पासवर्ड चेंज करना चाहते हैं?')
    if (confirmed) {
      console.log('password changed...')
      await changePasswordmethod()
      console.log('changePasswordmethod is completed')
    } else {
      console.log('Password change cancelled by user.')
    }
  }
}
function clearTextField() {
  //console.log('clear text field ')
  currentPassword.value = ''
  newPassword.value = ''
  confirmPassword.value = ''

  newPasswordError.value = ''
  newPasswordError1.value = false

  confirmPassworderror.value = ''
  confirmPassworderror1.value = false
}

//this function used check for validation
function validation() {
  let isValid = true
  //password validation
  if (newPassword.value.trim() === '') {
    newPasswordError.value = 'CreatePassword is required'
    newPasswordError1.value = true
    isValid = false
  } else if (newPassword.value.length < 8) {
    newPasswordError.value = 'Password must be at least 8 characters'
    newPasswordError1.value = true
    isValid = false
  } else if (!/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/.test(newPassword.value)) {
    newPasswordError.value = 'Password must have 1 capital, 1 small, 1 number, 1 special & 8+ chars'
    newPasswordError1.value = true
    isValid = false
  } else {
    newPasswordError.value = 'Strong password'
    newPasswordError1.value = false
  }

  //resetpassword password
  if (confirmPassword.value.trim() === '') {
    confirmPassworderror.value = 'confirmPassword password is required'
    confirmPassworderror1.value = true
    isValid = false
  } else if (!/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/.test(confirmPassword.value)) {
    confirmPassworderror.value =
      'Password must have 1 capital, 1 small, 1 number, 1 special & 8+ chars'
    confirmPassworderror1.value = true
    isValid = false
  } else if (confirmPassword.value.trim() !== newPassword.value.trim()) {
    confirmPassworderror.value = 'Passwords do not match' //' reset-password is not match with create-password'
    confirmPassworderror1.value = true
    isValid = false
  } else {
    confirmPassworderror.value = 'Password matched successfully'
    confirmPassworderror1.value = false
  }
  return isValid
}
//clear cp and error messages if we go to any page or reload or revisit same page
// Clear message on mount and on route leave/update
onMounted(() => auth.resetMessages())
onBeforeRouteLeave(() => auth.resetMessages())
onBeforeRouteUpdate(() => auth.resetMessages())
</script>
<template>
  <h5 class="card-title mb-3 fs-1 text">Change Password</h5>
  <div class="row">
    <div class="setSpanCenter1">
      <span v-if="auth.err?.value?.length" class="setSpanCenter alert alert-danger fs-6 w-25">
        {{ auth.err.value[0] }}
      </span>

      <!-- Tabhi dikhao jab koi error na ho -->
      <!-- when error then this will be show-->
      <span
        v-else-if="auth.cp?.value?.Pass_change_succ"
        class="setSpanCenter alert alert-success fs-6 w-25"
      >
        {{ auth.cp.value.Pass_change_succ }}
      </span>
    </div>
  </div>
  <form @submit.prevent="changePasswords">
    <div class="card" style="width: 100%">
      <div class="card-body">
        <table class="table">
          <tbody>
            <tr>
              <th scope="col">Id</th>
              <td>
                {{ auth.user.id }}
              </td>
            </tr>
            <tr>
              <th scope="col">Current Password</th>
              <td>
                <input
                  v-model="currentPassword"
                  type="password"
                  class="form-control"
                  aria-label="Username"
                  aria-describedby="basic-addon1"
                  required
                />
              </td>
            </tr>

            <tr>
              <th scope="row">New Password</th>
              <td>
                <input
                  v-model="newPassword"
                  type="password"
                  class="form-control"
                  aria-label="Username"
                  aria-describedby="basic-addon1"
                />
                <div>
                  <small>
                    <span :class="newPasswordError1 ? 'setfield' : 'success'">
                      {{ newPasswordError }}
                    </span>
                  </small>
                </div>
              </td>
            </tr>

            <tr>
              <th scope="row">Confirm Password</th>
              <td>
                <input
                  v-model="confirmPassword"
                  type="password"
                  class="form-control"
                  aria-label="Username"
                  aria-describedby="basic-addon1"
                />
                <div>
                  <small>
                    <span :class="confirmPassworderror1 ? 'setfield' : 'success'">{{
                      confirmPassworderror
                    }}</span>
                  </small>
                </div>
              </td>
            </tr>

            <!-- for update button-->
            <tr>
              <th id="setLineforUpdate"></th>
              <td class="d-flex">
                <!--change button-->
                <button
                  class="btn btn-primary d-flex justify-content-center"
                  name="submit"
                  type="submit"
                >
                  change
                </button>
                <!--clear text field-->
                <button
                  @click.prevent="clearTextField"
                  class="btn btn-primary d-flex justify-content-center"
                  name="submit"
                  type="submit"
                >
                  clear
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
  transform: translateX(-10%);
  margin: 10px 10px;
}
#setLineforUpdate {
  border-right: none;
}
.setfield {
  color: red;
}
.success {
  color: green;
}
.setSpanCenter {
  margin-left: 35%;
  padding-bottom: 10px;
  padding-top: 5px;
}
</style>
