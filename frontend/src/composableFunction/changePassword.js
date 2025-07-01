import { unref, ref } from 'vue'
import axios from 'axios'
import { useAuthStore } from '../storePinia/authStore'

const passChangeSuccess = ref('')
const errorComeFromServer = ref([])

function changepassword(id, currentPassword, newPassword, confirmPassword) {
  const changePasswordmethod = async () => {
    errorComeFromServer.value = [] // 🧹  clears completes errors
    passChangeSuccess.value = '' // 🧹 complete clear all success
    try {
      //reset
      const passChangeSuccess = ref('')
      const response = await axios.post(
        'http://localhost/pro1_Api_emailVerFromDatabase/projectFolderAllmainFolder/changePasswordApi.php',
        {
          id: unref(id),
          currentPassword: unref(currentPassword),
          newPassword: unref(newPassword),
          confirmPassword: unref(confirmPassword),
        },
      )
      console.log('Full response:', response) //this ensure that what response is coming or not
      console.log('Response data:', response.data) //this ensure that what response data is coming or not

      if (response.data) {
        //if this true
        if (response.data.Pass_change_succ === 'password change successfully') {
          console.log('Password change was successful.')
          passChangeSuccess.value = response.data
          //useAuth.changepasswordPina(passChangeSuccess)
          console.log(passChangeSuccess)
          console.log(passChangeSuccess.value)
          //if Password be success so	errorComeFromServer.value = [] nesessary to write
          errorComeFromServer.value = [] // 🟢🟢 here Reset error that means clear all error
        } else {
          console.log('Password change message does not match.')
          errorComeFromServer.value = response.data
          console.log(errorComeFromServer.value[0])
          // useAuth.changepasswordPina(errorComeFromServer)
          passChangeSuccess.value = {} // 🟢🟢 if error then all passChangeSuccess.value will be blank
        }
      } else {
        console.log('Pass_change_succ is undefined.')
      }
      if (response.data) {
        const useAuth = useAuthStore()
        useAuth.changepasswordPina(passChangeSuccess, errorComeFromServer)
        console.log('auth.cp', useAuth.cp)
        console.log('auth.cp', useAuth.cp.value)
      }
    } catch (error) {
      console.log('catch error', error) //this is used for check
    }
  }
  return { changePasswordmethod }
}
export { changepassword }
