<script setup>
import {
  requiredValidator,
} from '@validators'
import axios from '@axios'
import { useBooksStore } from './useBooksStore'

const props = defineProps({
  data: {
    type: null,
    required: true,
  },
})
const router = useRouter()

const refForm = ref()

const bookListStore = useBooksStore()

// // 👉 Clients
// const clients = ref([])

// // 👉 fetchClients
// bookListStore.fetchClients().then(response => {
//   clients.value = response.data
// }).catch(err => {
//   console.log(err)
// })

// Add or Update
const onSubmit = () => {
  refForm.value?.validate().then(({ valid }) => {
    if (valid) {

      // axios.post('/api/v1/admin/books', props.data)
      // .then(r => {

      //   router.replace('/admin/books')
      // }).catch(e => {
      //   const { errors: formErrors } = e.response.data

      //   errors.value = formErrors
      //   console.error(e.response.data)
      // })

      if(props.data.id){
        bookListStore.updateUser(props.data) // Update
      } else {
        bookListStore.addUser(props.data) // Add new
      }
      
      router.replace('/admin/books')    

    }
  })
}
</script>

<template>
  <VCard>
    <VCardText>
      <!-- 👉 Form -->
      <VForm
        ref="refForm"
        v-model="isFormValid"
        @submit.prevent="onSubmit"
      >
        <VRow>
          <!-- 👉 Book Title -->
          <VCol cols="12">
            <AppTextField
              v-model="props.data.name"
              :rules="[requiredValidator]"
              label="Book Title"
              placeholder="Enter Book Title"
            />
          </VCol>

          <!-- 👉 Description -->
          <VCol cols="12">
            <AppTextarea 
              v-model="props.data.description"
              label="Description" 
              placeholder="Enter Description"
            />
          </VCol>

          <!-- 👉 Submit and Reset -->
          <VCol cols="12">
            <VBtn
              type="submit"
              class="me-3"
            >
              Submit
            </VBtn>
            <VBtn
              variant="tonal"
              color="secondary"
            >
              Reset
            </VBtn>
          </VCol>          
        </VRow>
      </VForm>
    </VCardText>          
  </VCard>
</template>
