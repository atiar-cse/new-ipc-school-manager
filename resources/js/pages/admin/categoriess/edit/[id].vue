<script setup>
import CategoryEditable from '@/views/admin/categories/CategoryEditable.vue'

// Store
import { useCategoriesStore } from '@/views/admin/categories/useCategoriesStore'

const categoryListStore = useCategoriesStore()
const route = useRoute()
const categoryData = ref()

// 👉 fetchUser
categoryListStore.fetchUser(Number(route.params.id)).then(response => {
  // bookData.value = {
  //   id: response.data.id,
  //   name: response.data.name,
  //   book_category_id: response.data.book_category_id,
  //   description: response.data.description,
  // }
  categoryData.value = response.data  
}).catch(error => {
  console.log(error)
})

</script>

<template>
  <VRow>
    <!-- 👉 CategoryEditable   -->
    <VCol
      v-if="categoryData?.id"
      cols="12"
      md="9"
    >
      <VCard title="Edit Book">
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
