<script setup>
import { login } from '../composableFunction/loginProcess.js'
import { ref } from 'vue'
import { useRouter, useRoute } from 'vue-router'
import { useAuthStore } from '@/storePinia/authStore'
const email = ref('')
const createPassword = ref('')
//for icon password
const showPassword = ref(false)

//validation variable
const emailerror = ref(null)
const emailerror1 = ref(null)
const createPasswordError = ref(null)
const createPasswordError1 = ref(null)

const router = useRouter()
const authStore = useAuthStore()

//destructure of composable-function
const { data, error, error2, loginmatch } = login(email, createPassword, router, authStore)

async function handlelogin() {
  if (validation()) {
    await loginmatch() //processign ke liye ye method call hoga

    //// inputs clear karo
    email.value = ''
    createPassword.value = ''

    //// validation messages bhi hata do (optional)
    emailerror.value = ''
    emailerror1.value = false
    createPasswordError.value = ''
    createPasswordError1.value = false
  }
}
//check validation
function validation() {
  let isValid = true

  //email validation
  const trimmedemail = email.value.trim()
  if (trimmedemail === '') {
    emailerror.value = 'email is required'
    emailerror1.value = true
    isValid = false
  } else if (/[<>]/.test(trimmedemail)) {
    emailerror.value = 'Name cannot contain < or >'
    emailerror1.value = true
    isValid = false
  } else if (!/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test(trimmedemail)) {
    emailerror.value = 'Please enter a valid email (like example@domain.com)'
    emailerror1.value = true
    isValid = false
  } else {
    emailerror.value = 'Successfully filled email'
    emailerror1.value = false
  }

  //create password validation
  if (createPassword.value.trim() === '') {
    createPasswordError.value = 'CreatePassword is required'
    createPasswordError1.value = true
    isValid = false
  } else if (createPassword.value.length < 8) {
    createPasswordError.value = 'Password must be at least 8 characters'
    createPasswordError1.value = true
    isValid = false
  } else if (!/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/.test(createPassword.value)) {
    createPasswordError.value =
      'Password must have 1 capital, 1 small, 1 number, 1 special & 8+ chars'
    createPasswordError1.value = true
    isValid = false
  } else {
    createPasswordError.value = 'Strong password'
    createPasswordError1.value = false
  }

  return isValid
}
//bad me check kar lena hata kar console.log('agar response nahi aa raha he tab error dikhega ERROR:', error.value)

//here we watrch effect reason we claer error ya reactivety when we jum from signup to login
//when jump signup login to  for no show alert-error(will be like same as refresg login)
// ✅ Option 1 - Clear error jab fresh=true
const route = useRoute()
const fresh = computed(() => route.query.fresh)
console.log('fresh:', fresh.value)
import { watch, computed } from 'vue'
watch(
  () => route.query.fresh,
  (val) => {
    console.log('watch triggered, fresh value:', val)
    if (val === 'true') {
      error2.value = ''
    }
  },
  { immediate: true }, // 👈 isse page load par bhi chalega
)

/*
import { onMounted } from 'vue'

onMounted(() => {
  error2.value = ''
})
  */
</script>

<template>
  <div>
    <!--this 'error' are for vue.js error-->
    <h1 v-if="error && error.value && error.value.error">server not response anything</h1>

    <!--this error comes from storePina and error2-->
    <div :class="{ size: true }" v-if="error2">
      <p v-if="error2" class="alert alert-danger" role="alert">
        {{ error2 }}
      </p>
    </div>

    <div class="container" :class="{ size: true }">
      <form @submit.prevent="handlelogin">
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-envelope"></i> </span>
          </div>
          <div>
            <input
              type=""
              class="form-control inputclass"
              placeholder="Email Address"
              v-model="email"
            />
          </div>
          <div>
            <small>
              <span :class="emailerror1 ? 'setfield' : 'success'">
                {{ emailerror }}
              </span>
            </small>
          </div>
        </div>

        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-lock"></i> </span>
          </div>
          <!-- Wrapper div for relative positioning -->
          <div style="position: relative">
            <input
              :type="showPassword ? 'text' : 'password'"
              class="form-control inputclass"
              placeholder="Create Password"
              v-model="createPassword"
            />
            <!-- Eye Icon -->
            <i
              class="fa"
              :class="showPassword ? 'fa-eye-slash' : 'fa-eye'"
              @click="showPassword = !showPassword"
              style="
                position: absolute;
                top: 50%;
                right: 15px;
                transform: translateY(-50%);
                cursor: pointer;
                color: #666;
              "
            >
            </i>
          </div>
          <div>
            <small>
              <span :class="createPasswordError1 ? 'setfield' : 'success'">
                {{ createPasswordError }}
              </span>
            </small>
          </div>
        </div>

        <div class="input-group mb-3">
          <button type="submit" class="form-control text-center input-group1" name="submit">
            Login Now
          </button>
        </div>

        <div class="input-group mb-3">
          <div class="input-group-prepend"></div>
          <h1 class="form-control text-center" :style="{ fontWeight: 'bold' }">
            Don't Have a account?<span :style="{ marginLeft: '5px', color: 'blue' }"
              ><Router-link :to="{ name: 'registered', query: { fresh: true } }"
                >Sign Up Here</Router-link
              ></span
            >
          </h1>
        </div>
      </form>
    </div>
  </div>
</template>
<style scoped>
.input-group1 {
  background-color: aqua;
  margin-top: 5px;
  font-weight: bold;
}
.container {
  position: fixed;
  top: 80px;
  border: 2px solid;
  left: 50%;
  transform: translatex(-50%);
}

.size {
  width: 500px;
  margin: 0 auto;
  margin-top: 70px;
  text-align: center;
}
.inputclass {
  width: 420px;
}
.setfield {
  color: red;
}
.success {
  color: green;
}
</style>
