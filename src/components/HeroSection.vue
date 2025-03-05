<template>
  <section class="container mx-auto px-4 py-20 text-center">
    <h1 class="text-5xl font-bold text-white mb-6">
      {{ title }}
    </h1>
    <p class="text-xl text-gray-300 mb-12 max-w-3xl mx-auto">
      {{ description }}
    </p>
    <div class="flex justify-center gap-4">
      <a v-for="button in buttons"
         :key="button.id"
         :href="button.href"
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
export default {
  name: 'HeroSection',
  props: {
    title: {
      type: String,
      default: 'Criando Experiências Digitais Inesquecíveis'
    },
    description: {
      type: String,
      default: 'Apps inovadores, jogos indie e advergames criativos para todas as idades, unindo tecnologia e entretenimento.'
    },
    buttons: {
      type: Array,
      default: () => [
        { id: 1, href: '#portfolio', label: 'Ver Portfólio', primary: true },
        { id: 2, href: '#contact', label: 'Fale Conosco', primary: false }
      ]
    }
  }
}
</script>
