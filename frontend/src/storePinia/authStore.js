import { defineStore } from 'pinia'
import { ref, watch } from 'vue'
export const useAuthStore = defineStore('auth', () => {
  //here we used localstorage for login as always will be make if we used new tab or refresh when we close the browser and or signout
  const isAuthenticated = ref(JSON.parse(localStorage.getItem('isAuthenticated')) || false)
  const user = ref(JSON.parse(localStorage.getItem('user')) || null)
  const cp = ref(null)
  const err = ref(null)
  function loginSuccess(userdata) {
    isAuthenticated.value = true
    user.value = userdata
    localStorage.setItem('isAuthenticated', true)
    localStorage.setItem('user', JSON.stringify(userdata))
  }

  function logout() {
    isAuthenticated.value = false
    user.value = null
    localStorage.removeItem('isAuthenticated')
    localStorage.removeItem('user')
  }
  function updateUser(updatedData) {
    if (user.value) {
      user.value = { ...user.value, ...updatedData }
      localStorage.setItem('user', JSON.stringify(user.value))
    }
  }
  const changePasswordSucess = ''
  const error = ''
  function changepasswordPina(changePasswordSucess, error) {
    cp.value = changePasswordSucess

    err.value = error
  }
  function resetMessages() {
    err.value = []
    cp.value = {}
  }

  return {
    loginSuccess,
    logout,
    user,
    isAuthenticated,
    cp,
    err,
    updateUser,
    changepasswordPina,
    resetMessages,
  }
})
