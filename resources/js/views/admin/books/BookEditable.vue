<script setup>
import {
  requiredValidator,
} from '@validators'
// import axios from '@axios'
import { useBooksStore } from './useBooksStore'

const props = defineProps({
  data: {
    type: null,
    required: true,
  },
})
const router = useRouter()
const bookListStore = useBooksStore()

const refForm = ref()
const refInputEl = ref()

const bookDataLocal = ref(structuredClone(toRaw(props.data)))

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
        // bookListStore.addUser(bookDataLocal.value) // Add new

        let data = new FormData() // due to file attachment
        Object.keys(bookDataLocal.value).forEach(key => {
            data.append(key, bookDataLocal.value[key]);
        });

        bookListStore.addUser(data) // Add new

      }
      
      router.replace('/admin/books')    

    }
  })
}

const resetForm = () => {
  bookDataLocal.value = structuredClone(toRaw(props.data))
}

const changeAvatar = file => {
  const fileReader = new FileReader()
  const { files } = file.target
  if (files && files.length) {
    fileReader.readAsDataURL(files[0])
    fileReader.onload = () => {
      if (typeof fileReader.result === 'string')
        bookDataLocal.value.book_image = fileReader.result
    }
  }
}

// reset avatar image
const resetAvatar = () => {
  bookDataLocal.value.book_image = props.data.book_image
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
              v-model="bookDataLocal.name"
              :rules="[requiredValidator]"
              label="Book Title"
              placeholder="Enter Book Title"
            />
          </VCol>

          <!-- 👉 Description -->
          <VCol cols="12">
            <AppTextarea 
              v-model="bookDataLocal.description"
              label="Description" 
              placeholder="Enter Description"
            />
          </VCol>

          <!-- 👉 Thumbnail -->
          <VCol cols="12">
            <VCardText class="d-flex">
              <!-- 👉 Avatar -->
              <VAvatar
                rounded
                size="100"
                class="me-6"
                :image="bookDataLocal.book_image"
              />

              <!-- 👉 Upload Photo -->
              <form class="d-flex flex-column justify-center gap-4">
                <div class="d-flex flex-wrap gap-2">
                  <VBtn
                    color="primary"
                    size="small"
                    @click="refInputEl?.click()"
                  >
                    <VIcon
                      icon="tabler-cloud-upload"
                      class="d-sm-none"
                    />
                    <span class="d-none d-sm-block">Upload thumbnail</span>
                  </VBtn>

                  <input
                    ref="refInputEl"
                    type="file"
                    name="file"
                    accept=".jpeg,.png,.jpg,GIF"
                    hidden
                    @input="changeAvatar"
                  >

                  <VBtn
                    type="reset"
                    size="small"
                    color="secondary"
                    variant="tonal"
                    @click="resetAvatar"
                  >
                    <span class="d-none d-sm-block">Reset</span>
                    <VIcon
                      icon="tabler-refresh"
                      class="d-sm-none"
                    />
                  </VBtn>
                </div>

                <p class="text-body-1 mb-0">
                  Allowed JPG, GIF or PNG. Max size of 800K
                </p>
              </form>
            </VCardText>
          </VCol>          

          <!-- 👉 File -->
          <VCol cols="12">
            <VFileInput
              show-size
              v-model="bookDataLocal.book_file"
              label="Book File input"
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
              color="secondary"
              variant="tonal"
              type="reset"
              @click.prevent="resetForm"
            >
              Reset
            </VBtn>
          </VCol>          
        </VRow>
      </VForm>
    </VCardText>          
  </VCard>
</template>
