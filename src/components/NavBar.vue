<template>
  <nav class="flex justify-between items-center">
    <div class="text-3xl font-bold text-blue-500">{{ title }}</div>
    <div class="flex gap-6">
      <a v-for="item in menuItems" 
         :key="item.id" 
         :href="item.href" 
         class="px-4 py-2 text-white hover:text-blue-400 transition-colors">
        {{ item.label }}
      </a>
    </div>
  </nav>
</template>

<script>
export default {
  name: 'NavBar',
  props: {
    title: {
      type: String,
      default: 'HydraDigital'
    },
    menuItems: {
      type: Array,
      default: () => [
        { id: 1, href: '#apps', label: 'Nossos Apps' },
        { id: 2, href: '#games', label: 'Jogos' },
        { id: 3, href: '#contact', label: 'Contato' }
      ]
    }
  }
}
</script>
