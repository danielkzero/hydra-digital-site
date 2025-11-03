<template>
  <div class="p-6 bg-gray-800 rounded-xl">
    <div class="text-blue-500 text-4xl mb-4">
      <i :class="[icon, 'w-12', 'h-12', 'text-5xl']"></i>
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
    icon: {
      type: Array,
      required: true
    }
  }
}
</script>
