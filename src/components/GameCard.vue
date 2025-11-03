<template>
  <div class="bg-gray-800 rounded-xl overflow-hidden shadow-lg transform hover:scale-105 transition-transform">
    <div class="h-48 bg-gray-700" 
    :style="
      coverImage ? 
      `background-image: url(${coverImage}); background-size: 100% auto; background-position: center;` : ''"></div>
    <div class="p-6">
      <h3 class="text-xl font-bold text-white mb-2">{{ title }}</h3>
      <p class="text-gray-300 mb-4">{{ description }}</p>
      <div class="flex gap-2 mb-4">
        <span v-for="tag in tags" 
              :key="tag"
              class="px-3 py-1 bg-blue-900 text-blue-300 rounded-full text-sm">
          {{ tag }}
        </span>
      </div>
      <div class="flex items-center gap-4 text-gray-400">
        <span class="flex items-center gap-1">
          <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
          </svg>
          {{ rating }}/5
        </span>
        <span>{{ downloads }}+ Downloads</span>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'GameCard',
  props: {
    title: {
      type: String,
      required: true
    },
    description: {
      type: String,
      required: true
    },
    tags: {
      type: Array,
      default: () => []
    },
    rating: {
      type: Number,
      default: 0
    },
    downloads: {
      type: String,
      default: '0'
    },
    coverImage: {
      type: String,
      default: ''
    }
  }
}
</script>
