<script setup>
import axios from '@axios'
import SchoolEditable from '@/views/admin/schools/SchoolEditable.vue'
const tab = ref('general')
const schoolName = ref('')
const mainUser = ref('')
const country = ref()
const birthDate = ref('')
const phoneNo = ref()

const countryList = [
  'USA',
  'Canada',
  'UK',
  'Denmark',
  'Germany',
  'Iceland',
  'Israel',
  'Mexico',
]

const languageList = [
  'English',
  'German',
  'French',
  'Spanish',
  'Portuguese',
  'Russian',
  'Korean',
]

const username = ref('')
const email = ref('')
const password = ref('')
const cPassword = ref('')
const twitterLink = ref('')
const facebookLink = ref('')
const googlePlusLink = ref('')
const linkedInLink = ref('')
const instagramLink = ref('')
const quoraLink = ref('')
const languages = ref([])
const isPasswordVisible = ref(false)
const isCPasswordVisible = ref(false)
const schoolData = ref({
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
