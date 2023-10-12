<script setup>
import { VDataTable } from 'vuetify/labs/VDataTable'
import data from '@/views/data-table/datatable'

const headers = [
  {
    title: 'ID',
    sortable: false,
    key: 'id',
  },
  {
    title: 'NAME',
    key: 'full_name',
  },
  {
    title: 'EMAIL',
    key: 'email',
  },
  {
    title: 'DATE',
    key: 'start_date',
  },
  {
    title: 'EXPERIENCE',
    key: 'experience',
  },
  {
    title: 'AGE',
    key: 'age',
  },
]
</script>

<template>
  <div class="mt-3 mb-3">
  <VRow>
      <VCol cols="12">
        <VRow no-gutters>
          <!-- 👉 First Name -->
          <VCol
            cols="12"
            md="8"
            class="d-flex align-items-center"
          >
            <h3>Schools</h3>
          </VCol>

          <VCol
            cols="12"
            md="4"
            class="d-flex align-items-end"
          >
          
          <div class="demo-space-x">
            <VBtn>
              Category
            </VBtn>
            <router-link to="/add-school">
                <VBtn class="m-3">
                    Add School
                </VBtn>
            </router-link>
       
          
          </div>
          </VCol>
        </VRow>
      </VCol>
    </VRow>   
    </div> 
  <VDataTable
    :headers="headers"
    :items="data"
    :items-per-page="5"
  />
</template>
