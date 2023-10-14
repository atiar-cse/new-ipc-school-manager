import { defineStore } from 'pinia'
import axios from '@axios'

export const useSchoolsStore = defineStore('SchoolsStore', {
  actions: {
    // 👉 Fetch users data
    fetchUsers(params) { return axios.get('/api/v1/admin/schools', { params }) },

    // 👉 Add User
    addUser(userData) {
      return new Promise((resolve, reject) => {
        axios.post('/api/v1/admin/schools', userData) // {user: userData,}
          .then(response => resolve(response))
          .catch(error => reject(error))
      })
    },

    // 👉 fetch single user
    fetchUser(id) {
      return new Promise((resolve, reject) => {
        axios.get(`/api/v1/admin/schools/${id}`).then(response => resolve(response)).catch(error => reject(error))
      })
    },

    // 👉 Update User
    updateUser(userData) {
      return new Promise((resolve, reject) => {
        axios.put(`/api/v1/admin/schools/${userData.id}`, userData) // {user: userData,}
          .then(response => resolve(response))
          .catch(error => reject(error))
      })
    },

    // 👉 Delete User
    deleteUser(id) {
      return new Promise((resolve, reject) => {
        axios.delete(`/api/v1/admin/schools/${id}`).then(response => resolve(response)).catch(error => reject(error))
      })
    },
  },
})
