<script setup>
import {
  requiredValidator,
} from '@validators'
import axios from '@axios'
import { useCategoriessStore } from './useCategoriessStore'

const props = defineProps({
  data: {
    type: null,
    required: true,
  },
})
const router = useRouter()

const refForm = ref()

const CategoryyListStore = useCategoriessStore()

// // 👉 Clients
// const clients = ref([])

// // 👉 fetchClients
// bookListStore.fetchClients().then(response => {
//   clients.value = response.data
// }).catch(err => {
//   console.log(err)
// })

// const selectedOption = ref('book_category_id')
 

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
        CategoryyListStore.updateUser(props.data) // Update
      } else {
        CategoryyListStore.addUser(props.data) // Add new
      }
      
      router.replace('/admin/categoriess')    

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
