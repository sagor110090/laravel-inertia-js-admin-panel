<template>
  <div>
    <div :class="isUrl('') ? 'mb-4 sidebar-link sidebar-border' : 'mb-4 sidebar-link'">
      <inertia-link class="flex items-center group py-3 p-8" :href="route('dashboard')">
        <icon name="dashboard" class="w-4 h-4 mr-2" :class="isUrl('') ? 'fill-white' : 'fill-indigo-400 group-hover:fill-white'" />
        <div :class="isUrl('') ? 'text-white' : 'text-indigo-300 group-hover:text-white'">Dashboard</div>
      </inertia-link>
    </div>
    
    <div :class="isUrl('client') ? 'mb-4 sidebar-link sidebar-border' : 'mb-4 sidebar-link'">
      <inertia-link class="flex items-center group py-3 p-8" :href="route('client')">
        <icon name="users" class="w-4 h-4 mr-2" :class="isUrl('client') ? 'fill-white' : 'fill-indigo-400 group-hover:fill-white'" />
        <div :class="isUrl('client') ? 'text-white' : 'text-indigo-300 group-hover:text-white'">Client</div>
      </inertia-link>
    </div>
  </div>
</template>

<script>
import Icon from '@/Shared/Icon'

export default {
  components: {
    Icon,
  },
  methods: {
    isUrl(...urls) {
      let currentUrl = this.$page.url.substr(1)
      if (urls[0] === '') {
        return currentUrl === ''
      }
      return urls.filter(url => currentUrl.startsWith(url)).length
    },
  },
}
</script>

<style scoped>
.sidebar-link{
    background: blue;
}
.sidebar-border{
    border-left: 5px solid white;
}
</style>
