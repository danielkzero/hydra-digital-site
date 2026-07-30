<template>
  <main class="mx-auto flex min-h-screen w-full max-w-6xl flex-col gap-8 px-4 pb-20 pt-28 sm:px-6 lg:flex-row lg:px-8">
    <button
      class="inline-flex items-center gap-2 self-end rounded-full border border-white/10 bg-slate-900/80 px-4 py-2 text-sm text-white shadow-lg shadow-slate-950/20 backdrop-blur md:hidden"
      @click="menuOpen = !menuOpen"
    >
      <i class="bx bx-menu text-xl"></i>
      Artigos
    </button>

    <aside
      :class="[
        'w-full shrink-0 lg:sticky lg:top-28 lg:block lg:w-80',
        menuOpen ? 'block' : 'hidden',
      ]"
    >
      <div class="surface-card overflow-hidden p-0">
        <div class="border-b border-white/10 px-6 py-5">
          <p class="section-eyebrow">Portfolio</p>
          <h2 class="mt-2 text-xl font-semibold text-white">Aplicativos</h2>
        </div>

        <nav class="max-h-[70vh] space-y-2 overflow-y-auto p-4">
          <button
            v-for="post in apps"
            :key="post.id"
            class="w-full rounded-2xl border px-4 py-4 text-left transition"
            :class="selectedPage?.id === post.id ? 'border-cyan-300/30 bg-cyan-400/10 text-white' : 'border-transparent bg-white/5 text-slate-300 hover:border-white/10 hover:bg-white/10 hover:text-white'"
            @click="openPage(post.id)"
          >
            <span class="block text-base font-medium">{{ post.title }}</span>
            <span class="mt-2 block text-sm text-slate-400">{{ post.resumo }}</span>
          </button>
        </nav>
      </div>
    </aside>

    <section class="min-w-0 flex-1">
      <article v-if="selectedPage" class="surface-card overflow-hidden p-0">
        <img
          :src="selectedPage.coverImage"
          :alt="selectedPage.title"
          class="h-64 w-full object-cover object-center sm:h-80"
          loading="eager"
          decoding="async"
        />

        <div class="p-6 sm:p-8">
          <p class="section-eyebrow">Aplicativo</p>
          <header class="mt-3">
            <h1 class="text-3xl font-semibold tracking-tight text-white sm:text-4xl">
              {{ selectedPage.title }}
            </h1>
            <p class="mt-3 text-sm text-slate-400">
              Publicado em {{ selectedPage.data }} por
              <span class="text-cyan-300">{{ selectedPage.autor }}</span>
            </p>
            <p class="mt-6 text-lg leading-8 text-slate-300">{{ selectedPage.description }}</p>
            <ul
              v-if="selectedPage.features?.length"
              class="mt-6 flex list-none flex-wrap gap-2 p-0"
              aria-label="Principais recursos"
            >
              <li
                v-for="feature in selectedPage.features"
                :key="feature"
                class="rounded-full border border-cyan-300/20 bg-cyan-400/10 px-4 py-2 text-sm font-medium text-cyan-200"
              >
                {{ feature }}
              </li>
            </ul>
          </header>

          <article class="prose-content mt-10">
            <template v-for="(content, index) in selectedPage.conteudo" :key="index">
              <div v-if="looksLikeHtml(content)" v-html="content"></div>
              <p v-else>{{ content }}</p>
            </template>
          </article>

          <section v-if="selectedPage.gallery?.length" class="mt-12" aria-labelledby="gallery-title">
            <p class="section-eyebrow">Recursos em destaque</p>
            <h2 id="gallery-title" class="mt-3 text-2xl font-semibold text-white sm:text-3xl">
              Uma visão completa da operação
            </h2>

            <div class="mt-7 grid gap-6">
              <figure
                v-for="item in selectedPage.gallery"
                :key="item.title"
                class="overflow-hidden rounded-3xl border border-white/10 bg-slate-950/45"
              >
                <button
                  type="button"
                  class="group block w-full cursor-zoom-in overflow-hidden text-left"
                  :aria-label="`Ampliar imagem: ${item.title}`"
                  @click="expandedImage = item"
                >
                  <img
                    :src="item.image"
                    :alt="item.title"
                    class="w-full object-cover transition duration-500 group-hover:scale-[1.015]"
                    loading="lazy"
                    decoding="async"
                  />
                </button>
                <figcaption class="p-5 sm:p-6">
                  <h3 class="text-lg font-semibold text-white">{{ item.title }}</h3>
                  <p class="mt-2 leading-7 text-slate-300">{{ item.description }}</p>
                </figcaption>
              </figure>
            </div>
          </section>
        </div>
      </article>

      <div v-else class="surface-card px-6 py-16 text-center sm:px-8">
        <h1 class="text-2xl font-semibold text-white">Pagina nao encontrada</h1>
        <p class="mt-3 text-slate-400">Selecione outro aplicativo no menu lateral.</p>
      </div>
    </section>

    <Teleport to="body">
      <div
        v-if="expandedImage"
        class="fixed inset-0 z-[100] flex items-center justify-center bg-slate-950/95 p-4 backdrop-blur-sm sm:p-8"
        role="dialog"
        aria-modal="true"
        :aria-label="expandedImage.title"
        @click.self="expandedImage = null"
      >
        <button
          type="button"
          class="absolute right-5 top-5 grid h-11 w-11 place-items-center rounded-full border border-white/15 bg-white/10 text-2xl text-white transition hover:bg-white/20"
          aria-label="Fechar imagem"
          @click="expandedImage = null"
        >
          <i class="bx bx-x"></i>
        </button>
        <img
          :src="expandedImage.image"
          :alt="expandedImage.title"
          class="max-h-full max-w-full rounded-2xl object-contain shadow-2xl shadow-black/50"
        />
      </div>
    </Teleport>
  </main>
</template>

<script setup>
import { computed, onUnmounted, ref, watch } from 'vue'
import { useRoute, useRouter } from 'vue-router'

import apps from '@/data/apps'

const route = useRoute()
const router = useRouter()
const menuOpen = ref(false)
const expandedImage = ref(null)

const selectedPage = computed(() =>
  apps.find(
    (item) =>
      item.id === route.params.page ||
      item.aliases?.includes(route.params.page)
  )
)

function looksLikeHtml(content) {
  return /<\/?[a-z][\s\S]*>/i.test(content)
}

async function openPage(id) {
  menuOpen.value = false
  if (id === route.params.page) {
    return
  }

  await router.push(`/apps/${id}`)
}

watch(
  () => route.params.page,
  () => {
    menuOpen.value = false
    window.scrollTo({ top: 0, behavior: 'smooth' })
  }
)

function closeExpandedImage(event) {
  if (event.key === 'Escape') {
    expandedImage.value = null
  }
}

window.addEventListener('keydown', closeExpandedImage)
onUnmounted(() => window.removeEventListener('keydown', closeExpandedImage))
</script>
