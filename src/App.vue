<template>
  <div
    class="app-shell"
    :class="{
      'app-shell--background-ready': isBackgroundReady,
      'app-shell--ready': isAppReady,
    }"
    :aria-busy="!isAppReady"
  >
    <Transition name="app-loader-fade">
      <div v-if="!isAppReady" class="app-loader" role="status" aria-live="polite" aria-label="Carregando site">
        <div class="app-loader__panel">
          <div class="app-loader__brand-ring">
            <span class="app-loader__brand-dot"></span>
          </div>
          <p class="app-loader__title">{{ siteMeta.brandName }}</p>
          <p class="app-loader__message">{{ loadingMessage }}</p>
          <div class="app-loader__progress">
            <span class="app-loader__progress-bar" :style="{ transform: `scaleX(${loadingProgress})` }"></span>
          </div>
        </div>
      </div>
    </Transition>

    <div class="app-shell__background">
      <img :src="backgroundImage" alt="Hydra Digital background" class="app-shell__background-image" />
      <div class="app-shell__background-overlay"></div>
      <div class="app-shell__background-vignette"></div>
      <div class="app-shell__background-shimmer"></div>
      <div class="app-shell__glow app-shell__glow--primary"></div>
      <div class="app-shell__glow app-shell__glow--secondary"></div>
    </div>

    <header class="relative z-30">
      <NavBar :title="siteMeta.brandName" :menu-items="navigationItems" />
    </header>

    <div class="app-shell__content relative z-20">
      <router-view />

      <SectionBlock
        id="contact"
        :title="siteMeta.contactTitle"
        eyebrow="Conexao"
        description="Se voce precisa evoluir um produto existente ou construir uma nova solucao digital, este e o ponto de partida."
      >
        <ContactSection
          contact-title="Informacoes de contato"
          social-title="Onde a Hydra esta"
          :contact-info="contactContent.details"
          :social-links="contactContent.socialLinks"
        />
      </SectionBlock>

      <footer class="relative mx-auto max-w-6xl px-4 py-8 text-center text-sm text-slate-400 sm:px-6 lg:px-8">
        <p>&copy; {{ currentYear }} {{ siteMeta.footerText }}</p>
      </footer>
    </div>
  </div>
</template>

<script setup>
import { computed, onBeforeUnmount, onMounted, ref } from 'vue'

import backgroundImage from '@/assets/images/hydra.png'
import logoCentral from '@/assets/images/logoCentral.png'
import ContactSection from '@/components/ContactSection.vue'
import NavBar from '@/components/NavBar.vue'
import SectionBlock from '@/components/SectionBlock.vue'
import { contactContent, navigationItems, siteMeta } from '@/data/site'

const currentYear = computed(() => new Date().getFullYear())
const isBackgroundReady = ref(false)
const isAppReady = ref(false)
const loadingProgress = ref(0.12)
const loadingMessage = ref('Preparando a experiência visual.')

let progressIntervalId = null

function wait(ms) {
  return new Promise((resolve) => {
    window.setTimeout(resolve, ms)
  })
}

function preloadImage(source) {
  return new Promise((resolve, reject) => {
    const image = new Image()
    image.onload = () => resolve(source)
    image.onerror = reject
    image.src = source
  })
}

function startLoadingProgress() {
  const checkpoints = [0.22, 0.36, 0.54, 0.72, 0.86]
  const messages = [
    'Preparando a experiência visual.',
    'Carregando plano de fundo principal.',
    'Organizando conteúdos e destaques.',
    'Finalizando animações e elementos visuais.',
  ]

  let messageIndex = 0

  progressIntervalId = window.setInterval(() => {
    const nextCheckpoint = checkpoints.find((value) => value > loadingProgress.value)
    if (nextCheckpoint) {
      loadingProgress.value = nextCheckpoint
    }

    if (messageIndex < messages.length - 1) {
      messageIndex += 1
      loadingMessage.value = messages[messageIndex]
    }
  }, 260)
}

function stopLoadingProgress() {
  if (progressIntervalId) {
    window.clearInterval(progressIntervalId)
    progressIntervalId = null
  }
}

onMounted(async () => {
  startLoadingProgress()

  try {
    await Promise.all([
      preloadImage(backgroundImage),
      preloadImage(logoCentral),
      wait(700),
    ])
  } catch (error) {
    console.error('Falha ao pré-carregar assets iniciais.', error)
  } finally {
    stopLoadingProgress()
    loadingProgress.value = 1
    loadingMessage.value = 'Tudo pronto.'
    isBackgroundReady.value = true
    window.setTimeout(() => {
      isAppReady.value = true
    }, 220)
  }
})

onBeforeUnmount(() => {
  stopLoadingProgress()
})
</script>
