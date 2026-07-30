<template>
  <section :id="id" :class="sectionClasses">
    <div class="mx-auto w-full max-w-6xl px-4 sm:px-6 lg:px-8">
      <div class="mb-10 md:mb-14" :class="centered ? 'text-center' : ''">
        <p v-if="eyebrow" class="section-eyebrow">
          {{ eyebrow }}
        </p>
        <h2 class="section-title">
          {{ title }}
        </h2>
        <p v-if="description" class="section-description" :class="centered ? 'mx-auto' : ''">
          {{ description }}
        </p>
      </div>

      <slot />
    </div>
  </section>
</template>

<script setup>
import { computed } from 'vue'

const props = defineProps({
  id: {
    type: String,
    default: '',
  },
  eyebrow: {
    type: String,
    default: '',
  },
  title: {
    type: String,
    required: true,
  },
  description: {
    type: String,
    default: '',
  },
  centered: {
    type: Boolean,
    default: true,
  },
  muted: {
    type: Boolean,
    default: false,
  },
})

const sectionClasses = computed(() => [
  'py-20 sm:py-24',
  props.muted ? 'bg-slate-900/40 backdrop-blur-sm' : '',
])
</script>
