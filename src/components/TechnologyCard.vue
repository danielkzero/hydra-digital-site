<template>
  <div class="p-6 bg-gray-800 rounded-xl">
    <div class="text-blue-500 text-4xl mb-4">
      <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 20 20">
        <path v-for="path in iconPaths" :key="path" :d="path"/>
      </svg>
    </div>
    <h3 class="text-xl font-bold text-white mb-2">{{ title }}</h3>
    <p class="text-gray-300">{{ description }}</p>
  </div>
</template>

<script>
export default {
  name: 'TechnologyCard',
  props: {
    title: {
      type: String,
      required: true
    },
    description: {
      type: String,
      required: true
    },
    iconPaths: {
      type: Array,
      required: true
    }
  }
}
</script>
