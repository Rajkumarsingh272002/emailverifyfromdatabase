import axios from 'axios'
import { unref, ref } from 'vue'
const try_error1 = ref('')

const try_error = ref([])
function updateprofile(id, username, email, mobile, router, auth) {
  const updateProfile = async () => {
    try {
      const response = await axios.post(
        'http://localhost/pro1_Api_emailVerFromDatabase/projectFolderAllmainFolder/profileUpdateApi.php',
        {
          id: unref(id),
          username: unref(username),
          email: unref(email),
          mobile: unref(mobile),
        },
      )

      console.log('response.data', response.data)
      try_error.value = response.data.errors
      console.log('try_error', try_error)

      if (response.data.errors && Array.isArray(response.data.errors)) {
        try_error.value = response.data.errors
        console.log('auth.user222', auth.user)
        console.log('try_error.value', try_error.value)
      } else if (response.data.errors) {
        try_error.value = Array.isArray(response.data.errors)
          ? response.data.errors
          : [response.data.errors]
      } else if (response.data.message.includes('Profile updated successfully!')) {
        try_error.value = ''
        console.log('response data successfully', response.data)
        auth.updateUser({
          username: unref(username),
          email: unref(email),
          mobile: unref(mobile),
        })
        console.log('auth.user', auth.user)
        await router.push({ path: '/dashboardshow/profile', query: { success: 'true' } })
      }
    } catch (error) {
      console.log('Update failed:', error)
      try_error1.value = error
      console.log('try_error1', try_error1)
      console.log('auth.user', auth.user)
    }
  }
  return { updateProfile, try_error1, try_error }
}
export { updateprofile }
