<template>
  <main class="mx-auto max-w-4xl px-4 pb-20 pt-28 sm:px-6 lg:px-8">
    <article v-if="post" class="surface-card overflow-hidden p-0">
      <img
        v-if="post.coverImage"
        :src="post.coverImage"
        :alt="post.title"
        class="h-72 w-full object-cover object-center"
        loading="eager"
        decoding="async"
      />
      <div class="p-6 sm:p-8">
        <p class="section-eyebrow">Blog</p>
        <h1 class="mt-3 text-3xl font-semibold tracking-tight text-white sm:text-5xl">{{ post.title }}</h1>
        <p class="mt-4 text-sm text-slate-400">{{ formatDate(post.createdAt) }}</p>
        <p class="mt-6 text-lg leading-8 text-slate-300">{{ post.excerpt }}</p>

        <div class="prose-content prose-rich mt-10" v-html="post.content"></div>
      </div>
    </article>

    <div v-else-if="!loading" class="surface-card px-6 py-16 text-center">
      <h1 class="text-2xl font-semibold text-white">Post não encontrado</h1>
      <p class="mt-3 text-slate-400">Verifique o slug informado ou publique o artigo pela API.</p>
    </div>
  </main>
</template>

<script setup>
import { onMounted, ref } from 'vue'
import { useRoute } from 'vue-router'

import { getPost } from '@/services/blogApi'

const route = useRoute()
const post = ref(null)
const loading = ref(true)

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

onMounted(async () => {
  try {
    post.value = await getPost(route.params.slug)
  } finally {
    loading.value = false
  }
})
</script>
