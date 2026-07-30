<template>
  <nav
    v-if="hiddenMenu"
    :class="[
      'fixed left-0 top-0 z-50 w-full transition-all duration-300',
      isScrolled ? 'border-b border-white/10 bg-slate-950/85 shadow-2xl shadow-slate-950/20 backdrop-blur-xl' : 'bg-transparent',
    ]"
  >
    <div class="mx-auto flex max-w-6xl items-center justify-between px-4 py-4 sm:px-6 lg:px-8">
      <router-link to="/" class="flex items-center gap-3">
        <img src="@/assets/images/logoCentral.png" alt="Hydra Digital Logo" class="h-10 w-auto" />
        <div>
          <span class="block text-lg font-semibold tracking-[0.2em] text-cyan-300">{{ title }}</span>
          <span class="block text-xs uppercase tracking-[0.35em] text-slate-400">Digital Products</span>
        </div>
      </router-link>

      <div class="hidden items-center gap-2 md:flex">
        <a
          v-for="item in menuItems"
          :key="item.id"
          :href="item.href"
          class="inline-flex items-center gap-2 rounded-full px-4 py-2 text-sm text-slate-200 transition hover:bg-white/5 hover:text-cyan-300"
          @click.prevent="navigate(item.href)"
        >
          <i :class="item.icon" class="text-xl"></i>
          <span>{{ item.label }}</span>
        </a>
      </div>

      <div class="md:hidden">
        <button @click="toggleMobileMenu" class="text-white transition-colors hover:text-cyan-300">
          <i class="bx bx-menu text-2xl"></i>
        </button>
      </div>
    </div>

    <aside v-show="isMobileMenuOpen" class="fixed inset-0 z-50 md:hidden" @click="closeMobileMenu">
      <div
        class="absolute inset-0 bg-slate-950/70 backdrop-blur-sm transition-opacity"
        :class="isMobileMenuOpen ? 'opacity-100' : 'opacity-0'"
      ></div>

      <div
        class="absolute right-0 top-0 h-full w-full max-w-xs border-l border-white/10 bg-slate-950/95 p-6 shadow-lg transition-transform duration-300"
        :class="isMobileMenuOpen ? 'translate-x-0' : 'translate-x-full'"
        @click.stop
      >
        <button
          @click="closeMobileMenu"
          class="absolute right-6 top-6 text-white transition-colors hover:text-cyan-300"
        >
          <i class="bx bx-x text-2xl"></i>
        </button>

        <div class="flex flex-col pt-16">
          <a
            v-for="item in menuItems"
            :key="item.id"
            :href="item.href"
            class="flex items-center gap-3 border-b border-white/10 py-4 text-white transition-colors last:border-none hover:text-cyan-300"
            @click.prevent="navigate(item.href)"
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
import { onBeforeUnmount, ref, watch } from 'vue'
import { useRouter } from 'vue-router'

import { useScrollState } from '@/composables/useScrollState'
import { useSectionNavigation } from '@/composables/useSectionNavigation'

defineProps({
  title: { type: String, default: 'HydraDigital' },
  hiddenMenu: { type: Boolean, default: true },
  menuItems: {
    type: Array,
    default: () => [],
  },
})

const router = useRouter()
const isMobileMenuOpen = ref(false)
const { isScrolled } = useScrollState()
const { navigateToSection } = useSectionNavigation()

function syncBodyScroll() {
  document.body.style.overflow = isMobileMenuOpen.value ? 'hidden' : ''
}

function toggleMobileMenu() {
  isMobileMenuOpen.value = !isMobileMenuOpen.value
}

function closeMobileMenu() {
  isMobileMenuOpen.value = false
}

async function navigate(href) {
  if (href.startsWith('/')) {
    await router.push(href)
    closeMobileMenu()
    return
  }

  await navigateToSection(href)
  closeMobileMenu()
}

watch(isMobileMenuOpen, syncBodyScroll, { immediate: true })

onBeforeUnmount(() => {
  document.body.style.overflow = ''
})
</script>
