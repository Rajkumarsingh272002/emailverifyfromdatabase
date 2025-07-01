import { ref, unref, isRef, watchEffect } from 'vue'
import axios from 'axios'
import { useAuthStore } from '../storePinia/authStore.js'

const error = ref(null)
const error2 = ref(null)
const data = ref(null)

function registrationProcess(fullName, email, phoneNumber, createPassword, repeatPassword) {
  const getRegistrationData = async () => {
    //reset to All
    const form = {
      fullName: unref(fullName),
      email: unref(email),
      phoneNumber: unref(phoneNumber),
      createPassword: unref(createPassword),
      repeatPassword: unref(repeatPassword),
    }

    try {
      const res = await axios({
        method: 'post',
        url: 'http://localhost/pro1_Api_emailVerFromDatabase/projectFolderAllmainFolder/inserdataAndEmailVerify.php',

        headers: { 'Content-Type': 'application/json' }, // ✅ lowercase 'headers'
        data: form,
      })
      const auth = useAuthStore()
      auth.user = res.data
      console.log('auth.user', auth.user)
    } catch (err) {
      error2.value = { error: 'Network error or server issue' }
    }
  }
  return { error2, getRegistrationData }
}
export { registrationProcess }
