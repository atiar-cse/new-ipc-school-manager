<script setup>
import { VDataTableServer } from 'vuetify/labs/VDataTable'
import { paginationMeta } from '@/@paginate/utils'
// import AddNewUserDrawer from '@/views/apps/user/list/AddNewUserDrawer.vue'
import { useBooksStore } from '@/views/admin/books/useBooksStore'
import { formatDate } from '@core/utils/formatters'

const bookListStore = useBooksStore()
const searchQuery = ref('')
const selectedCategoryIds = ref()
const selectedTagIds = ref()
const selectedStatus = ref()
const totalPage = ref(1)
const totalUsers = ref(0)
const users = ref([])

const options = ref({
  page: 1,
  itemsPerPage: 10,
  sortBy: [],
  groupBy: [],
  search: undefined,
})

// Headers
const headers = [
  {
    title: '#ID',
    key: 'id',
  },
  {
    title: 'Book Title',
    key: 'name',
  },  
  {
    title: 'Category',
    key: 'category',
  },  
  {
    title: 'Thumbnail',
    key: 'thumbnail',
  },
  {
    title: 'File',
    key: 'file',
  },   
  {
    title: 'Status',
    key: 'status',
  },
  {
    title: 'created at',
    key: 'created_at',
  },  
  {
    title: 'Actions',
    key: 'actions',
    sortable: false,
  },
]

// 👉 Fetching users
const fetchUsers = () => {
  bookListStore.fetchUsers({
    q: searchQuery.value,
    status: selectedStatus.value,
    category_ids: selectedCategoryIds.value,
    tag_ids: selectedTagIds.value,
    options: options.value,
  }).then(response => {

    users.value = response.data.data
    totalPage.value = response.data.to
    totalUsers.value = response.data.total
    options.value.page = response.data.current_page
  }).catch(error => {
    console.error(error)
  })
}

watchEffect(fetchUsers)

// 👉 search filters

const status = [
  {
    title: 'Enabled',
    value: 0,
  },
  {
    title: 'Disabled',
    value: 1,
  },
]

const resolveStatusVariant = stat => {  
  if (stat == 1)
    return 'secondary'
  
  return 'success'
}


// const addNewUser = userData => {
//   bookListStore.addUser(userData)

//   // refetch User
//   fetchUsers()
// }

const deleteUser = id => {
  bookListStore.deleteUser(id)

  // refetch User
  fetchUsers()
}
</script>

