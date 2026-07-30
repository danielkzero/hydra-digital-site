<template>
  <SurfaceCard :image="coverImage" :image-alt="title" card-class="h-full overflow-hidden">
    <h3 class="text-xl font-semibold text-white">{{ title }}</h3>
    <p class="mt-3 text-slate-300">{{ description }}</p>
    <div class="mt-5 flex flex-wrap gap-2">
      <span
        v-for="tag in tags"
        :key="tag"
        class="rounded-full border border-cyan-400/20 bg-cyan-400/10 px-3 py-1 text-sm text-cyan-200"
      >
        {{ tag }}
      </span>
    </div>
    <div class="mt-6 flex items-center gap-4 text-sm text-slate-400">
      <span class="flex items-center gap-1">
        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
          <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
        </svg>
        {{ rating }}/5
      </span>
      <span>{{ downloads }}+ downloads</span>
    </div>
  </SurfaceCard>
</template>

<script setup>
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
  tags: {
    type: Array,
    default: () => [],
  },
  rating: {
    type: Number,
    default: 0,
  },
  downloads: {
    type: String,
    default: '0',
  },
  coverImage: {
    type: String,
    default: '',
  },
})
</script>
