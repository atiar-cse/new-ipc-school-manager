<script setup>
import {
  requiredValidator,
} from '@validators'
//import axios from '@axios'
import { useSchoolsStore } from './useSchoolsStore'
const tab = ref('general')
//const schoolName = ref('')
//const mainUser = ref('')
//const country = ref()
//const birthDate = ref('')
//const phoneNo = ref()

const currencyList = [
  'AR$',
  'Euro',
  'USD',
  'GBP',
  'CAD',
  'Rs.',
  'AUD',
  'AED',
]

const categoryList = [
  'Test1',
  'Test2',
  'Test3',
  'Test4',
  'Test5',
  'Test6',
  'Test7',
]
const adminList = [
  'Admin1',
  'Admin2',
  'Admin3',
]

//const username = ref('')
//const email = ref('')
//const password = ref('')
//const cPassword = ref('')
//const twitterLink = ref('')
//const facebookLink = ref('')
//const googlePlusLink = ref('')
//const linkedInLink = ref('')
//const instagramLink = ref('')
//const quoraLink = ref('')
//const languages = ref([])
//const isPasswordVisible = ref(false)
//const isCPasswordVisible = ref(false)

const props = defineProps({
  data: {
    type: null,
    required: true,
  },
})
const router = useRouter()

const refForm = ref()

const schoolListStore = useSchoolsStore()

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
        schoolListStore.updateSchool(props.data) // Update
      } else {
        schoolListStore.addSchool(props.data) // Add new
      }
      
      router.replace('/admin/schools')    

    }
  })
}
</script>

<template>
  <VRow>
  <VCol
    cols="12"
    md="12"
  >
  <VTabs v-model="tab">
    <VTab value="general">
      General
    </VTab>
    <VTab value="address">
      Address 
    </VTab>
    <VTab value="mail-address">
      Mail Address
    </VTab>
  </VTabs>

  <VCard flat>
    <VCardText>
      <VWindow
        v-model="tab"
        class="disable-tab-transition"
      >
        <VWindowItem value="general">
          <VForm class="mt-2"
            ref="refForm"
            v-model="isFormValid"
            @submit.prevent="onSubmit"
          >
            <VRow>
              <VCol
                md="6"
                cols="12"
              >
                <AppTextField
                v-model="props.data.name"
                :rules="[requiredValidator]"
                label="School Name"
                placeholder="Enter School Name"
                />
                
              </VCol>

              <VCol
                md="6"
                cols="12"
              >
                <AppTextField
                  v-model="props.data.name"
                  :rules="[requiredValidator]"
                  label="Main User"
                  placeholder="Enter Main User"
                />
              </VCol>
              <VCol 
                cols="12" 
                md="6"
               >
               <AppTextField
                  v-model="props.data.email"
                  :rules="[requiredValidator]"
                  label="Main User Email"
                  suffix="@example.com"
                  placeholder="Enter Main User Email"
                />

              </VCol>
              <VCol 
                cols="12" 
                md="6"
               >
               <AppTextField
                  v-model="props.data.password"
                  label="Main User Password"
                  placeholder="Enter Main User Password"
                  :type="isPasswordVisible ? 'text' : 'password'"
                  :append-inner-icon="isPasswordVisible ? 'tabler-eye' : 'tabler-eye-off'"
                  @click:append-inner="isPasswordVisible = !isPasswordVisible"
                />

              </VCol>
              <VCol
                cols="12"
                md="6"
              >
              <AppTextField
                  v-model="cPassword"
                  label="Confirm Password"
                  placeholder="Confirm Password"
                  :type="isCPasswordVisible ? 'text' : 'password'"
                  :append-inner-icon="isCPasswordVisible ? 'tabler-eye' : 'tabler-eye-off'"
                  @click:append-inner="isCPasswordVisible = !isCPasswordVisible"
                />

              </VCol>
              <VCol
                cols="12"
                md="6"
              >
              <AppSelect
                  v-model="props.data.currency"
                  :items="currencyList"
                  label="Currency Symbol"
                  placeholder="Select Currency"
                  
                />

              </VCol>

              <VCol
                cols="12"
                md="6"
              >
                <AppSelect
                  v-model="props.data.groupCategory"
                  :items="categoryList"
                  label="Group Category"
                  placeholder="Select Group"
                  
                />
              </VCol>

              <VCol
                cols="12"
                md="6"
              >
              <AppSelect
                  v-model="props.data.manager"
                  :items="adminList"
                  label="Manager"
                  placeholder="Manager"
                 
                />
              </VCol>
              
            </VRow>
          </VForm>
          <VCardText class="d-flex gap-4">
            <VBtn>Submit</VBtn>
            <VBtn
              color="secondary"
              variant="tonal"
            >
              Cancel
            </VBtn>
          </VCardText>
        </VWindowItem>

        <VWindowItem value="address">
          <VForm class="mt-2">
            <VRow>
              <VCol
                cols="12"
                md="6"
              >
                <AppTextField
                  v-model="username"
                  label="Address Line 1"
                />
              </VCol>

              <VCol
                cols="12"
                md="6"
              >
              <AppTextField
                  v-model="username"
                  label="Address Line 2"
                />
              </VCol>

              <VCol
                cols="12"
                md="6"
              >
              <AppSelect
                  v-model="country"
                  :items="countryList"
                  label="City"
                />
              </VCol>

              <VCol
                cols="12"
                md="6"
              >
              <AppTextField
                  v-model="zip"
                  label="Zip"
                />
              </VCol>
              <VCol
                cols="12"
                md="6"
              >
              <AppSelect
                  v-model="country"
                  :items="countryList"
                  label="State"
                />
              </VCol>
              <VCol
                cols="12"
                md="6"
              >
              <AppSelect
                  v-model="country"
                  :items="countryList"
                  label="Country"
                />
              </VCol>
            </VRow>
          </VForm>
        </VWindowItem>

        <VWindowItem value="mail-address">
          <VForm class="mt-2">
            <VRow>
                
              <VCol
                cols="12"
                md="6"
              >
                <AppTextField
                  v-model="username"
                  label="Address Line 1"
                />
              </VCol>

              <VCol
                cols="12"
                md="6"
              >
              <AppTextField
                  v-model="username"
                  label="Address Line 2"
                />
              </VCol>

              <VCol
                cols="12"
                md="6"
              >
              <AppSelect
                  v-model="country"
                  :items="countryList"
                  label="City"
                />
              </VCol>

              <VCol
                cols="12"
                md="6"
              >
              <AppTextField
                  v-model="zip"
                  label="Zip"
                />
              </VCol>
              <VCol
                cols="12"
                md="6"
              >
              <AppSelect
                  v-model="country"
                  :items="countryList"
                  label="State"
                />
              </VCol>
              <VCol
                cols="12"
                md="6"
              >
              <AppSelect
                  v-model="country"
                  :items="countryList"
                  label="Country"
                />
              </VCol>
            </VRow>
          </VForm>
        </VWindowItem>
      </VWindow>
    </VCardText>

    <VDivider />

    <VCardText class="d-flex gap-4">
      <VBtn>Submit</VBtn>
      <VBtn
        color="secondary"
        variant="tonal"
      >
        Cancel
      </VBtn>
    </VCardText>
  </VCard>
  </VCol>
  <!-- 👉 Right Column: Book Action -->

</VRow>
 
</template>
