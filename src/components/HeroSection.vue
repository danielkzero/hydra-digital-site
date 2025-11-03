<template>
  <section class="container mx-auto px-4 py-20 text-center">
    <h1 class="text-5xl font-bold text-white mb-6">
      {{ title }}
    </h1>
    <p class="text-xl text-gray-300 mb-12 max-w-3xl mx-auto">
      {{ description }}
    </p>
    <div class="flex justify-center gap-4">
      <a v-for="button in buttons" @click.prevent="scrollToSection(button.href)" :key="button.id" :href="button.href"
        :class="[
          'px-8 py-3 rounded-lg transition-colors',
          button.primary ?
            'bg-blue-600 hover:bg-blue-700 text-white' :
            'border border-blue-600 text-blue-500 hover:bg-blue-600 hover:text-white'
        ]">
        {{ button.label }}
      </a>
    </div>
  </section>
</template>

<script>
import { scrollToSection } from '@/utils/scroll';

export default {
  name: 'HeroSection',
  props: {
    title: {
      type: String,
      default: 'Bem-vindo à HydraDigital'
    },
    description: {
      type: String,
      default: 'Transformando ideias em experiências digitais incríveis.'
    },
    buttons: {
      type: Array,
      default: () => [
        { id: 1, label: 'Nossos Apps', href: '#apps', primary: true },
        { id: 2, label: 'Contato', href: '#contact', primary: false }
      ]
    }
  },
  methods: {
    scrollToSection(href) {
      const element = document.querySelector(href);
      if (element) {
        const navbarHeight = 80; // Altura aproximada da navbar
        const elementPosition = element.getBoundingClientRect().top + window.pageYOffset;
        const offsetPosition = elementPosition - navbarHeight;

        window.scrollTo({
          top: offsetPosition,
          behavior: 'smooth'
        });
      }
    }
  }
}
</script>