<template>
  <section>
    <VRow>
      <VCol cols="12">
        <VCard title="All Books">
          <!-- 👉 Filters -->
          <VCardText>
            <VRow>
              <!-- 👉 Select Category -->
              <VCol
                cols="12"
                sm="4"
              >
                <AppSelect
                  v-model="selectedRole"
                  label="Select Category"
                  :items="roles"
                  clearable
                  clear-icon="tabler-x"
                />
              </VCol>
              <!-- 👉 Select Tags -->
              <VCol
                cols="12"
                sm="4"
              >
                <AppSelect
                  v-model="selectedPlan"
                  label="Select Tags"
                  :items="plans"
                  clearable
                  clear-icon="tabler-x"
                />
              </VCol>
              <!-- 👉 Select Status -->
              <VCol
                cols="12"
                sm="4"
              >
                <AppSelect
                  v-model="selectedStatus"
                  label="Select Status"
                  :items="status"
                  clearable
                  clear-icon="tabler-x"
                />
              </VCol>
            </VRow>
          </VCardText>

          <VDivider />

          <VCardText class="d-flex flex-wrap py-4 gap-4">
            <div class="me-3 d-flex gap-3">
              <AppSelect
                :model-value="options.itemsPerPage"
                :items="[
                  { value: 10, title: '10' },
                  { value: 25, title: '25' },
                  { value: 50, title: '50' },
                  { value: 100, title: '100' },
                  { value: -1, title: 'All' },
                ]"
                style="width: 6.25rem;"
                @update:model-value="options.itemsPerPage = parseInt($event, 10)"
              />
            </div>
            <VSpacer />

            <div class="app-user-search-filter d-flex align-center flex-wrap gap-4">
              <!-- 👉 Search  -->
              <div style="inline-size: 10rem;">
                <AppTextField
                  v-model="searchQuery"
                  placeholder="Search"
                  density="compact"
                />
              </div>

              <!-- 👉 Export button -->
              <VBtn
                variant="tonal"
                color="secondary"
                prepend-icon="tabler-screen-share"
              >
                Export
              </VBtn>

              <!-- 👉 Add book button -->
              <VBtn
                prepend-icon="tabler-plus"
                :to="{ name: 'admin-books-add' }"
              >
                Add New Book
              </VBtn>
            </div>
          </VCardText>

          <VDivider />

          <!-- SECTION datatable -->
          <VDataTableServer
            v-model:items-per-page="options.itemsPerPage"
            v-model:page="options.page"
            :items="users"
            :items-length="totalUsers"
            :headers="headers"
            class="text-no-wrap"
            @update:options="options = $event"
          >
            <!-- id -->
            <template #item.name="{ item }">
              <RouterLink :to="{ name: 'admin-books-view-id', params: { id: item.raw.id } }">
                {{ item.raw.name }}
              </RouterLink>
            </template>

            <!-- Category -->
            <template #item.category="{ item }">
              {{ item.raw.category.name }}
            </template>

            <!-- Thumbnail -->
            <template #item.thumbnail="{ item }">
              <div class="">                
                <VTooltip>
                  <template #activator="{ props }">
                    <VAvatar
                      :size="38"
                      v-bind="props"
                      variant="tonal"
                      class="me-3"
                    >
                      <VImg
                        v-if="item.raw.thumbnail"
                        :src="'/storage/images/books/thumbnail/'+item.raw.thumbnail"
                      />
                      <span v-else></span>
                    </VAvatar>
                  </template>

                  <VAvatar
                    size="170"
                    :variant="!item.raw.thumbnail ? 'tonal' : undefined"
                    class="me-3"
                  >
                    <VImg
                      v-if="item.raw.thumbnail"
                      :src="'/storage/images/books/thumbnail/'+item.raw.thumbnail"
                    />
                    <span v-else>Not Found</span>
                  </VAvatar>                  
                </VTooltip>                               
              </div>              
            </template>

            <!-- File -->
            <template #item.file="{ item }">
              <IconBtn 
                v-if="item.raw.file"
                :href="'/storage/images/books/'+item.raw.file"
                target="_blank"
                rel="noopener noreferrer"
              >
                <VIcon icon="tabler-download" />
              </IconBtn>              
            </template>

            <!-- Status -->
            <template #item.status="{ item }">
              <VChip
                :color="resolveStatusVariant(item.raw.disabled)"
                size="small"
                label
                class="text-capitalize"
              >
                <span v-if="item.raw.disabled==1">Disabled</span>
                <span v-else>Enabled</span>
              </VChip>
            </template>

            <!-- Created At -->
            <template #item.created_at="{ item }">
              {{ formatDate(item.raw.created_at) }}
            </template>

            <!-- Actions -->
            <template #item.actions="{ item }">
              <IconBtn :to="{ name: 'admin-books-edit-id', params: { id: item.raw.id } }">
                <VIcon icon="tabler-edit" />
              </IconBtn>

              <IconBtn :to="{ name: 'admin-books-view-id', params: { id: item.raw.id } }">
                <VIcon icon="tabler-eye" />
              </IconBtn>

              <IconBtn @click="deleteUser(item.raw.id)">
                <VIcon icon="tabler-trash" />
              </IconBtn>

              <VBtn
                icon
                variant="text"
                size="small"
                color="medium-emphasis"
              >
                <VIcon
                  size="24"
                  icon="tabler-dots-vertical"
                />

                <VMenu activator="parent">
                  <VList>
                    <VListItem :to="{ name: 'admin-books-edit-id', params: { id: item.raw.id } }">
                      <template #prepend>
                        <VIcon icon="tabler-pencil" />
                      </template>
                      <VListItemTitle>Edit</VListItemTitle>
                    </VListItem>

                    <VListItem :to="{ name: 'admin-books-view-id', params: { id: item.raw.id } }">
                      <template #prepend>
                        <VIcon icon="tabler-eye" />
                      </template>
                      <VListItemTitle>View</VListItemTitle>
                    </VListItem>

                    <VListItem @click="deleteUser(item.raw.id)">
                      <template #prepend>
                        <VIcon icon="tabler-trash" />
                      </template>
                      <VListItemTitle>Delete</VListItemTitle>
                    </VListItem>
                  </VList>
                </VMenu>
              </VBtn>
            </template>

            <!-- pagination -->
            <template #bottom>
              <VDivider />
              <div class="d-flex align-center justify-sm-space-between justify-center flex-wrap gap-3 pa-5 pt-3">
                <p class="text-sm text-disabled mb-0">
                  {{ paginationMeta(options, totalUsers) }}
                </p>

                <VPagination
                  v-model="options.page"
                  :length="Math.ceil(totalUsers / options.itemsPerPage)"
                  :total-visible="$vuetify.display.xs ? 1 : Math.ceil(totalUsers / options.itemsPerPage)"
                >
                  <template #prev="slotProps">
                    <VBtn
                      variant="tonal"
                      color="default"
                      v-bind="slotProps"
                      :icon="false"
                    >
                      Previous
                    </VBtn>
                  </template>

                  <template #next="slotProps">
                    <VBtn
                      variant="tonal"
                      color="default"
                      v-bind="slotProps"
                      :icon="false"
                    >
                      Next
                    </VBtn>
                  </template>
                </VPagination>
              </div>
            </template>
          </VDataTableServer>
          <!-- SECTION -->
        </VCard>

      </vcol>
    </vrow>
  </section>
</template>

<style lang="scss">
.app-user-search-filter {
  inline-size: 31.6rem;
}

.text-capitalize {
  text-transform: capitalize;
}

.user-list-name:not(:hover) {
  color: rgba(var(--v-theme-on-background), var(--v-medium-emphasis-opacity));
}
</style>
