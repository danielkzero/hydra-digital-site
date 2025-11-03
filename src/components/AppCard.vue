<template>
  <div class="bg-gray-800/50 rounded-lg transform hover:scale-105 transition-transform duration-300">

    <div class="h-48 rounded-t-lg bg-gray-700 mb-4" :style="coverImage ?
      `background-image: url(${coverImage}); background-size: 100% auto; background-position: center center;` : ''">
    </div>
    <div class="pb-6 px-6">
      <h3 class="text-xl font-semibold text-white mb-2 text-center">{{ title }}</h3>
      <p class="text-gray-300 text-center mb-4">{{ description }}</p>
      <div class="flex justify-center space-x-4">
        <RouterLink :to="pathLink" class="text-white transition-colors bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded-lg">
          Saiba mais <i class='bx bx-chevron-right'></i> 
        </RouterLink>
      </div>
    </div>

  </div>
</template>

<script>
import { RouterLink } from 'vue-router';

export default {
  name: 'AppCard',
  props: {
    title: {
      type: String,
      required: true
    },
    description: {
      type: String,
      required: true
    },
    coverImage: {
      type: String,
      default: ''
    },
    pathLink: {
      type: String,
      default: ''
    }
  }
}
</script>
