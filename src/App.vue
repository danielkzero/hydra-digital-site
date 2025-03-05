<template>
  <div class="min-h-screen relative">
    <!-- Background Image with Overlay -->
    <div class="fixed inset-0 z-0 overflow-hidden">
      <img src="/src/assets/images/hydra.png" alt="Hydra Digital Background" 
           class="w-full h-full object-cover animate-zoom-fade">
      <div class="absolute inset-0 bg-gradient-to-b from-gray-900/95 to-gray-800/95 animate-fade-in"></div>
    </div>

    <!-- Content -->
    <div class="relative z-10 animate-content-fade">
      <header class="container mx-auto px-4 py-6">
        <NavBar />
      </header>

      <main>
        <HeroSection />

        <!-- Featured Games Section -->
        <section id="games" class="container mx-auto px-4 py-20">
          <h2 class="text-4xl font-bold text-white text-center mb-12">{{ gamesTitle }}</h2>
          <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <GameCard v-for="game in games"
                     :key="game.id"
                     v-bind="game" />
          </div>
        </section>

        <!-- Technologies Section -->
        <section class="container mx-auto px-4 py-20 bg-gray-900/50">
          <h2 class="text-4xl font-bold text-white text-center mb-12">{{ technologiesTitle }}</h2>
          <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <TechnologyCard v-for="tech in technologies"
                           :key="tech.id"
                           v-bind="tech" />
          </div>
        </section>

        <!-- Contact Section -->
        <section id="contact" class="container mx-auto px-4 py-20">
          <h2 class="text-4xl font-bold text-white text-center mb-12">{{ contactTitle }}</h2>
          <ContactSection />
        </section>
      </main>

      <footer class="container mx-auto px-4 py-8 text-center text-gray-400">
        <p>&copy; {{ currentYear }} HydraDigital. Todos os direitos reservados.</p>
      </footer>
    </div>
  </div>
</template>

<script>
import NavBar from './components/NavBar.vue'
import HeroSection from './components/HeroSection.vue'
import GameCard from './components/GameCard.vue'
import TechnologyCard from './components/TechnologyCard.vue'
import ContactSection from './components/ContactSection.vue'
import games from './data/games.js'
import technologies from './data/technologies.js'

export default {
  name: 'App',
  components: {
    NavBar,
    HeroSection,
    GameCard,
    TechnologyCard,
    ContactSection
  },
  data() {
    return {
      gamesTitle: 'Nossos Jogos em Destaque',
      technologiesTitle: 'Tecnologias que Utilizamos',
      contactTitle: 'Entre em Contato',
      games,
      technologies
    }
  },
  computed: {
    currentYear() {
      return new Date().getFullYear()
    }
  }
}
</script>

<style>
@keyframes zoomFade {
  0% {
    opacity: 0;
    transform: scale(1.1);
  }
  100% {
    opacity: 1;
    transform: scale(1);
  }
}

@keyframes fadeIn {
  from {
    opacity: 0;
  }
  to {
    opacity: 0.95;
  }
}

@keyframes contentFade {
  0% {
    opacity: 0;
    transform: translateY(20px);
  }
  30% {
    opacity: 0;
    transform: translateY(20px);
  }
  100% {
    opacity: 1;
    transform: translateY(0);
  }
}

.animate-zoom-fade {
  animation: zoomFade 2.5s ease-out forwards;
}

.animate-fade-in {
  animation: fadeIn 2.5s ease-out forwards;
}

.animate-content-fade {
  animation: contentFade 3s ease-out forwards;
}
</style>
