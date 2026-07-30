<template>
  <SurfaceCard card-class="h-full overflow-hidden">
    <template #media>
      <div class="surface-card__media flex items-end bg-gradient-to-br from-cyan-500/20 via-slate-900 to-slate-950">
        <img
          v-if="post.coverImage"
          :src="post.coverImage"
          :alt="post.title"
          class="surface-card__image"
          loading="lazy"
          decoding="async"
        />
        <div v-else class="flex h-full w-full items-end p-6">
          <span class="rounded-full border border-cyan-300/30 bg-cyan-400/10 px-3 py-1 text-xs uppercase tracking-[0.25em] text-cyan-200">
            Blog Hydra
          </span>
        </div>
      </div>
    </template>

    <div class="flex h-full flex-col">
      <p class="text-sm text-slate-400">{{ formatDate(post.createdAt) }}</p>
      <h3 class="mt-3 text-xl font-semibold text-white">{{ post.title }}</h3>
      <p class="mt-3 flex-1 text-slate-300">{{ post.excerpt }}</p>
      <RouterLink
        :to="`/blog/${post.slug}`"
        class="mt-6 inline-flex items-center gap-2 text-sm font-medium text-cyan-300 transition hover:text-cyan-200"
      >
        Ler artigo
        <i class="bx bx-right-arrow-alt text-lg"></i>
      </RouterLink>
    </div>
  </SurfaceCard>
</template>

<script setup>
import { RouterLink } from 'vue-router'

import SurfaceCard from '@/components/SurfaceCard.vue'

defineProps({
  post: {
    type: Object,
    required: true,
  },
})

function formatDate(value) {
  if (!value) {
    return ''
  }

  return new Intl.DateTimeFormat('pt-BR', {
    day: '2-digit',
    month: 'long',
    year: 'numeric',
  }).format(new Date(value))
}
</script>
