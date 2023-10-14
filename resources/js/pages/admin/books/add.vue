<script setup>
import BookEditable from '@/views/admin/books/BookEditable.vue'

const bookData = ref({
  // book: {
  //   id: '',
  //   name: '',
  //   book_category_id: '1',
  //   description: '',
  // },
  id: '',
  name: '',
  book_category_id: 1,
  book_image: '',
  book_file: '',
  description: '',
})
</script>

<template>
  <VRow>
    <!-- 👉 BookEditable -->
    <VCol
      cols="12"
      md="9"
    >
      <VCard title="Add New Book">
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
