<script setup>
import { registrationProcess } from '../composableFunction/registrationProcess2.js'
import { ref } from 'vue'
import { useAuthStore } from '@/storePinia/authStore'
import { useRoute } from 'vue-router'
const auth = useAuthStore()
const route = useRoute()

const fullname = ref('')
const email = ref('')
const phoneNumber = ref('')
const createPassword = ref('')
const repeatPassword = ref('')

//for icon password
const showPassword = ref(false)

//validation variable
const fullnameerror = ref(null) //or errorToAllFields=ref('')//take empty string
const fullnameerror1 = ref(null)

const emailerror = ref(null)
const emailerror1 = ref(null)

const phoneNumberError = ref(null)
const phoneNumberError1 = ref(null)

const createPasswordError = ref(null)
const createPasswordError1 = ref(null)

const repeatPassworderror = ref(null)
const repeatPassworderror1 = ref(null)
//destructure of composable-function
const { error2, getRegistrationData } = registrationProcess(
  fullname,
  email,
  phoneNumber,
  createPassword,
  repeatPassword,
)

function handleRegister() {
  if (validation()) {
    getRegistrationData() //processign ke liye ye method call hoga

    //// inputs clear karo
    fullname.value = ''
    email.value = ''
    phoneNumber.value = ''
    createPassword.value = ''
    repeatPassword.value = ''

    //// validation messages bhi hata do (optional)
    fullnameerror.value = ''
    fullnameerror1.value = false
    emailerror.value = ''
    emailerror1.value = false
    phoneNumberError.value = ''
    phoneNumberError1.value = false
    createPasswordError.value = ''
    createPasswordError1.value = false
    repeatPassworderror.value = ''
    repeatPassworderror1.value = false
  }
}
//check validation
//name validation
function validation() {
  let isValid = true
  if (fullname.value.trim() === '') {
    fullnameerror.value = 'Name is required'
    fullnameerror1.value = true
    isValid = false
  } else if (/[<>]/.test(fullname.value)) {
    fullnameerror.value = 'Name cannot contain < or >'
    fullnameerror1.value = true
    isValid = false
  } else if (!/^[a-zA-Z\s]+$/.test(fullname.value)) {
    fullnameerror.value = 'Name must contain only letters and spaces'
    fullnameerror1.value = true
    isValid = false
  } else {
    fullnameerror.value = 'Successfully filled fullName'
    fullnameerror1.value = false
    //isValid = true  yaha aapne app return hoga isliye mat do
  }

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

  //mobile number validation
  if (!phoneNumber.value) {
    phoneNumberError.value = 'PhoneNumber is required'
    phoneNumberError1.value = true
    isValid = false
  } else if (/[<>]/.test(phoneNumber.value)) {
    phoneNumberError.value = 'Name cannot contain < or >'
    phoneNumberError1.value = true
    isValid = false
  } else if (!/^[6-9]\d{9}$/.test(phoneNumber.value)) {
    phoneNumberError.value = 'Invalid phone number (10 digits, starts with 6-9)'
    phoneNumberError1.value = true
    isValid = false
  } else {
    phoneNumberError.value = 'Successfully filled phoneNumber'
    phoneNumberError1.value = false
  }

  //password validation
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

  //resetpassword password
  if (repeatPassword.value.trim() === '') {
    repeatPassworderror.value = 'Repeat password is required'
    repeatPassworderror1.value = true
    isValid = false
  } else if (!/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/.test(repeatPassword.value)) {
    repeatPassworderror.value =
      'Password must have 1 capital, 1 small, 1 number, 1 special & 8+ chars'
    repeatPassworderror1.value = true
    isValid = false
  } else if (repeatPassword.value.trim() !== createPassword.value.trim()) {
    repeatPassworderror.value = 'Passwords do not match' //' reset-password is not match with create-password'
    repeatPassworderror1.value = true
    isValid = false
  } else {
    repeatPassworderror.value = 'Password matched successfully'
    repeatPassworderror1.value = false
  }
  return isValid
}

//when jum ti login to regestrationconst route = useRoute()
const fresh = computed(() => route.query.fresh)
console.log('fresh:', fresh.value)
import { watch, computed } from 'vue'
watch(
  () => route.query.fresh,
  (val) => {
    console.log('watch triggered, fresh value:', val)
    if (val === 'true') {
      auth.user = ''
    }
  },
  { immediate: true }, // 👈 isse page load par bhi chalega
)
</script>

<template>
  <div>
    <h1 v-if="error2 && error2.value && error2.value.error">server not response anything</h1>
    <!--<h1 v-if="data">{{ data.fullName }} | {{ data.message }} | {{ data.error }}</h1>-->
    <!-- <p v-if="data">{{ 'welcome: ' + data.fullName }} {{ data.message }} {{ data.error }}</p>-->

    <div :class="{ size: true }" v-if="auth.user">
      <p class="alert alert-success" role="alert" v-if="auth.user.message">
        {{ auth.user.message }}
      </p>
      <p class="alert alert-danger" role="alert" v-else>{{ auth.user.error }}</p>
    </div>

    <div class="container" :class="{ size: true }">
      <form @submit.prevent="handleRegister">
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-user-circle"></i></span>
          </div>
          <div>
            <input
              type="text"
              class="form-control inputclass"
              placeholder="fullname"
              v-model="fullname"
              autofocus
            />
          </div>
          <div>
            <small>
              <span :class="fullnameerror1 ? 'setfield' : 'success'">
                {{ fullnameerror }}
              </span>
            </small>
          </div>
        </div>

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
            <span class="input-group-text"><i class="fas fa-phone"></i> </span>
          </div>
          <div>
            <input
              type="number"
              class="form-control inputclass"
              placeholder="phoneNumber"
              v-model="phoneNumber"
            />
          </div>
          <div>
            <small>
              <span :class="phoneNumberError1 ? 'setfield' : 'success'">
                {{ phoneNumberError }}
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
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-lock"></i> </span>
          </div>
          <div>
            <input
              type="password"
              class="form-control inputclass"
              placeholder="repeat password"
              v-model="repeatPassword"
            />
          </div>
          <div>
            <small>
              <span :class="repeatPassworderror1 ? 'setfield' : 'success'">{{
                repeatPassworderror
              }}</span>
            </small>
          </div>
        </div>

        <div class="input-group mb-3">
          <button type="submit" class="form-control text-center input-group1" name="submit">
            Create Account
          </button>
        </div>

        <div class="input-group mb-3">
          <div class="input-group-prepend"></div>
          <h1 class="form-control text-center" :style="{ fontWeight: 'bold' }">
            Have a account?<span :style="{ marginLeft: '5px', color: 'blue' }"
              ><router-link :to="{ name: 'Login', query: { fresh: true } }">Login</router-link>
            </span>
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
  left: 50%;
  transform: translateX(-50%);
  border: 2px solid;
  z-index: 1000; /* Upar lane ke liye, agar kuch overlap ho raha ho */
}

.size {
  width: 500px;
  margin: 50px auto;
  text-align: center;
  margin-bottom: 10px;
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
