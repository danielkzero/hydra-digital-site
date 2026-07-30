<template>
  <SurfaceCard :image="coverImage" :image-alt="title" card-class="h-full overflow-hidden">
    <div class="flex h-full flex-col">
      <h3 class="text-xl font-semibold text-white">{{ title }}</h3>
      <p class="mt-3 flex-1 text-slate-300">{{ description }}</p>
      <div class="mt-6">
        <RouterLink
          :to="pathLink"
          class="inline-flex items-center gap-2 rounded-full bg-cyan-400 px-5 py-3 text-sm font-medium text-slate-950 transition hover:bg-cyan-300"
        >
          Saiba mais
          <i class="bx bx-chevron-right text-lg"></i>
        </RouterLink>
      </div>
    </div>
  </SurfaceCard>
</template>

<script setup>
import { RouterLink } from 'vue-router'

import SurfaceCard from '@/components/SurfaceCard.vue'

defineProps({
  title: {
    type: String,
    required: true,
  },
  description: {
    type: String,
    required: true,
  },
  coverImage: {
    type: String,
    default: '',
  },
  pathLink: {
    type: String,
    default: '',
  },
})
</script>
