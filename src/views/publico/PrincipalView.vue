<template>
  <main>
    <HeroSection :title="heroContent.title" :description="heroContent.description" :buttons="heroContent.actions" />

    <SectionBlock
      id="apps"
      :eyebrow="sectionContent.apps.eyebrow"
      :title="sectionContent.apps.title"
      :description="sectionContent.apps.description"
    >
      <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-4">
        <AppCard v-for="app in apps" :key="app.id" v-bind="app" />
      </div>
    </SectionBlock>

    <SectionBlock
      id="games"
      :eyebrow="sectionContent.games.eyebrow"
      :title="sectionContent.games.title"
      :description="sectionContent.games.description"
      muted
    >
      <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
        <GameCard v-for="game in games" :key="game.id" v-bind="game" />
      </div>
    </SectionBlock>

    <SectionBlock
      id="techs"
      :eyebrow="sectionContent.technologies.eyebrow"
      :title="sectionContent.technologies.title"
      :description="sectionContent.technologies.description"
    >
      <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
        <TechnologyCard v-for="tech in technologies" :key="tech.id" v-bind="tech" />
      </div>
    </SectionBlock>

    <BlogHighlightsSection :content="sectionContent.blog" />
  </main>
</template>

<script setup>
import AppCard from '@/components/AppCard.vue'
import BlogHighlightsSection from '@/components/BlogHighlightsSection.vue'
import GameCard from '@/components/GameCard.vue'
import HeroSection from '@/components/HeroSection.vue'
import SectionBlock from '@/components/SectionBlock.vue'
import TechnologyCard from '@/components/TechnologyCard.vue'
import apps from '@/data/apps'
import games from '@/data/games'
import { heroContent, sectionContent } from '@/data/site'
import technologies from '@/data/technologies'
</script>
