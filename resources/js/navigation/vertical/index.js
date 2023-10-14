import admin from './admin'

export default [
  {
    title: 'Dashboard',
    to: { name: 'index' },
    icon: { icon: 'tabler-dashboard' },
  },
  {
    title: 'Second page',
    to: { name: 'second-page' },
    icon: { icon: 'tabler-file' },
  },
  {
    title: 'Schools',
    to: { name: 'schools' },
    icon: { icon: 'tabler-school' },
  },
  ...admin
]
