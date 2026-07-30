<template>
  <SurfaceCard card-class="h-full p-6">
    <div class="mb-5 inline-flex h-14 w-14 items-center justify-center rounded-2xl bg-cyan-400/10 text-cyan-300">
      <i :class="icon" class="text-3xl"></i>
    </div>
    <h3 class="text-xl font-semibold text-white">{{ title }}</h3>
    <p class="mt-3 leading-7 text-slate-300">{{ description }}</p>
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
  icon: {
    type: String,
    required: true,
  },
})
</script>
