<template>
  <main class="mx-auto max-w-6xl px-4 pb-20 pt-28 sm:px-6 lg:px-8">
    <SectionBlock
      eyebrow="Conteúdo"
      title="Blog da Hydra Digital"
      description="Artigos, novidades de produto, estudos de caso e atualizações sobre os projetos publicados."
      centered
    >
      <div v-if="loading" class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
        <div v-for="item in 6" :key="item" class="surface-card h-80 animate-pulse"></div>
      </div>

      <div v-else-if="posts.length" class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
        <BlogCard v-for="post in posts" :key="post.id" :post="post" />
      </div>

      <div v-else class="surface-card px-6 py-16 text-center">
        <h1 class="text-2xl font-semibold text-white">Nenhum artigo encontrado</h1>
        <p class="mt-3 text-slate-400">
          Cadastre novos conteúdos em
          <RouterLink to="/blog/admin" class="text-cyan-300">/blog/admin</RouterLink>.
        </p>
      </div>
    </SectionBlock>
  </main>
</template>

<script setup>
import { onMounted, ref } from 'vue'
import { RouterLink } from 'vue-router'

import BlogCard from '@/components/BlogCard.vue'
import SectionBlock from '@/components/SectionBlock.vue'
import { listPosts } from '@/services/blogApi'

const posts = ref([])
const loading = ref(true)

onMounted(async () => {
  try {
    posts.value = await listPosts({ published: true })
  } finally {
    loading.value = false
  }
})
</script>
