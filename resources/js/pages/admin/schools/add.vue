<script setup>
import axios from '@axios'
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
</script>

<template>
  <VRow>
  <VCol
    cols="12"
    md="9"
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
          <VForm class="mt-2">
            <VRow>
              <VCol
                md="6"
                cols="12"
              >
                <AppTextField
                  v-model="schoolName"
                  label="School name"
                />
                
              </VCol>

              <VCol
                md="6"
                cols="12"
              >
                <AppTextField
                  v-model="mainUser"
                  label="Main User"
                />
              </VCol>
              <VCol 
                cols="12" 
                md="6"
               >
               <AppTextField
                  v-model="email"
                  label="Main User Email"
                  suffix="@example.com"
                />

              </VCol>
              <VCol 
                cols="12" 
                md="6"
               >
               <AppTextField
                  v-model="password"
                  label="Main User Password"
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
                  v-model="country"
                  :items="countryList"
                  label="Currency Symbol"
                />

              </VCol>

              <VCol
                cols="12"
                md="6"
              >
                <AppSelect
                  v-model="country"
                  :items="countryList"
                  label="Group Category"
                />
              </VCol>

              <VCol
                cols="12"
                md="6"
              >
              <AppSelect
                  v-model="country"
                  :items="countryList"
                  label="Manager"
                />
              </VCol>
              
            </VRow>
          </VForm>
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
