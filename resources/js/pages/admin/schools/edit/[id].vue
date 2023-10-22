<script setup>
import BookEditable from '@/views/admin/books/BookEditable.vue'

// Store
import { useSchoolsStore } from '@/views/admin/schools/useSchoolsStore'

const schoolListStore = useSchoolsStore()
const route = useRoute()
const bookData = ref()

// 👉 fetchUser
schoolListStore.fetchSchool(Number(route.params.id)).then(response => {
  // bookData.value = {
  //   id: response.data.id,
  //   name: response.data.name,
  //   book_category_id: response.data.book_category_id,
  //   description: response.data.description,
  // }
  schoolData.value = response.data  
}).catch(error => {
  console.log(error)
})

</script>

<template>
  <VRow>
    <!-- 👉 schoolEditable   -->
    <VCol
      v-if="schoolData?.id"
      cols="12"
      md="9"
    >
      <VCard title="Edit School">
        <SchoolEditable :data="schoolData" />
      </VCard>
    </VCol>

    <!-- 👉 Right Column: School Action -->
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
