<template>
  <div class="max-w-2xl mx-auto bg-gray-800 rounded-xl p-8">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
      <div>
        <h3 class="text-xl font-bold text-white mb-4">{{ contactTitle }}</h3>
        <div class="space-y-4 text-gray-300">
          <p v-for="info in contactInfo" 
             :key="info.id" 
             class="flex items-center gap-2">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
              <path v-for="path in info.iconPaths" :key="path" :d="path"/>
            </svg>
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
             class="text-gray-400 hover:text-blue-500 transition-colors">
            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
              <path :d="social.iconPath"/>
            </svg>
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
          text: 'contato@hydradigital.com',
          iconPaths: [
            'M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z',
            'M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z'
          ]
        },
        {
          id: 2,
          text: 'São Paulo, SP',
          iconPaths: [
            'M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z'
          ]
        }
      ]
    },
    socialLinks: {
      type: Array,
      default: () => [
        {
          id: 1,
          href: '#',
          iconPath: 'M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z'
        },
        {
          id: 2,
          href: '#',
          iconPath: 'M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z'
        },
        {
          id: 3,
          href: '#',
          iconPath: 'M12 0C5.373 0 0 5.373 0 12s5.373 12 12 12 12-5.373 12-12S18.627 0 12 0zm5.891 18.745c-.24 0-4.125-.12-8.287-.12-4.125 0-8.287.12-8.287.12-.24 0-.433-.193-.433-.433V5.688c0-.24.193-.433.433-.433h16.574c.24 0 .433.193.433.433v12.624c0 .24-.193.433-.433.433z'
        }
      ]
    }
  }
}
</script>
