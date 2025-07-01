import { ref, unref, isRef, watchEffect } from 'vue'
import axios from 'axios'
const error = ref(null)
const error2 = ref(null)
const data = ref(null)

function login(email, createPassword, router, authStore) {
  const loginmatch = async () => {
    const form = {
      email: unref(email),
      createPassword: unref(createPassword),
    }

    try {
      const response = await axios({
        method: 'post',
        url: 'http://localhost/pro1_Api_emailVerFromDatabase/projectFolderAllmainFolder/loginApi.php',
        headers: { 'Content-Type': 'application/json' }, // ✅ lowercase 'headers'
        data: form,
      })
      console.log('response', response)
      error2.value = response.data.error

      if (response.data.message.includes('success')) {
        error.value = null // clear previous error
        console.log('Login success, redirecting...')
        authStore.loginSuccess(response.data)
        console.log('User from store:', authStore.user)
        console.log('auth.isAuthenticated:', authStore.isAuthenticated)
        await router.push('/dashboardshow')
      }
    } catch (err) {
      error.value = { error: 'Network error or server issue' }
      data.value = null
    }
  }
  return { data, error, error2, loginmatch }
}
export { login }
