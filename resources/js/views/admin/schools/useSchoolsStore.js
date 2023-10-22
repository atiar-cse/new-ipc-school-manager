import { defineStore } from 'pinia'
import axios from '@axios'

export const useSchoolsStore = defineStore('SchoolsStore', {
  actions: {
    // 👉 Fetch schools data
    fetchSchools(params) { return axios.get('/api/v1/admin/schools', { params }) },

    // 👉 Add School
    addSchool(schoolData) {
      return new Promise((resolve, reject) => {
        axios.post('/api/v1/admin/schools', schoolData) // {user: userData,}
          .then(response => resolve(response))
          .catch(error => reject(error))
      })
    },

    // 👉 fetch single school
    fetchSchool(id) {
      return new Promise((resolve, reject) => {
        axios.get(`/api/v1/admin/schools/${id}`).then(response => resolve(response)).catch(error => reject(error))
      })
    },

    // 👉 Update School
    updateSchool(schoolData) {
      return new Promise((resolve, reject) => {
        axios.put(`/api/v1/admin/schools/${schoolData.id}`, schoolData) // {user: userData,}
          .then(response => resolve(response))
          .catch(error => reject(error))
      })
    },

    // 👉 Delete School
    deleteSchool(id) {
      return new Promise((resolve, reject) => {
        axios.delete(`/api/v1/admin/schools/${id}`).then(response => resolve(response)).catch(error => reject(error))
      })
    },
  },
})
