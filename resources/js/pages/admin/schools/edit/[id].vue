<script setup>
import BookEditable from '@/views/admin/books/BookEditable.vue'

// Store
import { useBooksStore } from '@/views/admin/books/useBooksStore'

const bookListStore = useBooksStore()
const route = useRoute()
const bookData = ref()

// 👉 fetchUser
bookListStore.fetchUser(Number(route.params.id)).then(response => {
  // bookData.value = {
  //   id: response.data.id,
  //   name: response.data.name,
  //   book_category_id: response.data.book_category_id,
  //   description: response.data.description,
  // }
  bookData.value = response.data  
}).catch(error => {
  console.log(error)
})

</script>

<template>
  <VRow>
    <!-- 👉 BookEditable   -->
    <VCol
      v-if="bookData?.id"
      cols="12"
      md="9"
    >
      <VCard title="Edit Book">
        <BookEditable :data="bookData" />
      </VCard>
    </VCol>

    <!-- 👉 Right Column: Book Action -->
    <VCol
      cols="12"
      md="3"
    >
      <VCard class="mb-8">
        <VCardText>
          <!-- 👉 Back to List -->
          <VBtn
            block
            variant="outlined"
            prepend-icon="tabler-arrow-left"
            :to="{ name: 'admin-books' }"
          >
            Back to List
          </VBtn>          
        </VCardText>
      </VCard>
    </VCol>

  </VRow>
</template>
