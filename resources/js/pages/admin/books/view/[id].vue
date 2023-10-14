<script setup>
import { formatDate } from '@core/utils/formatters'
// Store
import { useBooksStore } from '@/views/admin/books/useBooksStore'

const bookListStore = useBooksStore()
const route = useRoute()
const bookData = ref()

// 👉 fetchUser
bookListStore.fetchUser(Number(route.params.id)).then(response => {
  bookData.value = response.data

}).catch(error => {
  console.log(error)
})

const resolveStatusVariant = stat => {  
  if (stat == 1)
    return 'secondary'
  
  return 'success'
}
</script>

<template>
  <section v-if="bookData">
    <VRow>
      <VCol
        cols="12"
        md="9"
      >
        <VCard title="View Book">
          <VCardText>
            <VRow>
              <VCol
                cols="12"
                md="7"
              >
                <table class="text-base">
                  <tr>
                    <td style="width: 202px;">
                      <p class="font-weight-bold mb-2">
                        Book Title :
                      </p>
                    </td>
                    <td>
                      <p class="mb-2">
                        {{ bookData.name }}
                      </p>
                    </td>
                  </tr>

                  <tr>
                    <td>
                      <p class="font-weight-bold mb-2">
                        Book Category :
                      </p>
                    </td>
                    <td>
                      <p class="mb-2">
                        {{ bookData.category.name }}
                      </p>
                    </td>
                  </tr>

                  <tr>
                    <td>
                      <p class="font-weight-bold mb-2">
                        Tags :
                      </p>
                    </td>
                    <td>
                      <p class="mb-2">
                        <VChip
                          size="small"
                          color="warning"
                          label
                        >
                          25PEROFF
                        </VChip>
                      </p>
                    </td>
                  </tr>

                  <tr>
                    <td>
                      <p class="font-weight-bold mb-2">
                        Status : 
                      </p>
                    </td>
                    <td>
                      <p class="mb-2">
                        <VChip
                          :color="resolveStatusVariant(bookData.disabled)"
                          size="small"
                          label
                          class="text-capitalize"
                        >
                          <span v-if="bookData.disabled==1">Disabled</span>
                          <span v-else>Enabled</span>
                        </VChip>
                      </p>
                    </td>
                  </tr>

                  <tr>
                    <td>
                      <p class="font-weight-bold mb-2">
                        Created At : 
                      </p>
                    </td>
                    <td>
                      <p class="mb-2">
                        {{ formatDate(bookData.created_at) }}
                      </p>
                    </td>
                  </tr>

                  <tr>
                    <td>
                      <p class="font-weight-bold mb-2">
                        Updated At : 
                      </p>
                    </td>
                    <td>
                      <p class="mb-2">
                        {{ formatDate(bookData.updated_at) }}
                      </p>
                    </td>
                  </tr>  

                  <tr>
                    <td>
                      <p class="font-weight-bold mb-2">
                        Deleted At : 
                      </p>
                    </td>
                    <td>
                      <p class="mb-2">
                        {{ formatDate(bookData.deleted_at) }}
                      </p>
                    </td>
                  </tr>                                  
                </table>
              </VCol>

              <!-- Thumbnail -->
              <VCol
                cols="12"
                md="5"
              >
                <div class="border rounded pa-4 pb-0">
                  <VImg                    
                    :src="'/storage/images/books/thumbnail/'+bookData.thumbnail"
                    class="mx-auto"
                  />
                </div>
              </VCol>
            </VRow>
          </VCardText>

          <VDivider class="mb-2" />

          <VCardText>
            <div class="d-flex mx-sm-4">
              <h6 class="text-base font-weight-bold me-1">
                Description :
              </h6>
              <span>{{ bookData.description }}</span>
            </div>
          </VCardText>
        </VCard>
      </VCol>

      <VCol
        cols="12"
        md="3"
        class="d-print-none"
      >
        <VCard>
          <VCardText>
            <!-- 👉 Download -->
            <VBtn
              block
              variant="tonal"              
              color="secondary"
              class="mb-2"
              prepend-icon="tabler-download"
              :href="'/storage/images/books/'+bookData.file"
              target="_blank"
              rel="noopener noreferrer"              
            >
              Download Book
            </VBtn>

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
  </section>
</template>
