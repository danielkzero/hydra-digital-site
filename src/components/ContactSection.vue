<template>
  <div class="max-w-2xl mx-auto bg-gray-800 rounded-xl p-8">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
      <div>
        <h3 class="text-xl font-bold text-white mb-4">{{ contactTitle }}</h3>
        <div class="space-y-4 text-gray-300">
          <p v-for="info in contactInfo" 
             :key="info.id" 
             class="flex items-center gap-2">
            <i :class="info.icon"></i>
            {{ info.text }}
          </p>
        </div>
      </div>
      <div class="space-y-4">
        <h3 class="text-xl font-bold text-white mb-4">{{ socialTitle }}</h3>
        <div class="flex gap-4">
          <a v-for="social in socialLinks" 
             :key="social.id"
             :href="social.href" 
             target="_blank"
             class="text-gray-400 hover:text-blue-500 transition-colors">
             <i :class="social.icon"></i>
          </a>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'ContactSection',
  props: {
    contactTitle: {
      type: String,
      default: 'Informações de Contato'
    },
    socialTitle: {
      type: String,
      default: 'Redes Sociais'
    },
    contactInfo: {
      type: Array,
      default: () => [
        {
          id: 1,
          text: 'contato@hydradigital.com.br',
          icon: 'bx bxs-envelope'
        },
        {
          id: 2,
          text: 'Barra Mansa, RJ',
          icon: 'bx bxs-map'
        }
      ]
    },
    socialLinks: {
      type: Array,
      default: () => [
        {
          id: 1,
          href: 'https://play.google.com/store/apps/dev?id=4658704075736141999',
          icon: 'bx bxl-play-store text-2xl'
        },
        {
          id: 2,
          href: 'https://www.facebook.com/hydradigitalbr',
          icon: 'bx bxl-facebook-circle text-2xl'
        }
      ]
    }
  }
}
</script>
