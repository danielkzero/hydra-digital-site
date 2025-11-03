<template>



  <main class="pt-20">
    <HeroSection id="top" />

    <!-- Applications Section -->
    <section id="apps" class="container mx-auto px-4 py-20">
      <h2 class="text-4xl font-bold text-white text-center mb-12">{{ appsTitle }}</h2>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <AppCard v-for="app in apps" :key="app.id" v-bind="app" />
      </div>
    </section>

    <!-- Featured Games Section -->
    <section id="games" class="container mx-auto px-4 py-20">
      <h2 class="text-4xl font-bold text-white text-center mb-12">{{ gamesTitle }}</h2>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <GameCard v-for="game in games" :key="game.id" v-bind="game" />
      </div>
    </section>

    <!-- Technologies Section -->
    <section id="techs" class="container mx-auto px-4 py-20 bg-gray-900/50">
      <h2 class="text-4xl font-bold text-white text-center mb-12">{{ technologiesTitle }}</h2>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <TechnologyCard v-for="tech in technologies" :key="tech.id" v-bind="tech" />
      </div>
    </section>

  </main>
</template>

<script>

import HeroSection from '@/components/HeroSection.vue'
import GameCard from '@/components/GameCard.vue'
import AppCard from '@/components/AppCard.vue'
import TechnologyCard from '@/components/TechnologyCard.vue'

import games from '@/data/games.js'
import technologies from '@/data/technologies.js'
import apps from '@/data/apps.js'

export default {
  name: 'PrincipalView',
  components: {
    HeroSection,
    GameCard,
    AppCard,
    TechnologyCard
  },
  data() {
    return {
      appsTitle: 'Nossos Aplicativos',
      gamesTitle: 'Nossos Jogos em Destaque',
      technologiesTitle: 'Tecnologias que Utilizamos',      
      games,
      apps,
      technologies,
    }
  },
  computed: {
    currentYear() {
      return new Date().getFullYear()
    }
  },
  mounted() {
    window.addEventListener("scroll", this.handleScroll);
  },
  beforeUnmount() {
    window.removeEventListener("scroll", this.handleScroll);
  },
  methods: {
    handleScroll() {
      this.isScrolled = window.scrollY > 50;
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