<template>
  <article class="surface-card group" :class="cardClass">
    <div v-if="$slots.media || image" class="surface-card__media" :class="mediaClass">
      <slot name="media">
        <img :src="image" :alt="imageAlt" class="surface-card__image" loading="lazy" decoding="async" />
      </slot>
    </div>

    <div class="surface-card__body">
      <slot />
    </div>
  </article>
</template>

<script setup>
defineProps({
  image: {
    type: String,
    default: '',
  },
  imageAlt: {
    type: String,
    default: '',
  },
  cardClass: {
    type: String,
    default: '',
  },
  mediaClass: {
    type: String,
    default: '',
  },
})
</script>
