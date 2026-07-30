<template>
  <SectionBlock
    id="blog"
    :eyebrow="content.eyebrow"
    :title="content.title"
    :description="content.description"
    muted
  >
    <div v-if="loading" class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
      <div v-for="item in 3" :key="item" class="surface-card h-80 animate-pulse"></div>
    </div>

    <div v-else-if="posts.length" class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
      <BlogCard v-for="post in posts" :key="post.id" :post="post" />
    </div>

    <div v-else class="surface-card px-6 py-12 text-center">
      <p class="text-lg text-white">Nenhum post publicado ainda.</p>
      <p class="mt-2 text-slate-400">Publique conteúdos pela área de administração do blog.</p>
    </div>

    <div class="mt-8 flex justify-center">
      <RouterLink
        to="/blog"
        class="inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/5 px-5 py-3 text-sm font-medium text-white transition hover:border-cyan-300/40 hover:text-cyan-200"
      >
        Ver todos os artigos
        <i class="bx bx-chevron-right text-lg"></i>
      </RouterLink>
    </div>
  </SectionBlock>
</template>

<script setup>
import { onMounted, ref } from 'vue'
import { RouterLink } from 'vue-router'

import BlogCard from '@/components/BlogCard.vue'
import SectionBlock from '@/components/SectionBlock.vue'
import { listPosts } from '@/services/blogApi'

defineProps({
  content: {
    type: Object,
    required: true,
  },
})

const posts = ref([])
const loading = ref(true)

onMounted(async () => {
  try {
    posts.value = await listPosts({ published: true, limit: 3 })
  } catch (error) {
    posts.value = []
  } finally {
    loading.value = false
  }
})
</script>
