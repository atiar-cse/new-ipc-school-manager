<script setup>
import SchoolEditable from '@/views/admin/schools/SchoolEditable.vue'

const bookData = ref({
  // book: {
  //   id: '',
  //   name: '',
  //   book_category_id: '1',
  //   description: '',
  // },
  //id: '',
  //name: '',
  //book_category_id: 1,
  //description: '',
})
</script>

<template>
  <VRow>
    <!-- 👉 SchoolEditable -->
    <VCol
      cols="12"
      md="9"
    >
      <VCard title="Add New School">
        <SchoolEditable :data="schoolData" />
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
            :to="{ name: 'admin-schools' }"
          >
            Back to List
          </VBtn>          
        </VCardText>
      </VCard>
    </VCol>
  </VRow>
</template>
