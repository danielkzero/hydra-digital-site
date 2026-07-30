<template>
  <section class="mx-auto flex min-h-[calc(100vh-7rem)] w-full max-w-6xl items-center px-4 py-20 sm:px-6 lg:px-8">
    <div class="mx-auto max-w-4xl text-center">
      <p class="section-eyebrow">Hydra Digital</p>
      <h1 class="max-w-4xl text-4xl font-semibold tracking-tight text-white sm:text-5xl lg:text-6xl">
        {{ title }}
      </h1>
      <p class="mx-auto mt-6 max-w-3xl text-lg leading-8 text-slate-300 sm:text-xl">
        {{ description }}
      </p>
      <div class="mt-10 flex flex-col items-center justify-center gap-4 sm:flex-row">
        <a
          v-for="button in buttons"
          :key="button.id"
          :href="button.href"
          class="inline-flex min-w-52 items-center justify-center rounded-full px-6 py-3 text-sm font-medium transition duration-300"
          :class="button.variant === 'primary' ? 'bg-cyan-400 text-slate-950 hover:bg-cyan-300' : 'border border-white/15 bg-white/5 text-white hover:border-cyan-300 hover:text-cyan-200'"
          @click.prevent="navigateToSection(button.href)"
        >
          {{ button.label }}
        </a>
      </div>
    </div>
  </section>
</template>

<script setup>
import { useSectionNavigation } from '@/composables/useSectionNavigation'

defineProps({
  title: {
    type: String,
    default: 'Produtos digitais para operacao e crescimento',
  },
  description: {
    type: String,
    default: 'Aplicativos, jogos e sistemas com foco em qualidade de entrega e manutencao.',
  },
  buttons: {
    type: Array,
    default: () => [],
  },
})

const { navigateToSection } = useSectionNavigation()
</script>
