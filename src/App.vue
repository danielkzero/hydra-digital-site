<template>
  <div class="min-h-screen relative">
    <span class="relative z-50 animate-content-fade">
      <header>
        <NavBar />
      </header>
    </span>
    <!-- Background Image with Overlay -->
    <div class="fixed inset-0 z-0 overflow-hidden">
      <img src="/src/assets/images/hydra.png" alt="Hydra Digital Background"
        class="w-full h-full object-cover animate-zoom-fade">
      <div class="absolute inset-0 bg-gradient-to-b from-gray-900/95 to-gray-800/95 animate-fade-in"></div>
    </div>

    <!-- Content -->
    <div class="relative z-10 animate-content-fade">
      <router-view />

      <section id="contact" class="container mx-auto px-4 py-20">
        <h2 class="text-4xl font-bold text-white text-center mb-12">{{ contactTitle }}</h2>
        <ContactSection />
      </section>

      <footer class="container mx-auto px-4 py-8 text-center text-gray-400">
        <p>&copy; {{ currentYear }} HydraDigital. Todos os direitos reservados.</p>
      </footer>
    </div>
  </div>
</template>
<script>
import NavBar from '@/components/NavBar.vue'
import ContactSection from '@/components/ContactSection.vue'
export default {
  name: 'App',
  components: {
    NavBar, ContactSection
  },
  data() {
    return {
      contactTitle: 'Entre em Contato',
    }
  },
  computed: {
    currentYear() {
      return new Date().getFullYear()
    }
  },
}
</script>
