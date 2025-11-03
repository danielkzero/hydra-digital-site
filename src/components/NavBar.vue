<template>
  <nav
    v-if="hiddenMenu"
    :class="['w-full px-6 py-4 transition-all duration-300 fixed top-0 left-0 z-50', isScrolled ? 'bg-gray-900/95 backdrop-blur-sm shadow-lg' : '']"
  >
    <div class="flex items-center justify-between container mx-auto">
      <!-- Logo + Título -->
      <router-link to="/" class="flex items-center space-x-3">
        <img src="@/assets/images/logoCentral.png" alt="Hydra Digital Logo" class="h-10 w-auto" />
        <span class="text-2xl font-bold text-white">{{ title }}</span>
      </router-link>

      <!-- Menu Desktop -->
      <div class="space-x-6 hidden md:flex">
        <a
          v-for="item in menuItems"
          :key="item.id"
          :href="item.href"
          @click.prevent="handleMobileNavigation(item.href)"
          class="text-white hover:text-blue-400 transition-colors flex items-center space-x-2"
        >
          <i :class="item.icon" class="text-xl"></i>
          <span>{{ item.label }}</span>
        </a>
      </div>

      <!-- Hamburguer Menu -->
      <div class="md:hidden">
        <button @click="toggleMobileMenu" class="text-white hover:text-blue-400 transition-colors">
          <i class="bx bx-menu text-2xl"></i>
        </button>
      </div>
    </div>

    <!-- Mobile Menu Aside -->
    <aside
      v-show="isMobileMenuOpen"
      class="fixed inset-0 z-50 md:hidden"
      @click="closeMobileMenu"
    >
      <div
        class="absolute inset-0 bg-black/50 backdrop-blur-sm transition-opacity"
        :class="isMobileMenuOpen ? 'opacity-100' : 'opacity-0'"
      ></div>

      <div
        class="absolute right-0 top-0 h-full w-96 bg-gray-900/95 shadow-lg transform transition-transform duration-300"
        :class="isMobileMenuOpen ? 'translate-x-0' : 'translate-x-full'"
        @click.stop
      >
        <button
          @click="closeMobileMenu"
          class="absolute top-6 right-6 text-white hover:text-blue-400 transition-colors"
        >
          <i class="bx bx-x text-2xl"></i>
        </button>

        <div class="flex flex-col pt-20 px-6">
          <a
            v-for="item in menuItems"
            :key="item.id"
            :href="item.href"
            @click.prevent="handleMobileNavigation(item.href)"
            class="text-white hover:text-blue-400 transition-colors flex items-center space-x-3 py-4 border-b border-gray-700 last:border-none"
          >
            <i :class="item.icon" class="text-2xl"></i>
            <span class="text-lg">{{ item.label }}</span>
          </a>
        </div>
      </div>
    </aside>
  </nav>
</template>

<script setup>
import { ref, onMounted, onBeforeUnmount, watch } from 'vue';
import { useRouter, useRoute } from 'vue-router';

const props = defineProps({
  title: { type: String, default: 'HydraDigital' },
  hiddenMenu: { type: Boolean, default: true },
  menuItems: {
    type: Array,
    default: () => [
      { id: 1, href: '/#apps', label: 'Aplicativos', icon: 'bx bx-mobile-alt' },
      { id: 2, href: '/#games', label: 'Jogos', icon: 'bx bx-game' },
      { id: 3, href: '/#contact', label: 'Contato', icon: 'bx bx-envelope' }
    ]
  }
});

const isScrolled = ref(false);
const isMobileMenuOpen = ref(false);

const router = useRouter();
const route = useRoute();

// Detecta scroll para adicionar sombra e fundo no navbar
const handleScroll = () => {
  isScrolled.value = window.scrollY > 50;
};

// Scroll suave para qualquer seção
const scrollToSection = (href) => {
  const element = document.querySelector(href.replace('/', ''));
  if (element) {
    const navbarHeight = 80;
    const elementPosition = element.getBoundingClientRect().top + window.pageYOffset;
    const offsetPosition = elementPosition - navbarHeight;

    window.scrollTo({
      top: offsetPosition,
      behavior: 'smooth'
    });
  }
};

// Menu mobile
const toggleMobileMenu = () => {
  isMobileMenuOpen.value = !isMobileMenuOpen.value;
  document.body.style.overflow = isMobileMenuOpen.value ? 'hidden' : '';
};

const closeMobileMenu = () => {
  isMobileMenuOpen.value = false;
  document.body.style.overflow = '';
};

// Corrige navegação mobile: redireciona se não estiver na página principal e faz scroll
const handleMobileNavigation = (href) => {
  const currentPath = route.path;
  if (currentPath !== '/') {
    router.push('/').then(() => {
      // Pequeno timeout para garantir que a página carregou
      setTimeout(() => scrollToSection(href), 100);
    });
  } else {
    scrollToSection(href);
  }
  closeMobileMenu();
};

// Listeners
onMounted(() => window.addEventListener('scroll', handleScroll));
onBeforeUnmount(() => window.removeEventListener('scroll', handleScroll));
</script>

<style scoped>
nav {
  transition: background-color 0.3s ease, backdrop-filter 0.3s ease, box-shadow 0.3s ease;
}
</style>
