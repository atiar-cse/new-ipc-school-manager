import admin from './admin'

export default [
  {
    title: 'Home',
    to: { name: 'index' },
    icon: { icon: 'tabler-smart-home' },
  },
  {
    title: 'Second page',
    to: { name: 'second-page' },
    icon: { icon: 'tabler-file' },
  },
  {
    title: 'Schools',
    to: { name: 'schools' },
    icon: { icon: 'tabler-smart-home' },
  },
  ...admin
]
