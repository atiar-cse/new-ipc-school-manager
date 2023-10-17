<script setup>
import CategoryEditable from '@/views/admin/categories/CategoryEditable.vue'

const categoryData = ref({
  // book: {
  //   id: '',
  //   name: '',
  //   book_category_id: '1',
  //   description: '',
  // },
  id: '',
  name: '',
  position: '',
  is_feature: '',
  //icon: '',
  //description: '',
})
</script>

<template>
  <VRow>
    <!-- 👉 CategoryEditable -->
    <VCol
      cols="12"
      md="9"
    >
      <VCard title="Add New Category">
        <CategoryEditable :data="categoryData" />
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
            :to="{ name: 'admin-categories' }"
          >
            Back to List
          </VBtn>          
        </VCardText>
      </VCard>
    </VCol>
  </VRow>
</template>
