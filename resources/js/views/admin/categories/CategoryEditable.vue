<script setup>
import {
  requiredValidator,
} from '@validators'
import axios from '@axios'
import { useCategoriesStore } from './useCategoriesStore'

const props = defineProps({
  data: {
    type: null,
    required: true,
  },
})
const router = useRouter()

const refForm = ref()

const categoriesListStore = useCategoriesStore()

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
        categoriesListStore.updateUser(props.data) // Update
      } else {
        categoriesListStore.addUser(props.data) // Add new
      }
      
      router.replace('/admin/categories')    

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
          <!-- 👉 Category Name -->
          <VCol cols="12">
            <AppTextField
              v-model="props.data.name"
              :rules="[requiredValidator]"
              label="Category Name"
              placeholder="Enter Category Name"
            />
          </VCol>

          <!-- 👉 Category Position -->
          <VCol cols="12">
            <AppTextField
              v-model="props.data.position"
              :rules="[requiredValidator]"
              label="Category Position"
              placeholder="Enter Category Position"
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
