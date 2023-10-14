<script setup>
const shortcuts = [
  {
    icon: 'tabler-book',
    title: 'Books',
    subtitle: 'Book List',
    to: { name: 'admin-books' },
  },
  {
    icon: 'tabler-school',
    title: 'Schools',
    subtitle: 'School List',
    to: { name: 'admin-schools' },
  },
]
</script>

<template>
  <Shortcuts :shortcuts="shortcuts" />
</template>
